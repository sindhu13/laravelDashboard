{{-- \resources\views\stocks\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Stocks')

@section('content')
{{-- dd($stocks) --}}

<div class="col-lg-10 col-lg-offset-1">
{!! Form::open(['method' => 'get', 'url' => 'stocks/', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
{{ Form::text('search', '', ['class' => 'form-control', 'placeholder' => 'Search...']) }}
{{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
{!! Form:: close() !!}
</br></br>
  <h1>
    <i class="fa fa-users"></i> Stocks
    <a href="{{ route('stocks.create') }}" class="btn btn-default pull-right">Add Stocks</a>
  </h1>

  <hr>
  <div class="" style ="height: 450px; overflow-y: scroll;">
    <div class="">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
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
                  <th rowspan="2" style="text-align:center; vertical-align:middle; min-width: 200px">Operation</th>
                </tr>
                <tr>
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
                  <td>
                  <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                  {!! Form::open(['method' => 'DELETE', 'route' => ['stocks.destroy', $stock->id], 'class' => 'delete' ]) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}

                  </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {!! $stocks->links() !!}
        </div>
    </div>
  </div>
</div>
{{--dd($stocks)--}}
@endsection
