{{-- \resources\views\userHasSellers\index.blade.php --}}
@extends('layouts.app')

@section('title', '| User Has Sellers')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> User Has Sellers <a href="{{ route('userHasSellers.create') }}" class="btn btn-default pull-right">Add User Has Sellers</a></h1>
  <hr>
  <div class="table-responsive">
      <table class="table table-bordered table-striped">

          <thead>
              <tr>
                <th>No</th>
                <th>User Has Seller</th>
                <th>Position</th>
                <th>Last Modified</th>
                <th>Operations</th>
              </tr>
          </thead>

          <tbody>
              @php ($i = 0)
              @foreach ($userHasSellers as $userHasSeller)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $userHasSeller->name }}</td>
                <td>{{ $userHasSeller->position }}</td>
                <td>{{ date('d m Y', strtotime($userHasSeller->created_at))}}</td>
                <td>
                <a href="{{ route('userHasSellers.edit', $userHasSeller->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                <a href="{{ route('userHasSellers.show', $userHasSeller->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Show</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['userHasSellers.destroy', $userHasSeller->id], 'class' => 'delete' ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-center">
          {!! $userHasSellers->links() !!}
      </div>
  </div>
</div>

<script>
  $(".delete").on("submit", function(){
    return confirm("Do you want to delete this item ?");
  });
</script>
@endsection
