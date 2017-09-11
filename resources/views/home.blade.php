{{-- \resources\views\stocks\index.blade.php --}}
@extends('layouts.app')

@section('title', '| HOME')

@section('content')

<div class="col-lg-2 col-lg-offset-1">
  <h2>Stock</h2>
  <div style="font-size:50px; color:#0074D9;">{{$tst[0]}}</div>  
</div>
  
<div class="col-lg-2 col-lg-offset-1">
  <h2>Supplies</h2>
  <div style="font-size:50px; color:#0074D9;"><a href="{{url('/supply/')}}">{{$tsp[0]}}</a></div>
</div>

<div class="col-lg-2 col-lg-offset-1">
  <h2>Sales</h2>
  <div style="font-size:50px; color:#0074D9;"><a href="{{url('/do/')}}">{{$tsdo[0]}}</a></div>
</div>

<div class="col-lg-2 col-lg-offset-1">
  <h2>Barter</h2>
  <div style="font-size:50px; color:#0074D9;"><a href="{{url('/barter/')}}">{{$tsdou[0]}}</a></div>
</div>
  
<div class="col-lg-10 col-lg-offset-1">
  <div>
    <iframe src ="{{url('/homeIframe')}}" frameborder = "0" width = "100%" height = "610px" scrolling = "yes">This is iFrame</iframe>
  </div>
</div>
@endsection
