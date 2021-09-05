<?php
/* @var $order Order */

use App\Order;

?>

<tr>
    <th scope="row"><a href="{{route('orders.edit', ['id' => $order->id])}}">{{ $order->id }}</a></th>
    <th>{{ $order->partner->name }}</th>
    <td>{{ $order->OrderCost }} </td>
    <td>{{ $order->OrderList }}</td>
    <td>{{ $order->StatusName }}</td>
</tr>