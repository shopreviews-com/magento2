<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\Model\Config\Backend;

use Magento\Framework\App\Config\Value;
use Magento\Framework\Exception\LocalizedException;

class UrlPath extends Value
{
    /**
     * Validate and clean the URL path before saving.
     *
     * @throws LocalizedException
     */
    public function beforeSave(): void
    {
        $value = (string) $this->getValue();

        // Ensure value is not empty
        if (empty($value)) {
            throw new LocalizedException(__('The URL path cannot be empty.'));
        }

        // Ensure only alphanumeric characters, underscores, hyphens, and optional .html at the end
        if (!preg_match('/^[a-zA-Z0-9_-]+(?:\.html)?$/', $value)) {
            $msg = 'Invalid URL path. Only letters, numbers, underscores, hyphens, and optionally ".html" '.
                'at the end are allowed.';
            throw new LocalizedException(__($msg));
        }

        // Remove leading/trailing slashes ("/")
        $this->setValue(trim($value, '/'));
    }
}
