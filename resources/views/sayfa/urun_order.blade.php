@if(count($data) !=  0)
  @foreach($data as $result)
    @if(empty($composer_type)) <div class="col-md-4 order"> @else <div class="col-md-12 order"> @endif
      <div class="thumbnail ek_ayar" title="Detay için tıklayınız.">

        <?php
        $resim_explode = explode("*resim*",$result->resim);
        ?>
        @if(strpos($result->resim,"*resim*"))
          <div class="slayt">
            <ul>
              @foreach($resim_explode as $yeni_resim)
                <li><img src="{{$yeni_resim}}" width="200" height="200" onclick="window.location='<?php echo url('/') ?>/urun_detay/{{$result->id}}'"></li>
              @endforeach
            </ul>
          </div>
        @else
            <img src="{{$result->resim}}" width="200" height="200" onclick="window.location='<?php echo url('/') ?>/urun_detay/{{$result->id}}'">

        @endif
        <div class="caption" style="text-align:center;">
          <h4 title="{{ $result->name }}">
            <a href="<?php echo url('/') ?>/urun_detay/{{$result->id}}">
              @if(strlen($result->name) <= 30)
              {{ $result->name }}
            @else
              {{substr($result->name,0,20)}} ...
            @endif
            </a>
          </h4>
          <?php
          $ratings = floor($result->ratings);
           ?>
          <div class="fiyat_anadiv sol-20" onclick="window.location='<?php echo url('/') ?>/urun_detay/{{$result->id}}'">
            @if($result->old_price != 0.00)


                <div class="indirim">
                    %{{ round(100 - (($result->price/$result->old_price)*100)) }}
                </div>
                <div style="float:right; margin-right:5px;">

                    <div class="old_price">
                      {{ $result->old_price }} ₺
                    </div>
                    <div class="price">
                      {{ $result->price }} ₺
                    </div>

                </div>

              @else
                <div class="price" style="text-align:center;">
                  {{ $result->price }} ₺
                </div>
            @endif

          </div>

        </div>
        <div class="ratings puan_renk" style="margin-left:5px;" onclick="window.location='<?php echo url('/') ?>/urun_detay/{{$result->id}}'">

                             <p>
                                 @for($i=0;$i<$ratings;$i++)
                                   <span class="glyphicon glyphicon-star"></span>
                                 @endfor
                                 @for($i=0;$i<5-$ratings;$i++)
                                   <span class="glyphicon glyphicon-star-empty"></span>
                                 @endfor
                             </p>
                         </div>
      </div>
    </div>
  <?php
  unset($resim_explode);
  ?>
  @endforeach
@endif

  @if(empty($composer_type))<div class="col-md-12">
    <div class="panel panel-body sayfa_no" style="text-align:center;">

    </div>@endif
  </div>
