@extends('layouts.app')

@section('title', '| Create New Post')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add Leasing</h1>
  <hr>
    <div class="panel-body">
        {!! Form::open(array('url' => 'leasings')) !!}
          <div class="form-group">
            {{Form::label('leasing', 'Leasing')}}
            {{Form::text('leasing', '', ['class' => 'form-control', 'placeholder' => 'Enter Leasing'])}}
          </div>
          <div class="form-group">
            {{Form::label('address', 'Address')}}
            {{Form::textarea('address', '', ['class' => 'form-control', 'placeholder' => 'Enter Address'])}}
          </div>
          <div class="form-group">
            {{Form::label('phone', 'Phone')}}
            {{Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'Enter Phone'])}}
          </div>
            {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
            <a class="btn btn-primary" href="{{ route('leasings.index') }}">Cancel</a>
            {!! Form:: close() !!}
    </div>
</div>
@endsection
