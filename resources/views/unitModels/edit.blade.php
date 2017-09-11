@extends('layouts.app')

@section('title', '| Edit Unit Model')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$unitModel->name}}</h1>
    <hr>

    {{ Form::model($unitModel, array('route' => array('unitModels.update', $unitModel->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{Form::label('name', 'Unit Model')}}
      {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Unit Model'])}}
    </div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
@endsection
