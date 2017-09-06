{{-- \resources\views\locations\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Locations')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> Locations <a href="{{ route('locations.create') }}" class="btn btn-default pull-right">Add Locations</a></h1>
  <hr>
  <div class="table-responsive">
      <table class="table table-bordered table-striped">

          <thead>
              <tr>
                <th>No</th>
                <th>Location</th>
                <th>Last Modified</th>
                <th>Operations</th>
              </tr>
          </thead>

          <tbody>
              @php ($i = 0)
              @foreach ($locations as $location)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $location->location }}</td>
                <td>{{ date('d m Y', strtotime($location->created_at))}}</td>
                <td>
                <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['locations.destroy', $location->id], 'class' => 'delete' ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-center">
          {!! $locations->links() !!}
      </div>
  </div>
</div>

<script>
  $(".delete").on("submit", function(){
    return confirm("Do you want to delete this item ?");
  });
</script>
@endsection
