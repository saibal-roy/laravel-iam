@extends('laraveliam::layouts.app')

@section('title', '| Permissions')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <h1 class="h2"><span data-feather="key"></span> Available Permissions</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('laravel-iam.permissions.edit', $permission->id) }}" class="pull-left"
                            style="margin-right: 3px;">
                            <span data-feather="edit"></span>
                        </a>
                        <a href="{{ route('laravel-iam.permissions.destroy', $permission->id) }}" data-method="delete"
                            class="pull-left" style="margin-right: 3px;">
                            <span data-feather="trash"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('laravel-iam.permissions.create') }}" class="btn btn-success">Add Permission</a>

</div>

@endsection
