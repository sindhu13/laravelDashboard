@extends('layouts.app')

@section('title', '| Create New Vendor')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add Vendor</h1>
  <hr>
    <div class="panel-body">
      {!! Form::open(array('url' => 'vendors')) !!}
      <div class="form-group">
        {{Form::label('vendor', 'Vendor')}}
        {{Form::text('vendor', '', ['class' => 'form-control', 'placeholder' => 'Enter Vendor'])}}
      </div>
      {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
      <a class="btn btn-primary" href="{{ route('vendors.index') }}">Cancel</a>
      {!! Form:: close() !!}
    </div>
</div>
@endsection
