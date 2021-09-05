<?php

namespace App\Services\Orders\Repositories;


use App\Order;

interface OrderRepositoryInterface
{
    public function search($report = '');

    public function overdue();

    public function completed();

    public function new();

    public function current();

    public function updateFromArray(Order $order, array $data): Order ;

    public function getUsersToNotify(Order $order): array;

    public function find(int $id);
}