{{-- \resources\views\unitModels\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Unit Models')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> Unit Models <a href="{{ route('unitModels.create') }}" class="btn btn-default pull-right">Add Unit Models</a></h1>
  <hr>
  <div class="table-responsive">
      <table class="table table-bordered table-striped">

          <thead>
              <tr>
                <th>No</th>
                <th>Unit Model</th>
                <th>Last Modified</th>
                <th>Operations</th>
              </tr>
          </thead>

          <tbody>
              @php ($i = 0)
              @foreach ($unitModels as $unitModel)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $unitModel->name }}</td>
                <td>{{ date('d m Y', strtotime($unitModel->created_at))}}</td>
                <td>
                <a href="{{ route('unitModels.edit', $unitModel->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['unitModels.destroy', $unitModel->id], 'class' => 'delete' ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-center">
          {!! $unitModels->links() !!}
      </div>
  </div>
</div>

<script>
  $(".delete").on("submit", function(){
    return confirm("Do you want to delete this item ?");
  });
</script>
@endsection
