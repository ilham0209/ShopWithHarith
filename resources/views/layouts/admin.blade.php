<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ShopWithHarith Admin</title>
    <!-- CSS Integration -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <!-- Include your custom styles with the color palette -->
    <style>
        :root {
            --color-dark-blue-1: #0d1b2a;
            --color-dark-blue-2: #1b263b;
            --color-blue-1: #415a77;
            --color-blue-2: #778da9;
            --color-light-gray: #e0e1dd;
        }
        /* Base styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-light-gray);
            color: var(--color-dark-blue-1);
            margin: 0;
            padding: 0;
        }
        /* Additional styling */
    </style>
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>ShopWithHarith</h1>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.products.index') }}">Products</a></li>
                    <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                    <li><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                    <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <header class="content-header">
                <h2>@yield('header')</h2>
                <div class="user-menu">
                    <span>{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </header>
            <div class="content-body">
                @yield('content')
            </div>
        </main>
    </div>
    <!-- JavaScript Integration -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>