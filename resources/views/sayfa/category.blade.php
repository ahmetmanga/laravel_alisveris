<div class="row">
<div class="col-md-12">
  <nav  class="navbar navbar-default kat_desktop" id="alt" style="margin-top:0px;">
    <button class="navbar-toggle" data-toggle="collapse" data-target="#menuackapa"><div class="icon-bar"></div><div class="icon-bar"></div> <div class="icon-bar"></div></button>
    <div class="collapse navbar-collapse" id="menuackapa">
    <ul class="nav navbar-nav">


      @foreach($all_category as $cat)
        <?php
        $alt_kategori = [];
        $kat_id = [];
        $enalt_kategori = [];
        $enkat_id = [];
         ?>
        @if($cat->type == 0 && $cat->view == 1)
          <li class="sub_li"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $cat->name }} <span class="caret"></span></a>
            <div class="dropdown-menu acilir_menu" style="width:650px;">

                  <div class="row">
                    <div class="col-md-4" style="margin-left:10px;">
                      <ul class="list-group hover">
                        @foreach($all_category as $sub_category)
                         @if($sub_category->type == $cat->id && $sub_category->view == 1)
                           <li class="list-group-item kat_isim" style="text-align:center;"><h4 style="color:black;">{{ $sub_category->name }} <span class="glyphicon glyphicon-chevron-right"></span></h4></li>
                           @foreach($all_category as $ikinci)
                             @if($ikinci->type == $sub_category->id && $ikinci->view == 1 && $ikinci->type != $cat->id)
                               <?php
                               array_push($alt_kategori,$ikinci);
                               if(!in_array($sub_category->id,$kat_id)){
                               array_push($kat_id,$sub_category->id);
                             }
                                ?>
                             @endif

                           @endforeach
                         @endif

                         @endforeach

                      </ul>
                    </div>
                  @for($i=0;$i<count($kat_id);$i++)

                    <div class="col-md-4 kat_acilir" style="text-align:center;float:left;margin-left:0px;display:none;">
                      <ul class="list-group hover">
                        @foreach($alt_kategori as $kat)
                          @if($kat_id[$i] == $kat->type && $kat->view == 1)
                          <li class="list-group-item kat_ac"> <a href="<?php echo url('/') ?>/category/{{ $kat->id }}">{{ $kat->name}} <span class="glyphicon glyphicon-chevron-right"></span></a> </li>
                          <?php
                          if(!in_array($kat->id,$enkat_id)){
                            array_push($enkat_id, $kat->id);
                          }
                           ?>
                        @endif
                      @endforeach

                      </ul>
                    </div>

                  @endfor
                  @for($k=0;$k<count($enkat_id);$k++)

                    <div class="col-md-4 kat_alt" style="text-align:center;float:right;margin-left:0px;display:none; width:215px;">
                      <ul class="list-group hover">
                        @foreach($all_category as $cate)
                          @if($enkat_id[$k] == $cate->type)
                            <li class="list-group-item"><a href="<?php echo url('/') ?>/category/{{ $cate->id }}">{{ $cate->name}}</a></li>
                          @endif
                        @endforeach

                      </ul>
                    </div>

                  @endfor
                  </div>






            </div>
          </li>
        @endif
<?php
  unset($alt_kategori);
  unset($kat_id);
  unset($enalt_kategori);
  unset($enkat_id);
 ?>
      @endforeach
    </ul>


    </div>
  </nav>

  {{-- Mobil --}}

  <nav  class="navbar navbar-default kat_mobil" style="margin-top:0px;display:none;">
    <div class="navbar-header">
        <div class="navbar-brand">
          Tüm Kategoriler
        </div>
        <button class="navbar-toggle" data-toggle="collapse" data-target="#menuackapa2"><div class="icon-bar"></div><div class="icon-bar"></div> <div class="icon-bar"></div></button>
    </div>

    <div class="collapse navbar-collapse" id="menuackapa2">
    <ul class="nav navbar-nav">

      @foreach($all_category as $veri)
              @if($veri->type == 0 && $veri->view == 1)
                  <li class="list-group-item"><a href="<?php echo url('/');?>/category/{{$veri->id}}" class="dropdown-toggle" data-toggle="dropdown">{{ $veri->name }} <span class="caret"></span></a>
                  <ul class="nav navbar-nav dropdown-menu">
                @foreach($all_category as $veri2)
                <?php
                $arastir = DB::table("category")->where('id',$veri2->id)->first();
                $arastir_2 = DB::table("category")->where('id',$arastir->type)->first();
                 ?>
                   @if($veri2->type != 0 && $veri2->view == 1 && $arastir_2->type != 0)
                    <li class="list-group-item"><a href="<?php echo url('/');?>/category/{{$veri2->id}}">{{$veri2->name}}</a></li>
                  @endif
                @endforeach
                  </ul>
                </li>

                @endif
      @endforeach
    </ul>
  </div>
  </nav>
</div>
</div>
