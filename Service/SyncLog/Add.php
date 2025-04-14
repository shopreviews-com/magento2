<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Service\SyncLog;

use Magento\Framework\Message\ManagerInterface;

class Add
{
    private ManagerInterface $messageManager;

    public function __construct(
        ManagerInterface $messageManager
    ) {
        $this->messageManager = $messageManager;
    }

    /**
     * @param array $result
     * @param string $type
     * @return void
     */
    public function process(array $result, string $type): void
    {
        $message = $type . ' success!';
        $results = $result['multi'] ?? [$result];

        $updates = [];
        foreach ($results as $key => $entry) {

            if (!empty($entry['new'])) {
                $updates[] = __('%1 %2 synced', $entry['new'], (string)$key)->render();
            }
            if (!empty($entry['updated'])) {
                $updates[] = __('%1 %2 updated', $entry['updated'], (string)$key)->render();
            }

            if (empty($entry['success'])) {
                $this->messageManager->addErrorMessage($message);
            }
        }

        if (empty($updates)) {
            $this->messageManager->addSuccessMessage(__('No items updated or synced.'));
            return;
        }

        $finalMessage = $this->toSentence($updates);
        $this->messageManager->addSuccessMessage(__('Synchronization result: %1.', $finalMessage));
    }

    /**
     * Joins an array of strings with commas, but uses "and" before the last item.
     *
     * @param string[] $parts
     * @return string
     */
    private function toSentence(array $parts): string
    {
        $count = count($parts);
        if ($count === 1) {
            return $parts[0];
        }

        $last = array_pop($parts);
        return implode(', ', $parts) . ' and ' . $last;
    }
}
