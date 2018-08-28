@extends('layouts.app')

@section('title', '| Sales Performance')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> Sales Performance </h1>
  <hr>
  {!! Form::open(['method' => 'get', 'url' => '/salesperformance', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
  @php($now = Carbon\Carbon::now())
  {{ Form::selectYear('yearsearch', 2015, $now->year, $now->year, ['class' => 'form-control']) }}
  {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
  {!! Form:: close() !!}</br></br></br>
  <div class="table-responsive">
    <?php
    $n = \Carbon\Carbon::now();
    ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped" style="background-color: #f2f2f2;">
        <thead>
          <tr style="background-color: #e6e6e6;">
            <th>Name</th>
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
          @php($places = array(
            array('place' => 'KIARACONDONG'),
            array('place' => 'KOPO'),
            array('place' => 'LEMBANG'),
            //array('place' => 'SOREANG'),
          ))
          @php($gvars = array(
            'jan' => array('month' => 1, 'tot' => 0), 'feb' => array('month' => 2, 'tot' => 0), 'mar' => array('month' => 3, 'tot' => 0),
            'apr' => array('month' => 4, 'tot' => 0), 'mei' => array('month' => 5, 'tot' => 0), 'jun' => array('month' => 6, 'tot' => 0),
            'jul' => array('month' => 7, 'tot' => 0), 'aug' => array('month' => 8, 'tot' => 0), 'sep' => array('month' => 9, 'tot' => 0),
            'oct' => array('month' => 10, 'tot' => 0), 'nov' => array('month' => 11, 'tot' => 0), 'dec' => array('month' => 12, 'tot' => 0),
          ))
          @php($gsstot = 0)
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
                  <td colspan = "14" style="font-weight: bold;">{{ $marketing->name }}</td>
                </tr>
                @php($mvars = array(
                  'jan' => array('month' => 1, 'tot' => 0), 'feb' => array('month' => 2, 'tot' => 0), 'mar' => array('month' => 3, 'tot' => 0),
                  'apr' => array('month' => 4, 'tot' => 0), 'mei' => array('month' => 5, 'tot' => 0), 'jun' => array('month' => 6, 'tot' => 0),
                  'jul' => array('month' => 7, 'tot' => 0), 'aug' => array('month' => 8, 'tot' => 0), 'sep' => array('month' => 9, 'tot' => 0),
                  'oct' => array('month' => 10, 'tot' => 0), 'nov' => array('month' => 11, 'tot' => 0), 'dec' => array('month' => 12, 'tot' => 0),
                ))
                @php($msstot = 0)
                @foreach($sellers as $seller)
                  @if($seller->marketing_id == $marketing->id)
                    @php($vars = array(
                      'jan' => array('month' => 1, 'tot' => 0), 'feb' => array('month' => 2, 'tot' => 0), 'mar' => array('month' => 3, 'tot' => 0),
                      'apr' => array('month' => 4, 'tot' => 0), 'mei' => array('month' => 5, 'tot' => 0), 'jun' => array('month' => 6, 'tot' => 0),
                      'jul' => array('month' => 7, 'tot' => 0), 'aug' => array('month' => 8, 'tot' => 0), 'sep' => array('month' => 9, 'tot' => 0),
                      'oct' => array('month' => 10, 'tot' => 0), 'nov' => array('month' => 11, 'tot' => 0), 'dec' => array('month' => 12, 'tot' => 0),
                    ))
                    @php($sstot = 0)
                    @php($lasttot = 0)
                    @php($lastmon = 0)
                    @php($year = 0)
                    @foreach($salesper as $sale)
                      @if($sale->id == $seller->id)
                        @if($sale->m == 1)
                          @php($vars['jan']['tot'] = $sale->tot)
                          @php($mvars['jan']['tot'] += $sale->tot)
                          @php($pvars['jan']['tot'] += $sale->tot)
                          @php($gvars['jan']['tot'] += $sale->tot)
                        @elseif($sale->m == 2)
                          @php($vars['feb']['tot'] = $sale->tot)
                          @php($mvars['feb']['tot'] += $sale->tot)
                          @php($pvars['feb']['tot'] += $sale->tot)
                          @php($gvars['feb']['tot'] += $sale->tot)
                        @elseif($sale->m == 3)
                          @php($vars['mar']['tot'] = $sale->tot)
                          @php($mvars['mar']['tot'] += $sale->tot)
                          @php($pvars['mar']['tot'] += $sale->tot)
                          @php($gvars['mar']['tot'] += $sale->tot)
                        @elseif($sale->m == 4)
                          @php($vars['apr']['tot'] = $sale->tot)
                          @php($mvars['apr']['tot'] += $sale->tot)
                          @php($pvars['apr']['tot'] += $sale->tot)
                          @php($gvars['apr']['tot'] += $sale->tot)
                        @elseif($sale->m == 5)
                          @php($vars['mei']['tot'] = $sale->tot)
                          @php($mvars['mei']['tot'] += $sale->tot)
                          @php($pvars['mei']['tot'] += $sale->tot)
                          @php($gvars['mei']['tot'] += $sale->tot)
                        @elseif($sale->m == 6)
                          @php($vars['jun']['tot'] = $sale->tot)
                          @php($mvars['jun']['tot'] += $sale->tot)
                          @php($pvars['jun']['tot'] += $sale->tot)
                          @php($gvars['jun']['tot'] += $sale->tot)
                        @elseif($sale->m == 7)
                          @php($vars['jul']['tot'] = $sale->tot)
                          @php($mvars['jul']['tot'] += $sale->tot)
                          @php($pvars['jul']['tot'] += $sale->tot)
                          @php($gvars['jul']['tot'] += $sale->tot)
                        @elseif($sale->m == 8)
                          @php($vars['aug']['tot'] = $sale->tot)
                          @php($mvars['aug']['tot'] += $sale->tot)
                          @php($pvars['aug']['tot'] += $sale->tot)
                          @php($gvars['aug']['tot'] += $sale->tot)
                        @elseif($sale->m == 9)
                          @php($vars['sep']['tot'] = $sale->tot)
                          @php($mvars['sep']['tot'] += $sale->tot)
                          @php($pvars['sep']['tot'] += $sale->tot)
                          @php($gvars['sep']['tot'] += $sale->tot)
                        @elseif($sale->m == 10)
                          @php($vars['oct']['tot'] = $sale->tot)
                          @php($mvars['oct']['tot'] += $sale->tot)
                          @php($pvars['oct']['tot'] += $sale->tot)
                          @php($gvars['oct']['tot'] += $sale->tot)
                        @elseif($sale->m == 11)
                          @php($vars['nov']['tot'] = $sale->tot)
                          @php($mvars['nov']['tot'] += $sale->tot)
                          @php($pvars['nov']['tot'] += $sale->tot)
                          @php($gvars['nov']['tot'] += $sale->tot)
                        @elseif($sale->m == 11)
                          @php($vars['dec']['tot'] = $sale->tot)
                          @php($mvars['dec']['tot'] += $sale->tot)
                          @php($pvars['dec']['tot'] += $sale->tot)
                          @php($gvars['dec']['tot'] += $sale->tot)
                        @endif
                        @php($sstot += $sale->tot)
                        @php($lasttot = $sale->tot)
                        @php($lastmon = $sale->m)
                        @php($year = $sale->y)
                      @endif
                    @endforeach {{-- End Foreach Salesper --}}
                    @php($msstot += $sstot)
                    @php($psstot += $sstot)
                    @php($gsstot += $sstot)
                    @php($zero = '')
                    @if($lasttot != 0 AND $lastmon == $n->month)
                      @php($zero = '')
                    @else
                      @php($zero = 'zero')
                    @endif
                    <tr>
                      <td style="font-weight: bold;" class="{{ $zero }}">&nbsp;&nbsp;&nbsp;{{ $seller->name }}</td>
                      <td>{!! $vars['apr']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 1, $seller->id)) .'">'. $vars['apr']['tot'] .'</a>' : $vars['apr']['tot'] !!}</td>
                      <td>{!! $vars['jan']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 2, $seller->id)) .'">'. $vars['jan']['tot'] .'</a>' : $vars['jan']['tot'] !!}</td>
                      <td>{!! $vars['feb']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 3, $seller->id)) .'">'. $vars['feb']['tot'] .'</a>' : $vars['feb']['tot'] !!}</td>
                      <td>{!! $vars['mar']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 4, $seller->id)) .'">'. $vars['mar']['tot'] .'</a>' : $vars['mar']['tot'] !!}</td>
                      <td>{!! $vars['mei']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 5, $seller->id)) .'">'. $vars['mei']['tot'] .'</a>' : $vars['mei']['tot'] !!}</td>
                      <td>{!! $vars['jun']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 6, $seller->id)) .'">'. $vars['jun']['tot'] .'</a>' : $vars['jun']['tot'] !!}</td>
                      <td>{!! $vars['jul']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 7, $seller->id)) .'">'. $vars['jul']['tot'] .'</a>' : $vars['jul']['tot'] !!}</td>
                      <td>{!! $vars['aug']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 8, $seller->id)) .'">'. $vars['aug']['tot'] .'</a>' : $vars['aug']['tot'] !!}</td>
                      <td>{!! $vars['sep']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 9, $seller->id)) .'">'. $vars['sep']['tot'] .'</a>' : $vars['sep']['tot'] !!}</td>
                      <td>{!! $vars['oct']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 10, $seller->id)) .'">'. $vars['oct']['tot'] .'</a>' : $vars['oct']['tot'] !!}</td>
                      <td>{!! $vars['nov']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 11, $seller->id)) .'">'. $vars['nov']['tot'] .'</a>' : $vars['nov']['tot'] !!}</td>
                      <td>{!! $vars['dec']['tot'] != 0 ? '<a href="'. url('/detailsales', array($year, 12, $seller->id)) .'">'. $vars['dec']['tot'] .'</a>' : $vars['dec']['tot'] !!}</td>
                      <td style="font-weight: bold;">{{ $sstot }}</td>
                    </tr>
                  @endif {{-- End If Seller --}}
                @endforeach {{-- End Foreach Sellers --}}
                <tr style="font-weight: bold;">
                  <td>TOTAL TEAM</td>
                  <td>{{ $mvars['jan']['tot'] }}</td><td>{{ $mvars['feb']['tot'] }}</td><td>{{ $mvars['mar']['tot'] }}</td><td>{{ $mvars['apr']['tot'] }}</td>
                  <td>{{ $mvars['mei']['tot'] }}</td><td>{{ $mvars['jun']['tot'] }}</td><td>{{ $mvars['jul']['tot'] }}</td><td>{{ $mvars['aug']['tot'] }}</td>
                  <td>{{ $mvars['sep']['tot'] }}</td><td>{{ $mvars['oct']['tot'] }}</td><td>{{ $mvars['nov']['tot'] }}</td><td>{{ $mvars['dec']['tot'] }}</td>
                  <td>{{ $msstot }}</td>
                </tr>
                <tr>
                  <td colspan="14">&nbsp;</td>
                </tr>
              @endif {{-- End If place --}}
            @endforeach {{-- End Foreach Marketings --}}
            <tr style="font-weight: bold;">
              <td>TOTAL PLACE</td>
              <td>{{ $pvars['jan']['tot'] }}</td><td>{{ $pvars['feb']['tot'] }}</td><td>{{ $pvars['mar']['tot'] }}</td><td>{{ $pvars['apr']['tot'] }}</td>
              <td>{{ $pvars['mei']['tot'] }}</td><td>{{ $pvars['jun']['tot'] }}</td><td>{{ $pvars['jul']['tot'] }}</td><td>{{ $pvars['aug']['tot'] }}</td>
              <td>{{ $pvars['sep']['tot'] }}</td><td>{{ $pvars['oct']['tot'] }}</td><td>{{ $pvars['nov']['tot'] }}</td><td>{{ $pvars['dec']['tot'] }}</td>
              <td>{{ $psstot }}</td>
            </tr>
            <tr>
              <td colspan="14">&nbsp;</td>
            </tr>
          @endforeach {{-- End Foreach Places --}}
          <tr style="font-weight: bold;">
            <td>GRAND TOTAL</td>
            <td>{{ $gvars['jan']['tot'] }}</td><td>{{ $gvars['feb']['tot'] }}</td><td>{{ $gvars['mar']['tot'] }}</td><td>{{ $gvars['apr']['tot'] }}</td>
            <td>{{ $gvars['mei']['tot'] }}</td><td>{{ $gvars['jun']['tot'] }}</td><td>{{ $gvars['jul']['tot'] }}</td><td>{{ $gvars['aug']['tot'] }}</td>
            <td>{{ $gvars['sep']['tot'] }}</td><td>{{ $gvars['oct']['tot'] }}</td><td>{{ $gvars['nov']['tot'] }}</td><td>{{ $gvars['dec']['tot'] }}</td>
            <td>{{ $gsstot }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
