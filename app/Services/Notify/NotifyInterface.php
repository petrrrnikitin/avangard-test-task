<?php

namespace App\Services\Notify;

interface NotifyInterface
{
    public function completedNotify($order, $users);
}