@extends('laraveliam::layouts.app')

@section('title', '| Edit Role')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>
    <p class="lead"> Edit Role: {{$role->name}}</p>
    @include ('laraveliam::errors.list')
    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Role Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    @if(!$permissions->isEmpty())
    <h5><b>Assign Permissions</b></h5>
    @foreach ($permissions as $permission)

        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
        {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

    @endforeach
    <br>
    @endif
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}    
</div>

@endsection