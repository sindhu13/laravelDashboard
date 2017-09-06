{{-- \resources\views\marketingGroups\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Marketing Groups')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
  <h1><i class="fa fa-users"></i> Marketing Groups <a href="{{ route('marketingGroups.create') }}" class="btn btn-default pull-right">Add Marketing Groups</a></h1>
  <hr>
  <div class="table-responsive">
      <table class="table table-bordered table-striped">

          <thead>
              <tr>
                <th>No</th>
                <th>Marketing Group</th>
                <th>Supervisor</th>
                <th>Last Modified</th>
                <th>Operations</th>
              </tr>
          </thead>

          <tbody>
              @php ($i = 0)
              @foreach ($marketingGroups as $marketingGroup)
              @php ($i++)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $marketingGroup->name }}</td>
                <td>{{ $marketingGroup->name }}</td>
                <td>{{ date('d m Y', strtotime($marketingGroup->created_at))}}</td>
                <td>
                <a href="{{ route('marketingGroups.edit', $marketingGroup->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                <a href="{{ route('marketingGroups.show', $marketingGroup->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Show</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['marketingGroups.destroy', $marketingGroup->id], 'class' => 'delete' ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-center">
          {!! $marketingGroups->links() !!}
      </div>
  </div>
</div>
{{-- dd($marketingGroups) --}}
<script>
  $(".delete").on("submit", function(){
    return confirm("Do you want to delete this item ?");
  });
</script>
@endsection
