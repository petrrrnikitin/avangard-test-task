<div class="table-responsive">
    <table class="table table-striped table-sm">
        @include('orders.blocks.header')
        <tbody>
        @each('orders.blocks.item', $orders, 'order')
        </tbody>
    </table>
</div>