{{-- \resources\views\colors\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Colors')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> Colors <a href="{{ route('colors.create') }}" class="btn btn-default pull-right">Add Colors</a></h1>
  <hr>
  <div class="table-responsive">
      <table class="table table-bordered table-striped">

          <thead>
              <tr>
                <th>No</th>
                <th>Color</th>
                <th>Code</th>
                <th>Last Modified</th>
                <th>Operations</th>
              </tr>
          </thead>

          <tbody>
              @php ($i = 0)
              @foreach ($colors as $color)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $color->color }}</td>
                <td>{{ $color->code }}</td>
                <td>{{ date('d m Y', strtotime($color->created_at))}}</td>
                <td>
                <a href="{{ route('colors.edit', $color->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['colors.destroy', $color->id], 'class' => 'delete' ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-center">
          {!! $colors->links() !!}
      </div>
  </div>
</div>

<script>
  $(".delete").on("submit", function(){
    return confirm("Do you want to delete this item ?");
  });
</script>
@endsection
