@extends('laraveliam::layouts.app')

@section('title', '| Users')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <h1 class="h2"><span data-feather="users"></span> All Users</h1>
    <p class="lead"><span data-feather="log-in"></span> - This allows you to impersonate users login
    </p>
    @include ('laraveliam::errors.list')
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th>User Roles</th>
                    <th>Operations</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>{{ $user->roles()->pluck('name')->isNotEmpty() ? $user->roles()->pluck('name')->implode(', ') : 'No roles assigned'  }}
                    </td>{{-- Retrieve array of roles associated to a user and convert to string --}}

                    <td>
                        <a href="{{ route('laravel-iam.users.edit', $user->id) }}" class="pull-left"
                            style="margin-right: 3px;">
                            <span data-feather="edit"></span>
                        </a>
                        <a href="{{ route('laravel-iam.users.destroy', $user->id) }}" data-method="delete"
                            class="pull-left" style="margin-right: 3px;">
                            <span data-feather="trash"></span>
                        </a>
                        <a href="{{ route('impersonate', $user->id) }}" class="pull-left" style="margin-right: 3px;"
                            title="Impersonate">
                            <span data-feather="log-in"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        {{ $users->links() }}
    </div>
    <a href="{{ route('laravel-iam.users.create') }}" class="btn btn-success">Add User</a>
</div>
@endsection
