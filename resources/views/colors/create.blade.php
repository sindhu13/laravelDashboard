@extends('layouts.app')

@section('title', '| Create New Color')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add Color</h1>
  <hr>
    <div class="panel-body">
      {!! Form::open(array('url' => 'colors')) !!}
      <div class="form-group">
        {{Form::label('color', 'Color')}}
        {{Form::text('color', '', ['class' => 'form-control', 'placeholder' => 'Enter Color'])}}
      </div>
      <div class="form-group">
        {{Form::label('code', 'Code')}}
        {{Form::text('code', '', ['class' => 'form-control', 'placeholder' => 'Enter Code'])}}
      </div>
      {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
      <a class="btn btn-primary" href="{{ route('colors.index') }}">Cancel</a>
      {!! Form:: close() !!}
    </div>
</div>
@endsection
