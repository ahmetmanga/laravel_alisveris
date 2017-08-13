$(document).ready(function() {
  var gosterilen = 9,i,veri,sira;
  var tum_sayi = $(".order").length;
  var sayfa_no = Math.ceil(tum_sayi/gosterilen);
  $(".order:gt(8)").hide(); // ilk 9 haric hepsini gizle.
  for(i=0;i<sayfa_no;i++){
    $(".sayfa_no").append("<a href=\"javascript:void(0)\" class=\"btn btn-default\" style=\"margin-left:10px;\">"+(i+1)+"</a>");
  }
   $(".sayfa_no a:first").removeClass('btn-default').addClass('btn-primary');
  $(".sayfa_no a").on('click',function(){
    $("body,html").animate({
						'scrollTop':'0px'
					},400);

    sira = $(this).index()+1;
    $(".sayfa_no a").removeClass('btn-primary').addClass('btn-default');
    $(this).addClass('btn-primary');
    veri = gosterilen*sira-gosterilen;
	  	   	 $(".order").hide();
	  	   	 for(var i=veri;i<veri+gosterilen;i++){
	  	   	 	$(".order:eq("+i+")").show();
	  	   	 }

  });
  var adres_gosterilen =4;
  var hepsi = $(".adresler").length;
  sayfa_no = Math.ceil(hepsi/adres_gosterilen);
  $(".adresler").hide();
  for(i=0;i<adres_gosterilen;i++){
    $(".adresler:eq("+i+")").show();
  }
  for(i=0;i<sayfa_no;i++){
    $(".adres_sayfa").append("<a href=\"javascript:void(0)\" class=\"btn btn-default\" style=\"margin-left:10px;\">"+(i+1)+"</a>");
  }
   $(".adres_sayfa a:first").removeClass('btn-default').addClass('btn-primary');
   $(".adres_sayfa a").on('click',function(){

     sira = $(this).index()+1;
     $(".adres_sayfa a").removeClass('btn-primary').addClass('btn-default');
     $(this).addClass('btn-primary');
     veri = adres_gosterilen*sira-adres_gosterilen;
           $(".adresler").hide();
           for(var i=veri;i<veri+adres_gosterilen;i++){
            $(".adresler:eq("+i+")").show();
           }

   });
});
