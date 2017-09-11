@extends('layouts.app')

@section('title', '| Create New Stock')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>
  <h1><i class='fa fa-user-plus'></i> Add Stock</h1>
  <hr>
    <div class="panel-body">
      {!! Form::open(array('url' => 'stocks')) !!}
      <div class="form-group">
        {{Form::label('po_number', 'PO Number')}}
        {{Form::text('po_number', '', ['class' => 'form-control', 'placeholder' => 'Enter PO Number'])}}
      </div>
      <div class="form-group">
        {{Form::label('po_date', 'PO Date')}}
        {{Form::text('po_date', '', ['class' => 'form-control', 'placeholder' => 'Enter PO Date'])}}
      </div>
      <div class="form-group">
        {{Form::label('po_csi', 'PO CSI')}}
        {{Form::text('po_csi', '', ['class' => 'form-control', 'placeholder' => 'Enter PO CSI Number'])}}
      </div>
      <div class="form-group">
        {{Form::label('location_id', 'Physical Location')}}
        {{Form::select('location_id', $locations, '', ['class' => 'form-control', 'placeholder' => 'Enter Physical Location'])}}
      </div>
      <div class="form-group">
        {{Form::label('vendor_id', 'Vendor name')}}
        {{Form::select('vendor_id', $vendors, '', ['class' => 'form-control', 'placeholder' => 'Enter Vendor Name'])}}
      </div>
      <div class="form-group">
        {{Form::label('unit_id', 'Unit Type')}}
        <select name="unit_id" class="form-control">
        <option selected="selected" disabled="disabled" hidden="hidden" value="">Enter Unit Type</option>
        @foreach($units as $unit)
          <option value="{{ $unit['id']}}">{{$unit['unit'].' - '.$unit['suffix']}}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        {{Form::label('chassis', 'Chassis')}}
        {{Form::text('chassis', '', ['class' => 'form-control', 'placeholder' => 'Enter Chassis'])}}
      </div>
      <div class="form-group">
        {{Form::label('engine', 'Engine')}}
        {{Form::text('engine', '', ['class' => 'form-control', 'placeholder' => 'Enter Engine'])}}
      </div>
      <div class="form-group">
        {{Form::label('color_id', 'Color')}}
        <select name="color_id" class="form-control">
        <option selected="selected" disabled="disabled" hidden="hidden" value="">Enter Color</option>
        @foreach($colors as $color)
          <option value="{{ $color['id']}}">{{$color['color'].' - '.$color['code']}}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        {{Form::label('year', 'Year')}}
        {{Form::selectyear('year', date("Y", strtotime(\Carbon\Carbon::now())), 2013, '', ['class' => 'form-control'])}}
      </div>
      <div class="form-group">
        {{Form::label('position_id', 'Position')}}
        {{Form::select('position_id', $positions, '', ['class' => 'form-control', 'placeholder' => 'Enter Position'])}}
      </div>
      <div class="form-group">
        {{Form::label('alocation_id', 'Alocation')}}
        {{Form::select('alocation_id', $positions, '', ['class' => 'form-control', 'placeholder' => 'Enter Alocation'])}}
      </div>
      <div class="form-group">
        {{Form::label('alocation_day', 'Alocation Day')}}
        {{Form::select('alocation_day', [ "Sunday" => "Sunday", "Monday" => "Monday", "Tuesday" => "Tuesday", "Wednesday" => "Wednesday", "Thursday" => "Thursday", "Friday" => "Friday", "Saturday" => "Saturday" ], '', ['class' => 'form-control', 'placeholder' => 'Enter Alocation Day'])}}
      </div>
      <div class="form-group">
        {{Form::label('alocation_date', 'Alocation Date')}}
        {{Form::text('alocation_date', '', ['class' => 'form-control', 'placeholder' => 'Enter Alocation Date'])}}
      </div>
      <div class="form-group">
        {{Form::label('seller_id', 'Seller')}}
        <select name="seller_id" class="form-control">
        <option selected="selected" disabled="disabled" hidden="hidden" value="">Enter Seller</option>
        @foreach($marketings as $marketing)
          <optgroup label="{{ $marketing->name}}">
            @foreach($userHasSellers as $userHasSeller)
              @if($marketing->id == $userHasSeller->marketing_id)
              <option value="{{ $userHasSeller->id}}">{{$userHasSeller->seller}}</option>
              @endif
            @endforeach
          </optgroup>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        {{Form::label('consumer', 'Customer')}}
        {{Form::text('consumer', '', ['class' => 'form-control', 'placeholder' => 'Enter Customer'])}}
      </div>
      <div class="form-group">
        {{Form::label('leasing_id', 'Leasing')}}
        {{Form::select('leasing_id', $leasings, '', ['class' => 'form-control', 'placeholder' => 'Enter Leasing'])}}
      </div>
      <div class="form-group">
        {{Form::label('status_id', 'Status')}}
        {{Form::select('status_id', $status, '', ['class' => 'form-control', 'placeholder' => 'Enter Status'])}}
      </div>
      {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
      <a class="btn btn-primary" href="{{ route('stocks.index') }}">Cancel</a>
      {!! Form:: close() !!}
    </div>
</div>
{{--dd($colors)--}}

@endsection
