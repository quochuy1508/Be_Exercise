<?php

namespace Magenest\CLI\Model;

use Magenest\CLI\Api\CancelOrderWithStatusInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

/**
 * Class CancelOrderWithStatus
 */
class CancelOrderWithStatus implements CancelOrderWithStatusInterface
{
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var DateTime
     */
    private $dateTime;

    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        OrderRepositoryInterface $orderRepository,
        DateTime $dateTime
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->orderRepository = $orderRepository;
        $this->dateTime = $dateTime;
    }

    /**
     * @inheirtDoc
     */
    public function execute($statusOrder)
    {
        if ($statusOrder == 'pending' || $statusOrder == 'processing') {
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(OrderInterface::STATUS, $statusOrder)
                ->addFilter(OrderInterface::UPDATED_AT, $this->dateTime->gmtDate('Y-m-d\TH:i:s\Z', strtotime('-1 hour')), 'lteq')
                ->create();
            $orders = $this->orderRepository->getList($searchCriteria)->getItems();
            foreach ($orders as $order) {
                $order->setStatus('canceled');
                $this->orderRepository->save($order);
            }
            return true;
        } else {
            return false;
        }
    }
}
