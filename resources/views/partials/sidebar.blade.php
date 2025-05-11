<div class="sidebar">
    <div class="sidebar-header text-center py-4">
        <h4>أنس</h4>
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('contents.index') }}" class="nav-link {{ request()->routeIs('contents.*') ? 'active' : '' }}">
                <i class="fas fa-book me-2"></i> Contents
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                <i class="fas fa-tags me-2"></i> Categories
            </a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout.admin') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-start w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>