@extends('layouts.app')

@section('title', '| Edit Stock')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$stock->name}}</h1>
    <hr>

    {{ Form::model($stock, array('route' => array('stocks.update', $stock->id), 'method' => 'PUT')) }}
    <div class="form-group">
        {{Form::label('po_number', 'PO Number')}}
        {{Form::text('po_number', null, ['class' => 'form-control', 'placeholder' => 'Enter PO Number'])}}
      </div>
      <div class="form-group">
        {{Form::label('po_date', 'PO Date')}}
        {{Form::text('po_date', null, ['class' => 'form-control', 'placeholder' => 'Enter PO Date'])}}
      </div>
      <div class="form-group">
        {{Form::label('po_csi', 'PO CSI')}}
        {{Form::text('po_csi', null, ['class' => 'form-control', 'placeholder' => 'Enter PO CSI Number'])}}
      </div>
      <div class="form-group">
        {{Form::label('location_id', 'Physical Location')}}
        {{Form::select('location_id', $locations, null, ['class' => 'form-control', 'placeholder' => 'Enter Physical Location'])}}
      </div>
      <div class="form-group">
        {{Form::label('vendor_id', 'Vendor name')}}
        {{Form::select('vendor_id', $vendors, null, ['class' => 'form-control', 'placeholder' => 'Enter Vendor Name'])}}
      </div>
      <div class="form-group">
        {{Form::label('unit_id', 'Unit Type')}}        
        <select name="unit_id" class="form-control">
        <option selected="selected" disabled="disabled" hidden="hidden" value="">Enter Unit Type</option>
        @foreach($units as $unit)
            @php ($isselectedu = '')
            @if($unit['id'] == $stock->unit_id)
                @php ($isselectedu = 'selected')
            @endif
                <option value="{{ $unit['id']}}" {{ $isselectedu }}>{{$unit['unit'].' - '.$unit['suffix']}}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        {{Form::label('chassis', 'Chassis')}}
        {{Form::text('chassis', null, ['class' => 'form-control', 'placeholder' => 'Enter Chassis'])}}
      </div>
      <div class="form-group">
        {{Form::label('engine', 'Engine')}}
        {{Form::text('engine', null, ['class' => 'form-control', 'placeholder' => 'Enter Engine'])}}
      </div>
      <div class="form-group">
        {{Form::label('color_id', 'Color')}}
        <select name="color_id" class="form-control">
        <option selected="selected" disabled="disabled" hidden="hidden" value="">Enter Color</option>
        @foreach($colors as $color)
            @php ($isselectedc = '')
            @if($color['id'] == $stock->color_id)
                @php ($isselectedc = 'selected')
            @endif
          <option value="{{ $color['id']}}" {{$isselectedc}}>{{$color['color'].' - '.$color['code']}}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        {{Form::label('year', 'Year')}}
        {{Form::selectyear('year', date("Y", strtotime(\Carbon\Carbon::now())), 2013, null, ['class' => 'form-control'])}}
      </div>
      <div class="form-group">
        {{Form::label('position_id', 'Position')}}
        {{Form::select('position_id', $positions, null, ['class' => 'form-control', 'placeholder' => 'Enter Position'])}}
      </div>
      <div class="form-group">
        {{Form::label('alocation_id', 'Alocation')}}
        {{Form::select('alocation_id', $alocations, null, ['class' => 'form-control', 'placeholder' => 'Enter Alocation'])}}
      </div>
      <div class="form-group">
        {{Form::label('alocation_day', 'Alocation Day')}}
        @php ($days = array("Sunday" => "Sunday", "Monday" => "Monday", "Tuesday" => "Tuesday", "Wednesday" => "Wednesday", "Thursday" => "Thursday", "Friday" => "Friday", "Saturday" => "Saturday"))
        {{Form::select('alocation_day', $days, null, ['class' => 'form-control', 'placeholder' => 'Enter Alocation Day'])}}
      </div>
      <div class="form-group">
        {{Form::label('alocation_date', 'Alocation Date')}}
        {{Form::text('alocation_date', null, ['class' => 'form-control', 'placeholder' => 'Enter Alocation Date'])}}
      </div>
      <div class="form-group">
        {{Form::label('seller_id', 'Seller')}}
        <select name="seller_id" class="form-control">
        <option selected="selected" disabled="disabled" hidden="hidden" value="">Enter Seller</option>
        @foreach($marketings as $marketing)
          <optgroup label="{{ $marketing->name}}">
            @foreach($userHasSellers as $userHasSeller)
              @if($marketing->id == $userHasSeller->marketing_id)
                @php($selectseller = '')
                @if($userHasSeller->id == $stock->seller_id)
                    @php($selectseller = 'selected')
                @endif
              <option value="{{ $userHasSeller->id}}" {{$selectseller}}>{{$userHasSeller->seller}}</option>
              @endif
            @endforeach
          </optgroup>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        {{Form::label('consumer', 'Customer')}}
        {{Form::text('consumer', null, ['class' => 'form-control', 'placeholder' => 'Enter PO Customer'])}}
      </div>
      <div class="form-group">
        {{Form::label('leasing_id', 'Leasing')}}
        {{Form::select('leasing_id', $leasings, null, ['class' => 'form-control', 'placeholder' => 'Enter Leasing'])}}
      </div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
</div>
@endsection
