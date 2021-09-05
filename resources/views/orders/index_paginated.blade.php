@extends('layouts.app')

@section('content')
    @include('orders.blocks.list')
    {{ $orders->links() }}
@endsection
