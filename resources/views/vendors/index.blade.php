{{-- \resources\views\vendors\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Vendors')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> Vendors <a href="{{ route('vendors.create') }}" class="btn btn-default pull-right">Add Vendors</a></h1>
  <hr>
  <div class="table-responsive">
      <table class="table table-bordered table-striped">

          <thead>
              <tr>
                <th>No</th>
                <th>Vendor</th>
                <th>Last Modified</th>
                <th>Operations</th>
              </tr>
          </thead>

          <tbody>
              @php ($i = 0)
              @foreach ($vendors as $vendor)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $vendor->vendor }}</td>
                <td>{{ date('d m Y', strtotime($vendor->created_at))}}</td>
                <td>
                @can('Edit Vendor')
                <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                @endcan
                {!! Form::open(['method' => 'DELETE', 'route' => ['vendors.destroy', $vendor->id], 'class' => 'delete' ]) !!}
                @can('Delete Vendor')
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                @endcan
                {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-center">
          {!! $vendors->links() !!}
      </div>
  </div>
</div>

<script>
  $(".delete").on("submit", function(){
    return confirm("Do you want to delete this item ?");
  });
</script>
@endsection
