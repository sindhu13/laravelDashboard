@extends('layouts.app')

@section('title', '| View Leasing')

@section('content')

<div class="container">

    <h1>{{ $leasing->title }}</h1>
    <hr>
    <p class="lead">{{ $leasing->body }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['leasing.destroy', $leasing->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Leasing')
    <a href="{{ route('leasing.edit', $leasing->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Leasing')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection
