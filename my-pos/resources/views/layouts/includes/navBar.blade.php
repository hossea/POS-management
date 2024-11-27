<a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-outline rounded-pill">
    <i class="fa fa-list"></i>
</a>
<a href="{{ route('home') }}" class="btn btn-outline rounded-pill">
    <i class="fa fa-home"></i> Home
</a>
<a href="{{ route('users.index') }}" class="btn btn-outline rounded-pill">
    <i class="fa fa-user"></i> Users
</a>
<a href="{{ route('products.index') }}" class="btn btn-outline rounded-pill">
    <i class="fa fa-box"></i> Products
</a>
<a href="{{ route('orders.index') }}" class="btn btn-outline rounded-pill">
    <i class="fa fa-laptop"></i> Cashier
</a>
<a href="#" class="btn btn-outline rounded-pill">
    <i class="fa fa-file"></i> Reports
</a>
<a href="#" class="btn btn-outline rounded-pill">
    <i class="fa fa-money-bill"></i> Transaction
</a>
<a href="#" class="btn btn-outline rounded-pill">
    <i class="fa fa-chart"></i> Suppliers
</a>
<a href="#" class="btn btn-outline rounded-pill">
    <i class="fa fa-users"></i> Customers
</a>
<a href="#" class="btn btn-outline rounded-pill">
    <i class="fa fa-truck"></i> Incoming
</a>
<style>
    .btn-outline {
        border-color: #008B8B;
        color: #008B8B;
        padding: 4px;
        margin: 4px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: background 0.3s, color 0.3s;
    }

    .btn-outline:hover {
        background: #008B8B;
        color: #fff;
    }

    .btn-outline i {
        margin-right: 5px;
    }
</style>
