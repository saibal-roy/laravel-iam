@extends('laraveliam::layouts.app')

@section('title', '| Dashboard')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    @if($users->isNotEmpty())
    <h1 class="h2"><span data-feather="home"></span> Dashboard - Latest Users</h1>
    <p class="lead"><span data-feather="log-in"></span> - This allows you to impersonate users login
    </p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th>User Roles</th>
                    <th>Impersonate</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>{{ $user->roles()->pluck('name')->isNotEmpty() ? $user->roles()->pluck('name')->implode(', ') : 'No roles assigned'  }}
                    </td>
                    {{-- Retrieve array of roles associated to a user and convert to string --}}

                    <td>
                        <a href="{{ route('impersonate', $user->id) }}" class="pull-left" style="margin-right: 3px;"
                            title="Impersonate">
                            <span data-feather="log-in"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    @else
    <h1 class="h2"><span data-feather="home"></span> {{app('laraveliam')->hello()}}</h1>
    <p class="lead">There are no users.</p>
    @endif
</div>
@endsection
