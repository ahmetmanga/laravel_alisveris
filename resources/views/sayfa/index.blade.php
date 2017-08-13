@extends('sayfa.home')
@section('title')Anasayfa @endsection
@section('sol_bolum')
  @include('sayfa.sol')
@endsection

@section('degisken')
  <div class="col-md-9">

    @include('sayfa.urun_order')
  </div>
@endsection
