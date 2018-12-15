<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('laravel-iam.dashboard') }}">
        <span data-feather="home"></span>
        Dashboard<span class="sr-only">(current)</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('laravel-iam.users.index') }}">
        <span data-feather="users"></span>
        Users
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('laravel-iam.roles.index') }}">
        <span data-feather="bar-chart-2"></span>
        Roles
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('laravel-iam.permissions.index') }}">
        <span data-feather="layers"></span>
        Permissions
        </a>
    </li>
</ul>  
