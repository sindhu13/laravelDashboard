{{-- \resources\views\employees\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Employees')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> Employees <a href="{{ route('employees.create') }}" class="btn btn-default pull-right">Add Employees</a></h1>
  <hr>
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
              @foreach ($employees as $employee)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->position }}</td>
                <td>{{ date('d m Y', strtotime($employee->created_at))}}</td>
                <td>
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Show</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['employees.destroy', $employee->id], 'class' => 'delete' ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-center">
          {!! $employees->links() !!}
      </div>
  </div>
</div>

<script>
  $(".delete").on("submit", function(){
    return confirm("Do you want to delete this item ?");
  });
</script>
@endsection
