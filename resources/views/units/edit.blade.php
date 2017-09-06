@extends('layouts.app')

@section('title', '| Edit Unit')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$unit->name}}</h1>
    <hr>

    {{ Form::model($unit, array('route' => array('units.update', $unit->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{Form::label('unit', 'Unit')}}
      {{Form::text('unit', null, ['class' => 'form-control', 'placeholder' => 'Enter Unit'])}}
    </div>
    <div class="form-group">
      {{Form::label('katashiki', 'Katashiki')}}
      {{Form::text('katashiki', null, ['class' => 'form-control', 'placeholder' => 'Enter Katashiki'])}}
    </div>
    <div class="form-group">
      {{Form::label('suffix', 'Suffix')}}
      {{Form::text('suffix', null, ['class' => 'form-control', 'placeholder' => 'Enter Suffix'])}}
    </div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
@endsection
