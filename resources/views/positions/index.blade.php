{{-- \resources\views\positions\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Positions')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> Positions <a href="{{ route('positions.create') }}" class="btn btn-default pull-right">Add Positions</a></h1>
  <hr>
  <div class="table-responsive">
      <table class="table table-bordered table-striped">

          <thead>
              <tr>
                <th>No</th>
                <th>Position</th>
                <th>Last Modified</th>
                <th>Operations</th>
              </tr>
          </thead>

          <tbody>
              @php ($i = 0)
              @foreach ($positions as $position)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $position->position }}</td>
                <td>{{ date('d m Y', strtotime($position->created_at))}}</td>
                <td>
                <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['positions.destroy', $position->id], 'class' => 'delete' ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-center">
          {!! $positions->links() !!}
      </div>
  </div>
</div>

<script>
  $(".delete").on("submit", function(){
    return confirm("Do you want to delete this item ?");
  });
</script>
@endsection
