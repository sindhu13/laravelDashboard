{{-- \resources\views\stocks\index.blade.php --}}
@extends('layouts.app')

@section('title', '| HOME')

@section('content')

<div class="col-lg-2 col-lg-offset-1">
  <h2>Stock</h2>
  <div style="font-size:50px; color:#0074D9;">{{$tst[0]}}</div>
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
  <h2>Sales</h2>
  <div class="table-responsive">
    <table class="table table-bordered table-striped" style="background-color: #f2f2f2;">
        <thead>
            <tr style="background-color: #e6e6e6;">
                <th>Team</th>
                <th>January</th>
                <th>February</th>
                <th>March</th>
                <th>April</th>
                <th>May</th>
                <th>June</th>
                <th>July</th>
                <th>August</th>
                <th>September</th>
                <th>October</th>
                <th>November</th>
                <th>December</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
          <?php
            $places = array(
              array('place' => 'KIARACONDONG'),
              array('place' => 'KOPO'),
              array('place' => 'LEMBANG'),
              array('place' => 'SOREANG'),
            );
              $mvars = array(
                  'jan' => array('month' => 1, 'tot' => 0), 'feb' => array('month' => 2, 'tot' => 0), 'mar' => array('month' => 3, 'tot' => 0),
                  'apr' => array('month' => 4, 'tot' => 0), 'mei' => array('month' => 5, 'tot' => 0), 'jun' => array('month' => 6, 'tot' => 0),
                  'jul' => array('month' => 7, 'tot' => 0), 'aug' => array('month' => 8, 'tot' => 0), 'sep' => array('month' => 9, 'tot' => 0),
                  'oct' => array('month' => 10, 'tot' => 0), 'nov' => array('month' => 11, 'tot' => 0), 'dec' => array('month' => 12, 'tot' => 0),
              );
              $msstot = 0;
          ?>
            @foreach($places as $place)
            @php($pvars = array(
                'jan' => array('month' => 1, 'tot' => 0), 'feb' => array('month' => 2, 'tot' => 0), 'mar' => array('month' => 3, 'tot' => 0),
                'apr' => array('month' => 4, 'tot' => 0), 'mei' => array('month' => 5, 'tot' => 0), 'jun' => array('month' => 6, 'tot' => 0),
                'jul' => array('month' => 7, 'tot' => 0), 'aug' => array('month' => 8, 'tot' => 0), 'sep' => array('month' => 9, 'tot' => 0),
                'oct' => array('month' => 10, 'tot' => 0), 'nov' => array('month' => 11, 'tot' => 0), 'dec' => array('month' => 12, 'tot' => 0),
            ))
            @php($psstot = 0)
              <tr style="font-weight: bold; background-color: #e6e6e6;">
                <td colspan = "14" align="center">{{ $place['place'] }}</td>
              </tr>

              @foreach($marketings as $marketing)
                @if($place['place'] == $marketing->place)
                  <tr>
                    @php($sstot = 0)
                    <td style="font-weight: bold;">{{ $marketing->name }}</td>
                    <?php
                        $vars = array(
                            'jan' => array('month' => 1, 'tot' => 0), 'feb' => array('month' => 2, 'tot' => 0), 'mar' => array('month' => 3, 'tot' => 0),
                            'apr' => array('month' => 4, 'tot' => 0), 'mei' => array('month' => 5, 'tot' => 0), 'jun' => array('month' => 6, 'tot' => 0),
                            'jul' => array('month' => 7, 'tot' => 0), 'aug' => array('month' => 8, 'tot' => 0), 'sep' => array('month' => 9, 'tot' => 0),
                            'oct' => array('month' => 10, 'tot' => 0), 'nov' => array('month' => 11, 'tot' => 0), 'dec' => array('month' => 12, 'tot' => 0),
                        );
                    ?>
                    @foreach($sales as $sale)
                      @if($sale->id == $marketing->id)
                        @if($sale->m == 1)
                          @php($vars['jan']['tot'] = $sale->tot)
                          @php($mvars['jan']['tot'] += $sale->tot)
                          @php($pvars['jan']['tot'] += $sale->tot)
                        @elseif($sale->m == 2)
                          @php($vars['feb']['tot'] = $sale->tot)
                          @php($mvars['feb']['tot'] += $sale->tot)
                          @php($pvars['feb']['tot'] += $sale->tot)
                        @elseif($sale->m == 3)
                          @php($vars['mar']['tot'] = $sale->tot)
                          @php($mvars['mar']['tot'] += $sale->tot)
                          @php($pvars['mar']['tot'] += $sale->tot)
                        @elseif($sale->m == 4)
                          @php($vars['apr']['tot'] = $sale->tot)
                          @php($mvars['apr']['tot'] += $sale->tot)
                          @php($pvars['apr']['tot'] += $sale->tot)
                        @elseif($sale->m == 5)
                          @php($vars['mei']['tot'] = $sale->tot)
                          @php($mvars['mei']['tot'] += $sale->tot)
                          @php($pvars['mei']['tot'] += $sale->tot)
                        @elseif($sale->m == 6)
                          @php($vars['jun']['tot'] = $sale->tot)
                          @php($mvars['jun']['tot'] += $sale->tot)
                          @php($pvars['jun']['tot'] += $sale->tot)
                        @elseif($sale->m == 7)
                          @php($vars['jul']['tot'] = $sale->tot)
                          @php($mvars['jul']['tot'] += $sale->tot)
                          @php($pvars['jul']['tot'] += $sale->tot)
                        @elseif($sale->m == 8)
                          @php($vars['aug']['tot'] = $sale->tot)
                          @php($mvars['aug']['tot'] += $sale->tot)
                          @php($pvars['aug']['tot'] += $sale->tot)
                        @elseif($sale->m == 9)
                          @php($vars['sep']['tot'] = $sale->tot)
                          @php($mvars['sep']['tot'] += $sale->tot)
                          @php($pvars['sep']['tot'] += $sale->tot)
                        @elseif($sale->m == 10)
                          @php($vars['oct']['tot'] = $sale->tot)
                          @php($mvars['oct']['tot'] += $sale->tot)
                          @php($pvars['oct']['tot'] += $sale->tot)
                        @elseif($sale->m == 11)
                          @php($vars['nov']['tot'] = $sale->tot)
                          @php($mvars['nov']['tot'] += $sale->tot)
                          @php($pvars['nov']['tot'] += $sale->tot)
                        @elseif($sale->m == 11)
                          @php($vars['dec']['tot'] = $sale->tot)
                          @php($mvars['dec']['tot'] += $sale->tot)
                          @php($pvars['dec']['tot'] += $sale->tot)
                        @endif
                        @php($sstot += $sale->tot)
                        @php($psstot += $sstot)
                        @php($msstot += $sstot)
                      @endif
                    @endforeach
                    <td>{{ $vars['jan']['tot'] }}</td><td>{{ $vars['feb']['tot'] }}</td><td>{{ $vars['mar']['tot'] }}</td><td>{{ $vars['apr']['tot'] }}</td>
                    <td>{{ $vars['mei']['tot'] }}</td><td>{{ $vars['jun']['tot'] }}</td><td>{{ $vars['jul']['tot'] }}</td><td>{{ $vars['aug']['tot'] }}</td>
                    <td>{{ $vars['sep']['tot'] }}</td><td>{{ $vars['oct']['tot'] }}</td><td>{{ $vars['nov']['tot'] }}</td><td>{{ $vars['dec']['tot'] }}</td>
                    <td style="font-weight: bold;">{{ $sstot }}</td>
                  </tr>
                @endif
              @endforeach

              <tr style="font-weight: bold;">
                <td>TOTAL</td>
                <td>{{ $pvars['jan']['tot'] }}</td><td>{{ $pvars['feb']['tot'] }}</td><td>{{ $pvars['mar']['tot'] }}</td><td>{{ $pvars['apr']['tot'] }}</td>
                <td>{{ $pvars['mei']['tot'] }}</td><td>{{ $pvars['jun']['tot'] }}</td><td>{{ $pvars['jul']['tot'] }}</td><td>{{ $pvars['aug']['tot'] }}</td>
                <td>{{ $pvars['sep']['tot'] }}</td><td>{{ $pvars['oct']['tot'] }}</td><td>{{ $pvars['nov']['tot'] }}</td><td>{{ $mvars['dec']['tot'] }}</td>
                <td>{{ $psstot }}</td>
              </tr>
              <tr>
                <td colspan="14">&nbsp;</td>
              </tr>
            @endforeach

            <tr style="font-weight: bold;">
              <td>GRANT TOTAL</td>
              <td>{{ $mvars['jan']['tot'] }}</td><td>{{ $mvars['feb']['tot'] }}</td><td>{{ $mvars['mar']['tot'] }}</td><td>{{ $mvars['apr']['tot'] }}</td>
              <td>{{ $mvars['mei']['tot'] }}</td><td>{{ $mvars['jun']['tot'] }}</td><td>{{ $mvars['jul']['tot'] }}</td><td>{{ $mvars['aug']['tot'] }}</td>
              <td>{{ $mvars['sep']['tot'] }}</td><td>{{ $mvars['oct']['tot'] }}</td><td>{{ $mvars['nov']['tot'] }}</td><td>{{ $mvars['dec']['tot'] }}</td>
              <td>{{ $msstot }}</td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
@endsection
