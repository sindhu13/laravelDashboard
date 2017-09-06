@extends('layouts.app')

@section('title', '| View Employee')

@section('content')

<div class="container">

    <h1>{{ $employee->name }}</h1>
    <hr>
    <p class="lead">{{ $employee->phone }} </p>
    <p class="lead">{{ $employee->address }} </p>
    <p class="lead">{{ $employee->position }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['employees.destroy', $employee->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Seller')
    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Seller')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection
