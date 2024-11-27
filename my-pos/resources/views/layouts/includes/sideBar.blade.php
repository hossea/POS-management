<nav class="active" id="sidebar">
    <ul class="list-unstyled lead">
        <li>
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
        </li>
        <li>
            <a href="{{ route('orders.index') }}"><i class="fa fa-box"></i> Orders</a>
        </li>
        <li>
            <a href=""><i class="fa fa-money-bill"></i> Transaction</a>
        </li>
        <li>
            <a href=""><i class="fa fa-truck"></i> Products</a>
        </li>
    </ul>
</nav>


<style>
    #sidebar ul.lead {
    border-bottom: 1px solid #47748b;
    width: fit-content;
    padding-left: 0;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: flex;
    align-items: center;
    width: 30vh;
    color: #008B8B;
    transition: color 0.3s, background 0.3s;
}

#sidebar ul li a:hover {
    color: #fff;
    background: #008B8B;
    text-decoration: none;
}

#sidebar ul li a i {
    margin-right: 10px;
}

#sidebar ul li.active > a,
#sidebar ul li a[aria-expanded="true"] {
    color: #fff;
    background: #008B8B;
}

</style>
