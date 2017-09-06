@extends('layouts.app')

@section('title', '| Edit Location')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$location->name}}</h1>
    <hr>

    {{ Form::model($location, array('route' => array('locations.update', $location->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{Form::label('location', 'Location')}}
      {{Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Enter Location'])}}
    </div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
@endsection
