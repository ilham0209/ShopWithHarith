<div style="margin-bottom: 1.5rem;">
    <h3 style="margin-bottom: 0.5rem;">{{ Auth::user()->name }}</h3>
    <p style="color: #666;">{{ Auth::user()->email }}</p>
</div>

<a href="{{ route('admin.dashboard') }}">
    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
</a>

<nav>
    <ul style="list-style: none; padding: 0; margin: 0;">
        <li style="margin-bottom: 0.75rem;">
            <a href="{{ route('account.index') }}" 
               style="display: block; padding: 0.5rem; color: {{ Request::routeIs('account.index') ? 'white' : 'var(--color-dark-blue-2)' }}; background-color: {{ Request::routeIs('account.index') ? 'var(--color-blue-1)' : '#f5f5f5' }}; border-radius: 4px;">
                Dashboard
            </a>
        </li>
        <li style="margin-bottom: 0.75rem;">
            <a href="{{ route('account.orders') }}"
               style="display: block; padding: 0.5rem; color: {{ Request::routeIs('account.orders') ? 'white' : 'var(--color-dark-blue-2)' }}; background-color: {{ Request::routeIs('account.orders') ? 'var(--color-blue-1)' : '#f5f5f5' }}; border-radius: 4px;">
                My Orders
            </a>
        </li>
        <li style="margin-bottom: 0.75rem;">
            <a href="{{ route('account.profile') }}"
               style="display: block; padding: 0.5rem; color: {{ Request::routeIs('account.profile') ? 'white' : 'var(--color-dark-blue-2)' }}; background-color: {{ Request::routeIs('account.profile') ? 'var(--color-blue-1)' : '#f5f5f5' }}; border-radius: 4px;">
                Profile Settings
            </a>
        </li>
        <li style="margin-bottom: 0.75rem;">
            <a href="{{ route('admin.dashboard') }}"
               style="display: block; padding: 0.5rem; color: {{ Request::routeIs('admin.dashboard') ? 'white' : 'var(--color-dark-blue-2)' }}; background-color: {{ Request::routeIs('admin.dashboard') ? 'var(--color-blue-1)' : '#f5f5f5' }}; border-radius: 4px;">
                Admin Dashboard
            </a>
        </li>
    </ul>
</nav>

<form action="{{ route('logout') }}" method="POST" style="margin-top: 2rem;">
    @csrf
    <button type="submit" style="width: 100%; padding: 0.75rem; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">
        Logout
    </button>
</form>