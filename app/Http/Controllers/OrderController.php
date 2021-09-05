<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderUpdateRequest;
use App\Order;
use App\Services\Orders\OrdersService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    /**
     * @var OrdersService
     */
    private $service;

    public function __construct(OrdersService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $report = $request->get('report');

        return view($this->service->getView($report), ['orders' => $this->service->getOrders($report)]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $id int order id
     */
    public function edit(int $id)
    {
        $order = $this->service->getOrder($id);
        $partners = $order->partner->getList();
        return view('orders.edit', compact('order', 'partners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderUpdateRequest $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $this->service->updateOrder($order,$request->validated());
        return redirect()->route('orders.index');
    }
}
