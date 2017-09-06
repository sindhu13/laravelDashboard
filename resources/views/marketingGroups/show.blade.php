@extends('layouts.app')

@section('title', '| View Marketing Group')

@section('content')

<div class="container">
    @foreach($marketingGroups as $marketingGroup)
    <h1>Group Marketing {{ $marketingGroup->name }}</h1>
    <h2>Supervisor : {{ $marketingGroup->spv }}</h2>
        @php ($idm = $marketingGroup->id)
    @endforeach
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['marketingGroups.destroy', 1] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Seller')
    <a href="{{ route('marketingGroups.edit', 1) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Seller')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}
<br/>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">

          <thead>
              <tr>
                <th>No</th>
                <th>Employee</th>
                <th>Position</th>
                <th>Last Modified</th>
                <th>Operations</th>
              </tr>
          </thead>

          <tbody>
              @php ($i = 0)
              @foreach ($sellers as $seller)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $seller->name }}</td>
                <td>{{ $seller->position }}</td>
                <td>{{ date('d m Y', strtotime($seller->created_at))}}</td>
                <td>
                <a href="{{ route('userHasSellers.edit', $seller->uhs_id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['userHasSellers.destroy', $seller->uhs_id], 'class' => 'delete' ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>
    <a href="{{ URL::to('userHasSellers/create/'.$idm) }}" class="btn btn-success">Add Seller</a>
        
</div>
{{-- dd($sellers) --}}
@endsection
