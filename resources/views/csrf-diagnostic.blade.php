<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF Diagnostic Page</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2 {
            color: #2563eb;
        }
        .card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .actions {
            margin-top: 30px;
        }
        button, .button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
            text-decoration: none;
            display: inline-block;
        }
        button:hover, .button:hover {
            background: #1d4ed8;
        }
        pre {
            background: #1e293b;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 4px;
            overflow-x: auto;
        }
        .token-value {
            word-break: break-all;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <h1>CSRF Token Diagnostic</h1>
    
    <div class="card">
        <h2>Session Information</h2>
        <p><strong>Session ID:</strong> {{ session()->getId() }}</p>
        <p><strong>Session Started:</strong> {{ session()->isStarted() ? 'Yes' : 'No' }}</p>
        <p><strong>Has CSRF Token:</strong> {{ session()->has('_token') ? 'Yes' : 'No' }}</p>
        <p><strong>CSRF Token Value:</strong></p>
        <div class="token-value">{{ csrf_token() }}</div>
    </div>
    
    <div class="card">
        <h2>Cookie Information</h2>
        <p><strong>XSRF-TOKEN Cookie Present:</strong> {{ isset($_COOKIE['XSRF-TOKEN']) ? 'Yes' : 'No' }}</p>
        <p><strong>Laravel Session Cookie Present:</strong> {{ isset($_COOKIE[config('session.cookie')]) ? 'Yes' : 'No' }}</p>
    </div>
    
    <div class="card">
        <h2>Test CSRF Token</h2>
        <form id="testForm" method="POST" action="/csrf-test">
            @csrf
            <button type="submit">Test POST Request with CSRF Token</button>
        </form>
    </div>
    
    <div class="card">
        <h2>Environment Information</h2>
        <p><strong>APP_URL:</strong> {{ config('app.url') }}</p>
        <p><strong>Session Driver:</strong> {{ config('session.driver') }}</p>
        <p><strong>Session Lifetime:</strong> {{ config('session.lifetime') }} minutes</p>
        <p><strong>Cookie Domain:</strong> {{ config('session.domain') ?: 'Not set (using current domain)' }}</p>
        <p><strong>Cookie Path:</strong> {{ config('session.path') }}</p>
        <p><strong>Secure Cookies:</strong> {{ config('session.secure') ? 'Yes' : 'No' }}</p>
        <p><strong>HTTP Only:</strong> {{ config('session.http_only') ? 'Yes' : 'No' }}</p>
        <p><strong>Same Site Policy:</strong> {{ config('session.same_site') ?: 'Not set' }}</p>
    </div>

    <div class="actions">
        <a href="/login" class="button">Go to Login</a>
        <a href="/register" class="button">Go to Register</a>
        <a href="/" class="button">Back to Home</a>
        <button id="clearCookies">Clear All Cookies</button>
    </div>

    <script>
        // Add CSRF token to all AJAX requests
        const csrfToken = "{{ csrf_token() }}";
        
        // Function to clear all cookies
        document.getElementById('clearCookies').addEventListener('click', function() {
            const cookies = document.cookie.split(";");
            
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i];
                const eqPos = cookie.indexOf("=");
                const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            }
            
            alert('All cookies cleared. Page will reload.');
            window.location.reload();
        });
    </script>
</body>
</html>