@extends('layouts.app')

@section('title', '| Edit User Has Seller')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$userHasSeller->name}}</h1>
    <hr>

    {{ Form::model($userHasSeller, array('route' => array('userHasSellers.update', $userHasSeller->id), 'method' => 'PUT')) }}
    {{Form::hidden('marketing_id', null)}}
        <div class="form-group">
            {{Form::label('employee_id', 'Seller')}}
            {{Form::select('employee_id', $employees, null, ['class' => 'form-control', 'placeholder' => 'Enter Seller'])}}
        </div>
        <div class="form-group">
            {{Form::label('begin_work', 'Begin Work')}}
            {{Form::text('begin_work', null, ['class' => 'form-control', 'placeholder' => 'Enter Begin Work'])}}
        </div>
        <div class="form-group">
            {{Form::label('end_work', 'End Work')}}
            {{Form::text('end_work', null, ['class' => 'form-control', 'placeholder' => 'Enter End Work'])}}
        </div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
@endsection
