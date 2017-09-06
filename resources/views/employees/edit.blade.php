@extends('layouts.app')

@section('title', '| Edit Employee')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$employee->name}}</h1>
    <hr>

    {{ Form::model($employee, array('route' => array('employees.update', $employee->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{Form::label('name', 'Name')}}
      {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name'])}}
    </div>
    <div class="form-group">
      {{Form::label('phone', 'Phone')}}
      {{Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone'])}}
    </div>
    <div class="form-group">
      {{Form::label('address', 'Address')}}
      {{Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address'])}}
    </div>
    <div class="form-group">
      {{Form::label('position', 'Position')}}
      {{Form::text('position', null, ['class' => 'form-control', 'placeholder' => 'Enter Position'])}}
    </div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
@endsection
