<?php
/**
 * Copyright © Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shopreviews\Connect\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Url\EncoderInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Shopreviews\Connect\Api\Config\RepositoryInterface as ConfigRepository;
use Shopreviews\Connect\Api\Review\DataInterface as ReviewData;
use Shopreviews\Connect\Api\Review\RepositoryInterface as ReviewRepository;
use Shopreviews\Connect\Api\Website\DataInterface as WebsiteData;
use Shopreviews\Connect\Api\Website\RepositoryInterface as WebsiteRepository;
use Shopreviews\Connect\Api\Source\DataInterface as SourceData;
use Shopreviews\Connect\Api\Source\RepositoryInterface as SourceRepository;
use Shopreviews\Connect\Model\Review\Collection as ReviewCollection;
use Shopreviews\Connect\Model\Source\Collection as SourceCollection;
use Shopreviews\Connect\Service\Tools\Formatter;
use Shopreviews\Connect\Api\Log\RepositoryInterface as LogRepository;

class Reviews implements ArgumentInterface
{
    public const DEFAULT_REVIEWS_PER_PAGE = 30;

    private ?ReviewCollection $reviewCollection = null;
    private ?SourceCollection $sources = null;
    private ?WebsiteData $website = null;

    private ReviewRepository $reviewRepository;
    private SourceRepository $sourceRepository;
    private WebsiteRepository $websiteRepository;
    private ConfigRepository $configRepository;
    private LogRepository $logRepository;

    private Filters\Sorting $sorting;
    private Filters\RatingFilter $ratingFilter;
    private Filters\SourceFilter $sourceFilter;

    private RequestInterface $request;
    private Formatter $formatter;
    private UrlInterface $urlBuilder;
    private EncoderInterface $encoder;
    private Json $json;

    public function __construct(
        ReviewRepository $reviewRepository,
        SourceRepository $sourceRepository,
        WebsiteRepository $websiteRepository,
        ConfigRepository $configRepository,
        LogRepository $logRepository,
        Filters\Sorting $sorting,
        Filters\RatingFilter $ratingFilter,
        Filters\SourceFilter $sourceFilter,
        RequestInterface $request,
        Formatter $formatter,
        UrlInterface $urlBuilder,
        EncoderInterface $encoder,
        Json $json
    ) {
        $this->reviewRepository = $reviewRepository;
        $this->websiteRepository = $websiteRepository;
        $this->sourceRepository = $sourceRepository;
        $this->configRepository = $configRepository;
        $this->logRepository = $logRepository;
        $this->sorting = $sorting;
        $this->ratingFilter = $ratingFilter;
        $this->sourceFilter = $sourceFilter;
        $this->request = $request;
        $this->formatter = $formatter;
        $this->urlBuilder = $urlBuilder;
        $this->encoder = $encoder;
        $this->json = $json;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->configRepository->isEnabled() && $this->getWebsite();
    }

    /**
     * Retrieve reviews with formatted fields.
     */
    public function getReviews(): array
    {
        return array_map(
            fn (ReviewData $review) => [
                'name' => $review->getName(),
                'description' => $review->getDescription(),
                'total' => $review->getRating(),
                'platform_name' => $review->getPlatformName(),
                'platform_logo' => $this->formatter->getMediaUrl($review->getPlatformIcon()),
                'platform_url' => 'todo',
                'clean_date' => $review->getReviewDate(),
                'created' => $this->formatter->date($review->getReviewDate()),
                'locale_code' => $review->getLocaleCode(),
                'source_url' => $review->getData('source_url'),
                'source_review_link' => $review->getData('source_review_link')
            ],
            $this->prepareReviewsCollection()->getItems()
        );
    }

    /**
     * Prepare the reviews collection with applied filters.
     */
    public function prepareReviewsCollection(): ReviewCollection
    {
        $this->logRepository->addErrorLog('Filters', $this->request->getParams());

        if ($this->reviewCollection === null) {
            $collection = $this->reviewRepository
                ->getBySources($this->getSources()->getColumnValues(SourceData::SOURCE_UUID))
                ->setPageSize($this->getReviewsPerPage())
                ->setCurPage($this->getCurrentPage());

            $ratingsFilter = $this->ratingFilter->resolveFilter($this->getFilterValues('ratings'));
            if ($ratingsFilter) {
                $collection->addFieldToFilter(ReviewData::RATING, ['in' => $ratingsFilter]);
            }

            $sources = $this->sourceFilter->resolveFilter($this->getFilterValues('sources'));
            if ($sources) {
                $collection->addFieldToFilter(ReviewData::SOURCE_UUID, ['in' => $sources]);
            }

            if ($sorting = $this->getFilterValues('sorting')) {
                if (end($sorting) == 'date_asc') {
                    $collection->setOrder(ReviewData::REVIEW_DATE, 'ASC');
                }
                if (end($sorting) == 'date_dec') {
                    $collection->setOrder(ReviewData::REVIEW_DATE, 'DESC');
                }
            }

            $this->reviewCollection = $collection->load();
        }

        return $this->reviewCollection;
    }

    public function getReviewsSummary(): array
    {
        return [
            'totalReviews' => __('%1 Reviews', $this->getWebsite()->getReviewCount())->render(),
            'averageRating' => $this->getWebsite()->getAvgRating(),
            'ratingsCount' => $this->getWebsite()->getScoreSummary(),
            'platformList' => $this->getPlatformList()
        ];
    }

    /**
     * @return array
     */
    public function getPlatformList(): array
    {
        $list = [];
        foreach ($this->getSources() as $source) {
            $list[] = (object)[
                'logo' => $this->formatter->getMediaUrl($source->getPlatformLogo()),
                'rating' => $this->formatter->round($source->getAvgRating()),
                'count' => $source->getReviewCount(),
                'platformName' => $source->getPlatformName(),
            ];
        }

        return $list;
    }

    /**
     * Retrieve sources for the set Website
     */
    public function getWebsite(): ?WebsiteData
    {
        if ($this->website === null) {
            try {
                $this->website = $this->websiteRepository->getByUuid($this->configRepository->getWebsite());
            } catch (\Exception $exception) {
                return null;
            }
        }

        return $this->website;
    }

    /**
     * Retrieve sources for the set Website
     */
    public function getSources(): ?SourceCollection
    {
        if ($this->sources === null) {
            $this->sources = $this->sourceRepository->getByWebsite($this->configRepository->getWebsite());
        }

        return $this->sources;
    }

    /**
     * Get the reviews per page or default value.
     */
    private function getReviewsPerPage(): int
    {
        return (int)$this->configRepository->getReviewsPerPage() ?: self::DEFAULT_REVIEWS_PER_PAGE;
    }

    /**
     * Get the current page number.
     */
    private function getCurrentPage(): int
    {
        return max((int)$this->request->getParam('page', 1), 1);
    }

    /**
     * Retrieve filter values from the request.
     */
    private function getFilterValues(string $type): array
    {
        $value = $this->request->getParam($type, '');
        return $value ? explode(',', $value) : [];
    }

    /**
     * Get pagination data for the frontend.
     */
    public function getPaginationData(): array
    {
        $totalItems = $this->prepareReviewsCollection()->getSize();
        $reviewsPerPage = $this->getReviewsPerPage();
        $pagesQty = max((int)ceil($totalItems / $reviewsPerPage), 1);

        return [
            'isAvailable' => $pagesQty > 1,
            'prevValue' => $this->getAdjacentPage(-1),
            'pages' => $this->generatePaging($pagesQty),
            'nextValue' => $this->getAdjacentPage(1, $pagesQty),
            'currentPage' => $this->getCurrentPage(),
            'totalItems' => $totalItems,
        ];
    }

    /**
     * Get an adjacent page (previous or next).
     */
    private function getAdjacentPage(int $step, int $lastPage = PHP_INT_MAX): string
    {
        $targetPage = $this->getCurrentPage() + $step;
        return ($targetPage >= 1 && $targetPage <= $lastPage) ? (string)$targetPage : '';
    }

    /**
     * Generate pagination structure.
     */
    private function generatePaging(int $lastPage): array
    {
        return array_map(
            fn ($page) => [
                'value' => $page,
                'label' => $page,
                'current' => $page === $this->getCurrentPage(),
            ],
            range(1, $lastPage)
        );
    }

    /**
     * Get enabled filters for the frontend.
     */
    public function getEnabledFilters(): array
    {
        $ratingValues = $this->request->getParam('ratings', '');
        $sorting = $this->request->getParam('sorting', '');
        $sourceValues = $this->request->getParam('sources', '');

        return [
            'ratings' => [
                'enabled' => $this->configRepository->isRatingFilter() && $this->hasMultipleRatings(),
                'allSelected' => strpos($ratingValues, 'all') !== false,
                'data' => $this->ratingFilter->getFilter($this->getFilterValues('ratings')),
            ],
            'sorting' => [
                'enabled' => true,
                'data' => $this->sorting->getFilter($this->getFilterValues('sorting')),
            ],
            'source' => [
                'enabled' => $this->configRepository->isSourceFilter() && $this->hasMultipleSources(),
                'data' => $this->sourceFilter->getFilter($this->getFilterValues('sources'), $this->getSources()),
            ],
            'url' => $this->urlBuilder->getUrl('*/*/update'),
            'pageTitle' => $this->configRepository->getPageTitle(),
            'filtersHash' => $this->encoder->encode(
                "&ratings=$ratingValues&sorting=$sorting&sources=$sourceValues"
            ),
        ];
    }

    /**
     * Check if multiple ratings exist.
     */
    private function hasMultipleRatings(): bool
    {
        return count($this->reviewRepository->getRatingsRange()) > 1;
    }

    /**
     * Check if multiple years exist.
     */
    private function hasMultipleSources(): bool
    {
        return $this->getSources()->getSize() > 1;
    }

    /**
     * Serialize data to JSON.
     */
    public function serializeData(array $data): string
    {
        return $this->json->serialize($data);
    }
}
