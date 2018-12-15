@extends('laraveliam::layouts.app')

@section('title', '| Roles')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <p class="lead"><i class="fa fa-key"></i> Roles</p>
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

                    <td>{{  $role->permissions()->pluck('name')->implode(', ') ? 
                            $role->permissions()->pluck('name')->implode(', ') :
                            (config('iamconstants.sudo_user_role') == $role->name ?
                            "All permissions granted" :
                            "No permissions added")
                     }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                        @if(config('iamconstants.sudo_user_role') != $role->name)
                            <a href="{{ route('laravel-iam.roles.edit', $role->id) }}" 
                                class="pull-left" style="margin-right: 3px;">
                                <span data-feather="edit"></span>
                            </a>
                            <a href="{{ route('laravel-iam.roles.destroy', $role->id) }}" 
                                    data-method="delete" class="pull-left" style="margin-right: 3px;">
                                <span data-feather="trash"></span>
                            </a>
                        @else 
                            Not Allowed
                        @endif
                        
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('laravel-iam.roles.create') }}" class="btn btn-success">Add Role</a>

</div>

@endsection