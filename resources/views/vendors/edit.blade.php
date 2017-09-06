@extends('layouts.app')

@section('title', '| Edit Vendor')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$vendor->name}}</h1>
    <hr>

    {{ Form::model($vendor, array('route' => array('vendors.update', $vendor->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{Form::label('vendor', 'Vendor')}}
      {{Form::text('vendor', null, ['class' => 'form-control', 'placeholder' => 'Enter Vendor'])}}
    </div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
@endsection
