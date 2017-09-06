@extends('layouts.app')

@section('title', '| Create New Location')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add Location</h1>
  <hr>
    <div class="panel-body">
      {!! Form::open(array('url' => 'locations')) !!}
      <div class="form-group">
        {{Form::label('location', 'Location')}}
        {{Form::text('location', '', ['class' => 'form-control', 'placeholder' => 'Enter Location'])}}
      </div>
      {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
      <a class="btn btn-primary" href="{{ route('locations.index') }}">Cancel</a>
      {!! Form:: close() !!}
    </div>
</div>
@endsection
