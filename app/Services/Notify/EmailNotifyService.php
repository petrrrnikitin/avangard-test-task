<?php

namespace App\Services\Notify;

use App\Mail\OrderCompleted;
use App\Order;

class EmailNotifyService implements NotifyInterface
{

    /**
     * @param Order $order
     * @param $users
     * @return mixed
     */
    public function completedNotify($order, $users)
    {
        \Mail::to($users)->send(new OrderCompleted($order));
    }
}