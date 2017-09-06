@extends('layouts.app')

@section('title', '| Create New Unit')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add Unit</h1>
  <hr>
    <div class="panel-body">
      {!! Form::open(array('url' => 'units')) !!}
      <div class="form-group">
        {{Form::label('unit', 'Unit')}}
        {{Form::text('unit', '', ['class' => 'form-control', 'placeholder' => 'Enter Unit'])}}
      </div>
      <div class="form-group">
        {{Form::label('katashiki', 'Katashiki')}}
        {{Form::text('katashiki', '', ['class' => 'form-control', 'placeholder' => 'Enter Katashiki'])}}
      </div>
      <div class="form-group">
        {{Form::label('suffix', 'Suffix')}}
        {{Form::text('suffix', '', ['class' => 'form-control', 'placeholder' => 'Enter Suffix'])}}
      </div>
      {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
      <a class="btn btn-primary" href="{{ route('units.index') }}">Cancel</a>
      {!! Form:: close() !!}
    </div>
</div>
@endsection
