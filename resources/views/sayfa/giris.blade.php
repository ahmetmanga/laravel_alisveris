@extends('sayfa.home')
@section('title')Üye Girişi @endsection
@section('sol_bolum')
  @include('sayfa.sol')
@endsection
@section('degisken')
<div class="col-md-7 col-md-offset-1">

  @include('sayfa.giris_form')
</div>
@endsection
