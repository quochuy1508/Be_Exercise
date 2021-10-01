<?php

namespace Magenest\Cache\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

class CustomerDirectory extends AbstractModel
{
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'magenest_customer_diretory';
    /**
     * @var string
     */
    protected $_cacheTag = 'magenest_customer_diretory';
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'magenest_customer_diretory';

    /**
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    function __construct(
        Context          $context,
        Registry         $registry,
        AbstractResource $resource = null,
        AbstractDb       $resourceCollection = null,
        array            $data = [])
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Magenest\Cache\Model\ResourceModel\CustomerDirectory::class);
    }
}
