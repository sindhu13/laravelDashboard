@extends('layouts.app')

@section('title', '| Edit Position')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$position->name}}</h1>
    <hr>

    {{ Form::model($position, array('route' => array('positions.update', $position->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{Form::label('position', 'Position')}}
      {{Form::text('position', null, ['class' => 'form-control', 'placeholder' => 'Enter Position'])}}
    </div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
@endsection
