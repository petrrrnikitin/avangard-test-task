@extends('layouts.app')
@section('content')
    <h3>Редактирование заказа № {{$order->id}}</h3>

    <div class="row">
        <div class="col-3">
            {{ Form::model($order, ['method' => 'PATCH','route' => ['orders.update', $order->id]]) }}
            <div class="form-group">
                {{ Form::label('client_email', 'E-mail клиента') }}
                {{ Form::email('client_email', null, ['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('status', 'Статус заказа') }}
                {{ Form::select('status', $order::STATUSES, $order->status, ['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('partner_id', 'Партнер') }}
                {{ Form::select('partner_id', $partners, $order->partner_id, ['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Сохранить', ['class' => 'btn btn-success']) }}
            </div>
        </div>
        {{ Form::close() }}
        <div class="col-3">
            <div class="card">
                <div class="card-header">Сумма заказа: {{ $order->OrderCost }}</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mb-0">
                            <thead>
                            <tr>
                                <th scope="col">Наименование</th>
                                <th scope="col">Кол-во</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderProducts as $orderProduct)
                                <tr>
                                    <td>{{$orderProduct->product->name}}</td>
                                    <td>{{$orderProduct->quantity}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection