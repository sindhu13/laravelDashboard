@extends('layouts.app')

@section('title', '| Edit Color')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$color->name}}</h1>
    <hr>

    {{ Form::model($color, array('route' => array('colors.update', $color->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{Form::label('color', 'Color')}}
      {{Form::text('color', null, ['class' => 'form-control', 'placeholder' => 'Enter Color'])}}
    </div>
    <div class="form-group">
      {{Form::label('code', 'Code')}}
      {{Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Enter Code'])}}
    </div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
@endsection
