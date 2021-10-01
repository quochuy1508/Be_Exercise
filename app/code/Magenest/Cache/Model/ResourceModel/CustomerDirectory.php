<?php

namespace Magenest\Cache\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Store\Model\StoreManagerInterface;

class CustomerDirectory extends AbstractDb
{
    /**
     * Block grid entity table
     *
     * @var string
     */
    protected $_blockProductTable;

    /**
     * Construct
     *
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param string|null $resourcePrefix
     */
    public function __construct(
        Context $context,
                $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('customer_directory', 'entity_id');
    }
}
