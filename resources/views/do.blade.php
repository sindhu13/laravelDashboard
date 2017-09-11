{{-- \resources\views\stocks\index.blade.php --}}
@extends('layouts.app')

@section('title', '| HOME')

@section('content')
{{-- dd($ts) --}}

<div class="col-lg-3 col-lg-offset-1">
  <h2>Sales</h2>
  <div style="font-size:50px; color:#0074D9;">{{$ts[0]}}</div>
</div>

<div class="col-lg-10 col-lg-offset-1">
  <div>
    <iframe src ="{{url('/doIframe')}}" frameborder = "0" width = "100%" height = "610px" scrolling = "yes">This is iFrame</iframe>
  </div>
</div>
{{--dd($ts)--}}
@endsection
