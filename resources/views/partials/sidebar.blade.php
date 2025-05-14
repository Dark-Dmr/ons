<div class="sidebar">
    <div class="sidebar-header text-center py-4">
        <h4>أُنس</h4>
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('contents.index') }}" class="nav-link {{ request()->routeIs('contents.*') ? 'active' : '' }}">
                <i class="fas fa-book me-2"></i> المحتويات
            </a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout.admin') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-start w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج
                </button>
            </form>
        </li>
    </ul>
</div>
