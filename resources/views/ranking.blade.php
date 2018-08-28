<div style="overflow:hidden;">
  <div class="" style="max-width: 500px; float:left;">
    <h2>Ranking</h2>
    <div class="table-responsive">
      <table class="table table-bordered table-striped" style="background-color: #f2f2f2;">
        <thead>
          <tr style="background-color: #e6e6e6;">
            <th>Ranking</th>
            <th>Team</th>
            <th>Total</th>
          </tr>
        </thead>

        <tbody>
          @php($i = 0)
          @foreach($sales as $sale)
          @php($i++)
            <tr>
              <td>{{ $i }}</td>
              <td style="font-weight: bold;">{{ $sale->name }}</td>
              <td>{{ $sale->tot }}</td>
            </tr>
          @endforeach

          @foreach($marketings as $marketing)
          @php($name = 'f')
          @php($t = $marketing->name)
            @foreach($sales as $sale)
              @if($name == 'f')
                @if($sale->id == $marketing->id)
                  @php($name = 't')
                @endif
              @endif
            @endforeach
            @if($name == 'f')
            <tr>
              @php($i++)
              <td>{{ $i }}</td>
              <td style="font-weight: bold;">{{ $t }}</td>
              <td>0</td>
            </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>


  <div class="" style="max-width: 500px; float:right;">
    <h2>Daily Activity</h2>
    <div class="table-responsive">
      <table class="table table-bordered table-striped" style="background-color: #f2f2f2;">
        <thead>
          <tr style="background-color: #e6e6e6;">
            <th>Sales</th>
            <th>Today</th>
          </tr>
        </thead>

        <tbody>
          @foreach($salesperday as $sale)
            <tr>
              <td style="font-weight: bold;">{{ $sale->name }}</td>
              <td>{{ $sale->tot }}</td>
            </tr>
          @endforeach

          @foreach($sellers as $seller)
          @php($name = 'f')
          @php($t = $seller->name)
            @foreach($salesperday as $sale)
              @if($name == 'f')
                @if($sale->id == $seller->id)
                  @php($name = 't')
                @endif
              @endif
            @endforeach
            @if($name == 'f')
            <tr>
              <td style="font-weight: bold;" class="zero">{{ $t }}</td>
              <td>0</td>
            </tr>
            @endif
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
