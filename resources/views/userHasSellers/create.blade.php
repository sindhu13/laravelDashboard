@extends('layouts.app')

@section('title', '| Create New User Has Seller')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add User Has Seller</h1>
  <hr>
    <div class="panel-body">
      {!! Form::open(array('url' => 'userHasSellers')) !!}
      {{Form::hidden('marketing_id', $id)}}
      <div class="form-group">
        {{Form::label('employee_id', 'Seller')}}
        {{Form::select('employee_id', $employees, '', ['class' => 'form-control', 'placeholder' => 'Enter Seller'])}}
      </div>
      <div class="form-group">
        {{Form::label('begin_work', 'Begin Work')}}
        {{Form::text('begin_work', '', ['class' => 'form-control', 'placeholder' => 'Enter Begin Work'])}}
      </div>
      {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
      <a class="btn btn-primary" href="{{ route('userHasSellers.index') }}">Cancel</a>
      {!! Form:: close() !!}
    </div>
</div>
@endsection
