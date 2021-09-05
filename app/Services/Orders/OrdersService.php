<?php

namespace App\Services\Orders;

use App\Order;
use App\Services\Notify\NotifyInterface;
use App\Services\Orders\Repositories\OrderRepositoryInterface;

class OrdersService
{

    private OrderRepositoryInterface $orderRepository;
    private NotifyInterface $notify;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        NotifyInterface $notify
    )
    {
        $this->orderRepository = $orderRepository;
        $this->notify = $notify;
    }

    public function getOrders($report_name = null)
    {
        return $this->orderRepository->search($report_name);
    }

    public function getOrder($id)
    {
        return $this->orderRepository->find($id);
    }

    public function getView($report): string
    {
        return $report
            ? 'orders.index'
            : 'orders.index_paginated';
    }

    /**
     * @param Order $order
     * @param array $data
     */
    public function updateOrder(Order $order, array $data)
    {
        $order = $this->orderRepository->updateFromArray($order, $data);
        if ($order->status == Order::COMPLETED_STATUS) {
            $this->notify->completedNotify($order, $this->orderRepository->getUsersToNotify($order));
        }
    }
}