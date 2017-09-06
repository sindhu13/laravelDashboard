<!-- @if(count($errors) > 0 )
  @foreach($errors->all() as $error)
    <div class ="alert alert-danger">
      {{$error}}
    </div>
  @endforeach
@endif -->

@if(count($errors) > 0 )
  <div class ="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
