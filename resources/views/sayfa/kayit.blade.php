@extends('sayfa.home')
@section('title')Kayıt Ol @endsection
@section('sol_bolum')@include('sayfa.sol') @endsection
@section('degisken')
<div class="col-md-6">
  @if(!empty($hata))

    <div class="alert alert-danger">
      {{ $hata }}
      <a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>
  @endif
  @include('sayfa.kayit_form')
</div>


 <div class="col-md-3">
   @include('sayfa.urun_order')
 </div>
      


@endsection
