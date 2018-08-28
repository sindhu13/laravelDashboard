{{-- \resources\views\stocks\index.blade.php --}}
@extends('layouts.app')

@section('title', '| HOME')

@section('content')

{{-- dd($tstkc) --}}

<div class="col-lg-2 col-lg-offset-1">
  <h2>Stock</h2>
  <div style="font-size:50px; color:#0074D9;">{{$tst[0]}}</div>
  <div style="font-size:15px; color:#0074D9;"><a href="{{url('/stockbranch/')}}">{{'SG Stock '. $tstkc[0]}}</a></div>
</div>

<div class="col-lg-2 col-lg-offset-1">
  <h2>Supplies</h2>
  <div style="font-size:50px; color:#0074D9;"><a href="{{url('/supply/')}}">{{$tsp[0]}}</a></div>
</div>

<div class="col-lg-2 col-lg-offset-1">
  <h2>Sales</h2>
  <div style="font-size:50px; color:#0074D9;"><a href="{{url('/do/')}}">{{$tsdo[0]}}</a></div>
</div>

<div class="col-lg-2 col-lg-offset-1">
  <h2>Barter</h2>
  <div style="font-size:50px; color:#0074D9;"><a href="{{url('/barter/')}}">{{$tsdou[0]}}</a></div>
</div>

<div class="col-lg-10 col-lg-offset-1">
{!! Form::open(['method' => 'get', 'url' => '/', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
{{ Form::text('search', '', ['class' => 'form-control', 'placeholder' => 'Search...']) }}
{{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
{!! Form:: close() !!}</br></br></br>
  <div class="" style ="height: 450px; overflow-y: scroll;">
    <div class="">
      <table class="table table-bordered table-striped" style="background-color: #f2f2f2;">
          <thead>
              <tr style="background-color: #e6e6e6;">
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 50px">No</th>
                <th colspan="3" style="text-align:center; vertical-align:middle;">Purchase Invoice</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 200px">Lokasi Fisik</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 230px">Vendor</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 300px">Type</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 170px">Chasis</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 110px">Engine</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 250px">Color</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 70px">Year</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 150px">Posisi Unit</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 150px">Alokasi Unit</th>
                <th colspan="2" style="text-align:center; vertical-align:middle; min-width: 110px">Tangal Alokasi</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 220px">Nama Sales</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 220px">Nama Konsumen</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 100px">Leasing</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 100px">Age</th>
                <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 150px">Status</th>
              </tr>
              <tr style="background-color: #e6e6e6;">
                <th style="text-align:center; vertical-align:middle; min-width: 200px">RRN</th>
                <th style="text-align:center; vertical-align:middle; min-width: 100px">Date</th>
                <th style="text-align:center; vertical-align:middle;">CSI</th>
                <th style="text-align:center; vertical-align:middle;">Hari</th>
                <th style="text-align:center; vertical-align:middle; min-width: 100px">Tanggal</th>
              </tr>
          </thead>

          <tbody>
              @php ($i = 0)
              @foreach ($stocks as $stock)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $stock->po_number }}</td>
                <td>{{ date('d m Y', strtotime($stock->po_date))}}</td>
                <td>{{ $stock->po_csi }}</td>
                <td>{{ $stock->location }}</td>
                <td>{{ $stock->vendor }}</td>
                <td>{{ $stock->unit.' - '. $stock->suffix }}</td>
                <td>{{ $stock->chassis }}</td>
                <td>{{ $stock->engine }}</td>
                <td>{{ $stock->color.' - '. $stock->code }}</td>
                <td>{{ $stock->year }}</td>
                <td>{{ $stock->position}}</td>
                <td>{{ $stock->aloc }}</td>
                <td>{{ $stock->alocation_day }}</td>
                <td>{{ !isset($stock->alocation_date) ? '' : date('d m Y', strtotime($stock->alocation_date)) }}</td>
                <td>{{ $stock->name }}</td>
                <td>{{ $stock->consumer }}</td>
                <td>{{ $stock->leasing }}</td>

                <?php
                $days = 0;
                if(isset($stock->po_date)){
                  $days = (abs(ceil((strtotime($stock->po_date)-strtotime("now"))/86400))) + 1;
                }
                ?>

                <td>{{ $days. ' day' }}</td>
                <td>{{ $stock->status }}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-center">
          {!! $stocks->links() !!}
      </div>
    </div>
  </div>
  </br>





<div class="" style ="width: 100%; background-color:white; overflow: hidden">
  @if(isset(Auth::user()->marketing_id))
    @include('ranking')
    @include('salesperteam')
  @else
    @include('salespersupervisor')
  @endif
</div>

</div>
@endsection
