<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title') - ShopWithHarith</title>
    <!-- CSS Integration -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Gen Z Style with Color Palette -->
    <style>
        :root {
            --color-dark-blue-1: #0d1b2a;
            --color-dark-blue-2: #1b263b;
            --color-blue-1: #415a77;
            --color-blue-2: #778da9;
            --color-light-gray: #e0e1dd;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-light-gray);
            color: var(--color-dark-blue-1);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        a {
            color: var(--color-blue-1);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        a:hover {
            color: var(--color-dark-blue-2);
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* Header Styles */
        header {
            background-color: var(--color-dark-blue-1);
            color: white;
            padding: 1rem 0;
        }
        
        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .logo a {
            color: white;
        }
        
        .main-nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .main-nav li {
            margin-left: 1.5rem;
        }
        
        .main-nav a {
            color: var(--color-light-gray);
            font-weight: 500;
        }
        
        .main-nav a:hover {
            color: white;
        }
        
        /* Main Content */
        main {
            flex: 1;
        }
        
        /* Footer Styles */
        footer {
            background-color: var(--color-dark-blue-2);
            color: var(--color-light-gray);
            padding: 3rem 0;
            margin-top: auto;
        }
        
        .footer-inner {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }
        
        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: white;
        }
        
        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-column li {
            margin-bottom: 0.5rem;
        }
        
        .footer-column a {
            color: var(--color-light-gray);
        }
        
        .footer-column a:hover {
            color: white;
        }
        
        .footer-bottom {
            margin-top: 2rem;
            text-align: center;
            border-top: 1px solid var(--color-blue-1);
            padding-top: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="container header-inner">
            <div class="logo">
                <a href="/">ShopWithHarith</a>
            </div>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/products">Products</a></li>
                    <li><a href="/categories">Categories</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contact">Contact</a></li>
                    @auth
                        <li><a href="/account">My Account</a></li>
                    @else
                        <li><a href="/login">Login</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="footer-inner">
                <div class="footer-column">
                    <h3>ShopWithHarith</h3>
                    <p>Your one-stop shop for trendy products.</p>
                </div>
                
                <div class="footer-column">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="#">Fashion</a></li>
                        <li><a href="#">Electronics</a></li>
                        <li><a href="#">Home & Living</a></li>
                        <li><a href="#">Beauty</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Customer Service</h3>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping & Returns</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Connect With Us</h3>
                    <ul>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">TikTok</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 ShopWithHarith. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript Integration -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>