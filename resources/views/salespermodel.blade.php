@extends('layouts.app')

@section('title', '| Sales Per Model Unit')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> Sales Per Unit </h1>
  <hr>
  {!! Form::open(['method' => 'get', 'url' => '/salespermodel', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
  @php($now = Carbon\Carbon::now())
  {{ Form::selectYear('yearsearch', $now->year, 2015, $now->year, ['class' => 'form-control']) }}
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
            <th>Model</th>
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
          @php($gvars = array(
            'jan' => array('month' => 1, 'tot' => 0), 'feb' => array('month' => 2, 'tot' => 0), 'mar' => array('month' => 3, 'tot' => 0),
            'apr' => array('month' => 4, 'tot' => 0), 'mei' => array('month' => 5, 'tot' => 0), 'jun' => array('month' => 6, 'tot' => 0),
            'jul' => array('month' => 7, 'tot' => 0), 'aug' => array('month' => 8, 'tot' => 0), 'sep' => array('month' => 9, 'tot' => 0),
            'oct' => array('month' => 10, 'tot' => 0), 'nov' => array('month' => 11, 'tot' => 0), 'dec' => array('month' => 12, 'tot' => 0),
          ))
          @php($gsstot = 0)
          @foreach($unitmodels as $model)
            @php($vars = array(
              'jan' => array('month' => 1, 'tot' => 0), 'feb' => array('month' => 2, 'tot' => 0), 'mar' => array('month' => 3, 'tot' => 0),
              'apr' => array('month' => 4, 'tot' => 0), 'mei' => array('month' => 5, 'tot' => 0), 'jun' => array('month' => 6, 'tot' => 0),
              'jul' => array('month' => 7, 'tot' => 0), 'aug' => array('month' => 8, 'tot' => 0), 'sep' => array('month' => 9, 'tot' => 0),
              'oct' => array('month' => 10, 'tot' => 0), 'nov' => array('month' => 11, 'tot' => 0), 'dec' => array('month' => 12, 'tot' => 0),
            ))
            @php($sstot = 0)
            @foreach($sales as $sale)
              @if($sale->id == $model->id)
                @if($sale->m == 1)
                  @php($vars['jan']['tot'] = $sale->tot)
                  @php($gvars['jan']['tot'] += $sale->tot)
                @elseif($sale->m == 2)
                  @php($vars['feb']['tot'] = $sale->tot)
                  @php($gvars['feb']['tot'] += $sale->tot)
                @elseif($sale->m == 3)
                  @php($vars['mar']['tot'] = $sale->tot)
                  @php($gvars['mar']['tot'] += $sale->tot)
                @elseif($sale->m == 4)
                  @php($vars['apr']['tot'] = $sale->tot)
                  @php($gvars['apr']['tot'] += $sale->tot)
                @elseif($sale->m == 5)
                  @php($vars['mei']['tot'] = $sale->tot)
                  @php($gvars['mei']['tot'] += $sale->tot)
                @elseif($sale->m == 6)
                  @php($vars['jun']['tot'] = $sale->tot)
                  @php($gvars['jun']['tot'] += $sale->tot)
                @elseif($sale->m == 7)
                  @php($vars['jul']['tot'] = $sale->tot)
                  @php($gvars['jul']['tot'] += $sale->tot)
                @elseif($sale->m == 8)
                  @php($vars['aug']['tot'] = $sale->tot)
                  @php($gvars['aug']['tot'] += $sale->tot)
                @elseif($sale->m == 9)
                  @php($vars['sep']['tot'] = $sale->tot)
                  @php($gvars['sep']['tot'] += $sale->tot)
                @elseif($sale->m == 10)
                  @php($vars['oct']['tot'] = $sale->tot)
                  @php($gvars['oct']['tot'] += $sale->tot)
                @elseif($sale->m == 11)
                  @php($vars['nov']['tot'] = $sale->tot)
                  @php($gvars['nov']['tot'] += $sale->tot)
                @elseif($sale->m == 11)
                  @php($vars['dec']['tot'] = $sale->tot)
                  @php($gvars['dec']['tot'] += $sale->tot)
                @endif
                @php($sstot += $sale->tot)
                @php($year = $sale->y)
              @endif
            @endforeach {{-- End Foreach Sales --}}
            @php($gsstot += $sstot)
            <tr>
              <td style="font-weight: bold;">{{ $model->name }}</td>
              <td>{{ $vars['jan']['tot'] }}</td><td>{{ $vars['feb']['tot'] }}</td><td>{{ $vars['mar']['tot'] }}</td><td>{{ $vars['apr']['tot'] }}</td>
              <td>{{ $vars['mei']['tot'] }}</td><td>{{ $vars['jun']['tot'] }}</td><td>{{ $vars['jul']['tot'] }}</td><td>{{ $vars['aug']['tot'] }}</td>
              <td>{{ $vars['sep']['tot'] }}</td><td>{{ $vars['oct']['tot'] }}</td><td>{{ $vars['nov']['tot'] }}</td><td>{{ $vars['dec']['tot'] }}</td>
              <td style="font-weight: bold;">{{ $sstot }}</td>
            </tr>
          @endforeach {{-- End Foreach Models --}}
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
