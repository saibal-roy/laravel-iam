@extends('laraveliam::layouts.app')

@section('title', '| Roles')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-key"></i> Roles</h1>
    <hr>
    @include ('laraveliam::errors.list')
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{  $role->permissions()->pluck('name')->implode(', ') }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}" 
                            class="pull-left" style="margin-right: 3px;">
                            <span data-feather="edit"></span>
                        </a>
                        <a href="{{ route('roles.destroy', $role->id) }}" 
                                data-method="delete" class="pull-left" style="margin-right: 3px;">
                            <span data-feather="trash"></span>
                        </a> 
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('roles.create') }}" class="btn btn-success">Add Role</a>

</div>

@endsection