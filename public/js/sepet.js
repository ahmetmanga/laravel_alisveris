  /* Ahmet Manga tarafindan hazirlanmistir. */
  /* ahmetmanga@gmail.com */
$(document).ready(function() {

  //
  var urun_id;
  var verilistele = function(veri){
    var adet= 0,resim;
    var i= 0;
    var para= 0;
    $("#sepet_data").html("");
    $.each(veri, function(key, value){
      i++;
    var satir = value;
      $("#sepet_data").append('<tr id="'+i+'">');
    $.each(satir, function(key, value){
      if(key == "adet"){
        adet = value;
         $('#'+i).append('<td>'+value+'</td>');
      }else if(key == "fiyat"){
         para += value;
         $('#'+i).append('<td>'+value+' ₺</td>');
      }else if(key == "resim"){
        resim = value;
      }else if(key == "urun_id"){
          urun_id = value;
          $('#'+i).append("<td  title='İşlem gerçekleşmezse sayfayı yenileyip tekrar deneyin.'><button class='btn btn-danger sepet_sil' veri='"+value+"' adet='"+adet+"'><span class='glyphicon glyphicon-remove'></span></button></td>");
       }else if(key == "isim"){
            $('#'+i).append('<td title="'+value+'"><b><a href="http://localhost/blog/urun_detay/'+urun_id+'">'+value.substr(0,15)+'</b></td>');
          }
          });

  });
    $("#sepet").html('<span class="glyphicon glyphicon-shopping-cart"></span> ('+i+') Sepetim | Toplam Tutar : '+para+' ₺');
    $("#sepet_mobil").html("Sepet ("+i+")");
  }
  $("button[name=sepete_ekle]").click(function(event) {
    urun_id = $("input[name=urun_id]").val();
    var adet = $("input[name=adet]").val();
    var extra = $("select[name=extra]").val();
    $.ajax({
      url:'http://localhost/blog/sepete_ekle/'+urun_id+'/'+adet+'/'+extra,
      type:'GET',
      dataType:'json',
      statusCode:{
        404:function(){
          alert("Ajax dosyası bulunamadı");
        }
      },
      success:function(veri){
        if(veri.error){
          alert(veri.error);
        }else{
          verilistele(veri.data);
            $("#sepet_detay").css('display','block');
        }
      },
      error:function(){
        alert("Hata oluştu. Tekrar deneyin.");
      },
      timeout: 4000,
      });
  });
  $("button[name=sepet_bosalt]").click(function(event) {
    $.ajax({
      url:'http://localhost/blog/sepet_bosalt',
      type:'GET',
      dataType:'json',
      statusCode:{
        404:function(){
          alert("Ajax dosyası bulunamadı");
        }
      },
      success:function(veri){
        if(veri.error){
          alert(veri.error);
        }else{
          verilistele(veri.data);
            $("#sepet_detay").css('display','block');
        }
      },
      error:function(){
        alert("Hata oluştu. Tekrar deneyin.");
      },
      timeout: 4000,

      });
  });
  var urun_id,adet;
  $(".sepet_sil").each(function(index, el) {
      $(this).click(function() {
        urun_id = $(this).attr("veri");
        adet = $(this).attr("adet");
        $.ajax({
          url:'http://localhost/blog/sepet_sil/'+urun_id+'/'+adet,
          type:'GET',
          dataType:'json',
          statusCode:{
            404:function(){
              alert("Ajax dosyası bulunamadı");
            }
          },
          success:function(veri){
            if(veri.error){
              alert(veri.error);
            }else{
              $("#sepet_detay").css('display','block');
              location.reload();
            }
          },
          error:function(){
            alert("Hata oluştu. Tekrar deneyin.");
          },
          timeout: 4000,

          });
      });
  });
    var adet_guncelle = function(adet,urun_id){
      $.ajax({
        url:'http://localhost/blog/adet_guncelle/'+urun_id+'/'+adet,
        type:'GET',
        dataType:'json',
        statusCode:{
          404:function(){
            alert("Ajax dosyası bulunamadı");
          }
        },
        success:function(veri){
          if(veri.error){
            alert(veri.error);
          }else{
                location.reload();
              $("#sepet_detay").css('display','block');
          }
        },
        error:function(){
          alert("Hata oluştu. Tekrar deneyin.");
        },
        timeout: 4000,

        });
    }

  			/* adet ayarla */
  			var adet;
  			$(".arttir").each(function(index, el) {
  				$(".arttir:eq("+index+")").click(function(event) {

  						adet = $(".adet_miktari:eq("+index+")").val();
  						adet++;
  						if(adet > 100){
  							$(".adet_miktari:eq("+index+")").val("100");
  						}else{
  							$(".adet_miktari:eq("+index+")").val(adet);
  						}
  					var cls = $(this).attr("class");
  						if(cls.indexOf('ajax') != -1){
  							adet_guncelle($(".adet_miktari:eq("+index+")").val(),$(this).attr("veri"));
  						}
  				});
  			});
  			$(".azalt").each(function(index, el) {
  				$(".azalt:eq("+index+")").click(function(event) {
  						adet = $(".adet_miktari:eq("+index+")").val();
  						adet--;
  						if(adet <= 1){
  							$(".adet_miktari:eq("+index+")").val("1");
  						}else{
  							$(".adet_miktari:eq("+index+")").val(adet);
  						}
  						var cls = $(this).attr("class");
  							if(cls.indexOf('ajax') != -1){

  								adet_guncelle($(".adet_miktari:eq("+index+")").val(),$(this).attr("veri"));
  							}
  				});
  			});
        /* il ayarla */
        $("select[name=il]").change(function(event) {
          /* Act on the event */
          var id = $(this).val();
          $.ajax({
            url:'http://localhost/blog/ilce_al/'+id,
            type:'GET',
            dataType:'json',
            statusCode:{
              404:function(){
                alert("Ajax dosyası bulunamadı");
              }
            },
            success:function(veri){
              if(veri.error){
                alert(veri.error);
              }else{
                  $("select[name=ilce]").html("");
                $.each(veri.data, function(key, value){
                    var satir = value;
                      var ilce_id = 0;
                     $.each(satir,function(key,value){
                        if(key == "ilce_no"){
                          ilce_id = value;
                        }else if(key == "isim"){
                          $("select[name=ilce]").append('<option value='+ilce_id+'>'+value+'</option>');
                        }
                     });
                      });
              }
            },
            error:function(){
              alert("Hata oluştu. Tekrar deneyin.");
            },
            timeout: 4000,

            });
});
});
