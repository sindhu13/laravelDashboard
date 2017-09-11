@extends('layouts.app')

@section('title', '| Create New Unit Model')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add Unit Model</h1>
  <hr>
    <div class="panel-body">
      {!! Form::open(array('url' => 'unitModels')) !!}
      <div class="form-group">
        {{Form::label('name', 'Unit Model')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter Unit Model'])}}
      </div>
      {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
      <a class="btn btn-primary" href="{{ route('unitModels.index') }}">Cancel</a>
      {!! Form:: close() !!}
    </div>
</div>
@endsection
