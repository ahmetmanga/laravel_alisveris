@extends('sayfa.home')
@section('title'){{$title->name}}@endsection
@section('sol_bolum')
  <div class="col-md-3">
    <form class="form-inline" id="filter_form" action="<?php echo url('/') ?>/filtrele" method="get">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="panel panel-body">
      <h3 class="text-primary top_sifirla">Kategoriler <span class="glyphicon glyphicon-chevron-down"></span></h3>
      <ul class="list-group">
          <input type="hidden" name="kat_id" value="@if(!empty($mevcut_id)) {{$mevcut_id}}, @endif @if(!empty($secilen))@for($i=1;$i<count($secilen)-1;$i++){{ $secilen[$i] }},@endfor @endif">
        @foreach($kat_bilgisi as $kat)
          <li class="list-group-item"><div class="checkbox">
                <label style="font-size: 1em">
                    <input type="checkbox" class="kat_checkbox" name="marka" value="{{ $kat->id}}" @if(!empty($secilen) && in_array($kat->id,$secilen) && !empty($mevcut_id) && $kat->id != $mevcut_id)
                      checked
                    @endif>
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                    {{$kat->name}}
                </label>
            </div></li>
        @endforeach

      </ul>
    </div>
    <div class="panel panel-body" title="Aradığınız ürünle ilgili herhangi bir özelliği girebilirsiniz.">
  <h3 class="text-primary top_sifirla">Aradığınız Özellik <span class="glyphicon glyphicon-chevron-down"></span></h3>
  <hr>
  <p class="text-info">Birden fazla özellik aramak için "," koyun.</p>
  <div class="col-md-12">
    <input type="text" style="width:100%;" class="input-lg" name="anahtar" value="@if(!empty($anahtar_array))@foreach($anahtar_array as $value){{str_replace(["'%","%'"],['',''],$value)}},@endforeach @elseif(!empty($anahtar)){{$anahtar}}@endif" placeholder="Özellik Arayın Örn(8GB,4.5G")">
  </div>


    </div>
    <div class="panel panel-body">
  <h3 class="top_sifirla text-primary">Fiyat Aralığı <span class="glyphicon glyphicon-chevron-down"></span></h3>
  <hr>
  <div class="col-md-6">
    <input type="number" style="width:100%;" class="input-lg" name="en_az" @if(!empty($min)) value="{{ $min }}" @endif placeholder="Minimum">
  </div>
  <div class="col-md-6">
    <input type="number" style="width:100%;" class="input-lg" name="en_cok" @if(!empty($max)) value="{{ $max }}" @endif placeholder="Maximum">
  </div>


    </div>
    <div class="panel panel-body">
  <h3 class="top_sifirla text-primary">Sırala <span class="glyphicon glyphicon-chevron-down"></span></h3>
  <hr>
  <div class="col-md-12">
              <select class="input input-lg" name="sirala" style="width:100%;">
                <option value="fiyat_artan" @if(!empty($sirala) && $sirala == "fiyat_artan") selected @endif>Fiyata göre Artan</option>
                  <option value="fiyat_azalan" @if(!empty($sirala) && $sirala == "fiyat_azalan") selected @endif>Fiyata göre Azalan</option>
      <option value="son_eklenen" @if(!empty($sirala) && $sirala == "son_eklenen") selected @endif>Son Eklenenlere göre</option>
                  <option value="yorum_azalan" @if(!empty($sirala) && $sirala == "yorum_azalan") selected @endif>Yorumlara göre azalan</option>
                    <option value="yorum_artan" @if(!empty($sirala) && $sirala == "yorum_artan") selected @endif>Yorumlara göre artan</option>

              </select>

  </div>


    </div>
    <div class="panel panel-body">
      <button type="submit" name="button" class="btn btn-primary btn-lg fulle">Kriterlere göre Ara <span class="glyphicon glyphicon-search"></span></button>

      </form>
    </div>
  </div>
@endsection

@section('degisken')
  <div class="col-md-9">
    @if(!empty($min) || !empty($max) || !empty($secilen))
      <div class="alert alert-success">
        Seçtiğiniz kriterlere göre aşağıdaki ürünler bulundu.
        <a href="#" class="close" data-dismiss="alert">&times;</a>
      </div>
    @endif
    @include('sayfa.urun_order')
  </div>
@endsection
