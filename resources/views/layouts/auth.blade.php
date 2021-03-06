<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
        @isset($title)
            {{ $title}} - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endisset
    </title>
    <!-- TinyMce -->
    <script src="https://cdn.tiny.cloud/1/n63k1bhpjawumspwwbxxciuhly63p6db2n7ft3vkhdrdz6n0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    @livewireStyles
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    @if(auth()->user()->hasRole('buyer'))
        <div class="ml-auto">
            <a class="nav-link mt-2 text-warning" href="{{ route('cart.index') }}">
                <livewire:cart.cart-nav-link />
            </a>
        </div>
    @endif
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">

        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->first_name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{ route('account') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <!-- Profile -->
                    <nav class="nav">
                        <a class="nav-link" href="{{ route('profile.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Profile
                        </a>
                    </nav>
                @if(auth()->user()->hasRole('buyer'))
                    <!-- Address -->
                    <nav class="nav">
                        <a class="nav-link" href="{{ route('address.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-address-card"></i></div>
                            Address
                        </a>
                    </nav>
                    <!-- User Orders -->
                    <nav class="nav">
                        <a class="nav-link" href="{{ route('user-orders.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                            Orders
                        </a>
                    </nav>
                    <!-- Wish List -->
                    <nav class="nav">
                        <a class="nav-link" href="{{ route('wish-list.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-gift"></i></div>
                            Wish List
                        </a>
                    </nav>
                    @endif
                    @can('product_access')
                        <!-- Products -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>
                            Products
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProducts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('products.index') }}">Show</a>
                                @can('product_create')
                                    <a class="nav-link" href="{{ route('products.create') }}">Create</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan
                    @can('order_access')
                        <!-- Orders -->
                        <nav class="nav">
                            <a class="nav-link" href="{{ route('orders.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                                Orders
                            </a>
                        </nav>
                    @endcan
                    @can('category_access')
                        <!-- Categories -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                            Categories
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCategories" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('categories.index') }}">Show</a>
                                @can('category_create')
                                    <a class="nav-link" href="{{ route('categories.create') }}">Create</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan
                    @can('coupon_access')
                        <!-- Coupons -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCoupons"
                           aria-expanded="false" aria-controls="collapseCoupons">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                            Coupons
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCoupons" aria-labelledby="headingOne"
                             data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('coupons.index') }}">Show</a>
                                @can('coupon_create')
                                    <a class="nav-link" href="{{ route('coupons.create') }}">Create</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan
                    @if(auth()->user()->hasRole('admin'))
                        <!-- User Management -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                            Users Management
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                                <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            @yield('content')
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@livewireScripts
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

</body>
</html>
