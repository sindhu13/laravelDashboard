@extends('layouts.app')

@section('title', '| Create New Position')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add Position</h1>
  <hr>
    <div class="panel-body">
      {!! Form::open(array('url' => 'positions')) !!}
      <div class="form-group">
        {{Form::label('position', 'Position')}}
        {{Form::text('position', '', ['class' => 'form-control', 'placeholder' => 'Enter Position'])}}
      </div>
      {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
      <a class="btn btn-primary" href="{{ route('positions.index') }}">Cancel</a>
      {!! Form:: close() !!}
    </div>
</div>
@endsection
