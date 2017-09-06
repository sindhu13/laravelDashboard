@extends('layouts.app')

@section('title', '| Edit MarketingGroup')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$marketingGroup->name}}</h1>
    <hr>

    {{ Form::model($marketingGroup, array('route' => array('marketingGroups.update', $marketingGroup->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{Form::label('name', 'Name')}}
      {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('spv_id', 'Supervisor')}}
        {{Form::select('spv_id', $employees, null, ['class' => 'form-control', 'placeholder' => 'Enter Supervisor'])}}
      </div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
@endsection
