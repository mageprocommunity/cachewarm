<?php

namespace MagePro\CacheWarm\Model;


class UrlProvider
{
    /** @var $urlCollectionFactory */
    private $urlCollectionFactory;

    public function __construct(
        \Magento\UrlRewrite\Model\ResourceModel\UrlRewriteCollectionFactory $urlCollectionFactory
    ) {
        $this->urlCollectionFactory = $urlCollectionFactory;
    }

    public function getUrls($storeId, $entityType) {
        return $this->urlCollectionFactory->create()->addFieldToFilter('entity_type', $entityType)->addFieldToFilter('store_id', $storeId);
    }
}
