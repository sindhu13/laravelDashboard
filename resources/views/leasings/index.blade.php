{{-- \resources\views\leasings\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Users')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> Leasings <a href="{{ route('leasings.create') }}" class="btn btn-default pull-right">Add Leasings</a></h1>
  <hr>
  <div class="table-responsive">
      <table class="table table-bordered table-striped">

          <thead>
              <tr>
                <th>No</th>
                <th>Leasing</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Last Modified</th>
                <th>Operations</th>
              </tr>
          </thead>

          <tbody>
              @php ($i = 0)
              @foreach ($leasings as $leasing)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $leasing->leasing }}</td>
                <td>{{ $leasing->address }}</td>
                <td>{{ $leasing->phone }}</td>
                <td>{{ date('d m Y', strtotime($leasing->created_at))}}</td>
                <td>
                <a href="{{ route('leasings.edit', $leasing->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['leasings.destroy', $leasing->id], 'class' => 'delete' ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-center">
          {!! $leasings->links() !!}
      </div>
  </div>
</div>

<script>
  $(".delete").on("submit", function(){
    return confirm("Do you want to delete this item ?");
  });
</script>
@endsection
