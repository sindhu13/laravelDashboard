@extends('layouts.app')

@section('title', '| Create New Employee')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add Employee</h1>
  <hr>
    <div class="panel-body">
      {!! Form::open(array('url' => 'employees')) !!}
      <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter Name'])}}
      </div>
      <div class="form-group">
        {{Form::label('phone', 'Phone')}}
        {{Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'Enter Phone'])}}
      </div>
      <div class="form-group">
        {{Form::label('address', 'Address')}}
        {{Form::textarea('address', '', ['class' => 'form-control', 'placeholder' => 'Enter Address'])}}
      </div>
      <div class="form-group">
        {{Form::label('position', 'Position')}}
        {{Form::text('position', '', ['class' => 'form-control', 'placeholder' => 'Enter Position'])}}
      </div>
      <div class="form-group">
        {{Form::label('begin_work', 'Begin Work')}}
        {{Form::text('begin_work', '', ['class' => 'form-control', 'placeholder' => 'Enter Begin Work'])}}
      </div>
      {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
      <a class="btn btn-primary" href="{{ route('employees.index') }}">Cancel</a>
      {!! Form:: close() !!}
    </div>
</div>
@endsection
