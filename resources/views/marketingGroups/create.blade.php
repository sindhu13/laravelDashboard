@extends('layouts.app')

@section('title', '| Create New Marketing Group')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add Marketing Group</h1>
  <hr>
    <div class="panel-body">
      {!! Form::open(array('url' => 'marketingGroups')) !!}
      <div class="form-group">
        {{Form::label('name', 'Group Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter Group Name'])}}
      </div>
      <div class="form-group">
        {{Form::label('spv_id', 'Supervisor')}}
        {{Form::select('spv_id', $employees, '', ['class' => 'form-control', 'placeholder' => 'Enter Supervisor'])}}
      </div>
      {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
      <a class="btn btn-primary" href="{{ route('employees.index') }}">Cancel</a>
      {!! Form:: close() !!}
    </div>
</div>
@endsection
