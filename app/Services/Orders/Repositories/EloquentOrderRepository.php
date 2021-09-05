<?php


namespace App\Services\Orders\Repositories;


use App\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    private Builder $builder;

    public function search($report = '')
    {
        $this->builder = Order::query()
            ->with(['partner', 'orderProducts', 'orderProducts.product']);

        if (!$report) {
            return $this->builder
                ->paginate(20);
        }

        return $this->{$report}();
    }

    public function overdue()
    {
        return $this->builder
            ->whereDate('delivery_dt', '<', Carbon::now())
            ->where('status', '=', 10)
            ->orderBy('delivery_dt', 'desc')
            ->take(50)
            ->get();
    }

    public function completed()
    {
        return $this->builder
            ->whereDate('delivery_dt', '=', Carbon::today())
            ->where('status', '=', 20)
            ->orderBy('delivery_dt', 'desc')
            ->take(50)
            ->get();
    }

    public function new()
    {
        return $this->builder
            ->whereDate('delivery_dt', '>', Carbon::today())
            ->where('status', '=', 0)
            ->orderBy('delivery_dt')
            ->take(50)
            ->get();
    }

    public function current()
    {
        return $this->builder
            ->whereBetween('delivery_dt', [Carbon::now(), Carbon::now()->addDays(1)])
            ->where('status', '=', 10)
            ->orderBy('delivery_dt')
            ->get();
    }

    public function find(int $id)
    {
        return Order::with(['orderProducts', 'orderProducts.product'])->findOrFail($id);
    }

    public function updateFromArray(Order $order, array $data): Order
    {
        $order->update($data);

        return $order;
    }

    public function getUsersToNotify(Order $order): array
    {
        $users_email = [];
        $users_email[] = $order->partner->email;

        foreach ($order->orderProducts as $orderProduct) {
            $users_email[] = $orderProduct->product->vendor->email;
        }

        return $users_email;
    }
}