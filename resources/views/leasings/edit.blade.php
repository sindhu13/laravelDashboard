@extends('layouts.app')

@section('title', '| Edit Leasing')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$leasing->name}}</h1>
    <hr>

    {{ Form::model($leasing, array('route' => array('leasings.update', $leasing->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{Form::label('leasing', 'Leasing')}}
      {{Form::text('leasing', null, ['class' => 'form-control', 'placeholder' => 'Enter Leasing'])}}
    </div>
    <div class="form-group">
      {{Form::label('address', 'Address')}}
      {{Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address'])}}
    </div>
    <div class="form-group">
      {{Form::label('phone', 'Phone')}}
      {{Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone'])}}
    </div>
    <div class="form-group">
      {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection
