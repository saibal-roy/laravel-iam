@extends('laraveliam::layouts.app')

@section('title', '| Edit Permission')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

        @include ('laraveliam::errors.list')

    <p class="lead"> Edit : {{$permission->name}}</p>
    <br>
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>

    @if(!$roles->isEmpty())

        <h4>Assign Permission to Roles</h4>

        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id, $permission->roles ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach

    @endif
    <br>
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection