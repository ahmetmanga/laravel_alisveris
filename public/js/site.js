		/*
		ahmet manga tarafindan yazilmistir.
		*/
		$(window).scroll(function(){
			var height = $(this).scrollTop();
			if(height>175){
				$("#alt").addClass("navbar-fixed-top");
				$(".kat_desktop").css('display','il')
			}else{
				$("#alt").removeClass("navbar-fixed-top");
			}
		});

		$(document).ready(function(){
			$("input[name=kargo]").each(function(index, el) {
				$("input[name=kargo]:eq("+index+")").parent().click(function(){
					var fiyat = $("input[name=kargo]:eq("+index+")").attr("fiyat");
					var toplam = eval((parseInt($("#toplam_fiyat").html()))-(-fiyat));
					$("#toplam_fiyat").html(toplam);
				})				
			});

			$("#search_input").focus();
			$(".table tr td").css('vertical-align','middle');
			$(".page-header").css('margin-top','1%');
			/* puanla */
			var durum = false;
			var index;
			$(".puanla").hover(function(event) {
					if(durum == false){
						index = $(this).index();
						for(var i=0;i<=index;i++){
					$(".puanla:eq("+i+")").removeClass('glyphicon-star-empty').addClass('glyphicon-star');
						}
					}
			}, function(){
				if(durum == false){ $(".puanla").removeAttr('glyphicon-star').addClass('glyphicon-star-empty'); }
			});
			$(".puanla").click(function(event) {
					index = $(this).index();
					$("input[name=puan]").val(index+1);
					if(durum == false) $(".puanla").parent().after("Puanınız kayıt edildi.");
					durum = true;

			});
			/* adres */
			 $(".adresler").each(function(index, el) {
			 		 $(".adresler:eq("+index+")").click(function(event) {
			 		 	/* Act on the event */
								$(".adresler_radio").removeAttr('checked');
							$(".adresler_radio:eq("+index+")").attr('checked','checked');
					 });
			 });
			 $(".secili").each(function(index, el) {
			 		 $(".secili:eq("+index+")").click(function(event) {
			 		 	/* Act on the event */
					var isim = $(".secili:eq("+index+")").attr("name");
						$("input[name="+isim+"]").removeAttr('checked');
					$(".input_radio:eq("+index+")").attr('checked','checked');
					 });
			 });
			 $("#kredi_karti").click(function(event) {
							$("#taksit_secenekleri").slideToggle();

			 	/* Act on the event */
			 });
			/* kat secim */
			var deger,kat_id;
			var yildiz,ind,i,cls;
			var old= [];
			$("input[name=marka]").click(function(event) {
				deger = $(this).val();
				var kat_id2 = $("input[name=kat_id]").val();
				var durum = true;
				kat_id = kat_id2.replace(' ','').split(',');
				for(i=0;i<kat_id.length;i++){
						if(kat_id[i].trim() == deger){
								durum = false;
								break;
						}
				}
				if(durum == true){
					kat_id.push(deger);
					kat_id2 = kat_id.join(',');
					kat_id2 = kat_id2 + " ,";

				}else{
						if(i!=0){
							delete kat_id[i];
							kat_id2 = kat_id.join(',');
						}
				}

				kat_id2 = kat_id2.replace(' ','').replace('  ','');
				kat_id2 = kat_id2.replace(',,',',');
				kat_id2 = kat_id2.replace(', ,',',');
			kat_id2 = kat_id2.trim();
			if(kat_id2.slice(-1) != ","){
				kat_id2 = kat_id2 + " ,";
			}


					$("input[name=kat_id]").val(kat_id2);
					$("#filter_form").submit();
			});
			/*puanla */

			$("#puanla").children('span').hover(function() {
					ind = $(this).index();
					cls =  $(this).attr('class');
					if(cls.indexOf('glyphicon-star-empty') != -1) { yildiz = false; }else{ yildiz = true; }
					$(this).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
					for(i=0; i<ind;i++){
						cls =  $(this).attr('class');
						if(cls.indexOf('glyphicon-star-empty') != -1){ old[i] = "bos"; }else{ old[i] = "dolu"; }
						$("#puanla").children('span:eq('+i+')').removeClass('glyphicon-star-empty').addClass('glyphicon-star');
					}
			}, function() {
					ind = $(this).index();
					for(i=0;i<ind;i++){
						if(old[i] == "bos"){
							$("#puanla").children('span:eq('+i+')').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
						}
					}
					if(yildiz == false){
						$(this).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
					}
			});

			/* kat acilir*/
			$(".kat_isim").each(function(index, el) {
					$(".kat_isim:eq("+index+")").hover(function() {
						$(".kat_acilir").hide();
						$(".kat_alt").hide();
						$(".kat_acilir:eq("+index+")").show();
					});
			});

					$(".kat_ac").each(function(index, el) {
						 $(".kat_ac:eq("+index+")").hover(function() {
							  $(".kat_alt").hide();
								$(".kat_alt:eq("+index+")").show();
						 }, function() {

						 });
				});
				/* menu acilir*/
			$(".sub_li").each(function(index, el) {
					$(".sub_li:eq("+index+")").hover(function() {
						$(".acilir_menu").hide();
					$(".acilir_menu:eq("+index+")").show();
							}, function() {
					});
			});
			$(".acilir_menu").each(function(index, el) {
				$(".acilir_menu:eq("+index+")").hover(function() {

				}, function() {
					$(this).hide();
				});
			});
			/* slider */
			$(".thumbnail .slayt").each(function(index) {
				var resim = $(".thumbnail .slayt:eq("+index+") ul li").length;
				var resim_height = 210;
				var suan = 0;

				$(".thumbnail .slayt:eq("+index+") ul").css({
					'height':(resim_height*resim)+'px',
					'list-style':'none'
				});
				$(".thumbnail .slayt:eq("+index+")").css({
					'height':resim_height+'px',
					'overflow':'hidden',
					'margin-left':'25px'
				});
				for(var i=resim; i>0; i--){
					$(".thumbnail .slayt:eq("+index+")").next().prepend('<a href="javascript:void(0)" class="slayt_sira btn btn-xs btn-default" style="border-radius:10px;">'+(i)+'</a> ')
				}
				$(".thumbnail .slayt:eq("+index+")").next().children(".slayt_sira:eq(0)").removeClass('btn-default').addClass('btn-primary');
				$(".thumbnail .slayt:eq("+index+")").next().children(".slayt_sira").on('click',function(){

					$(".thumbnail .slayt:eq("+index+")").next().children(".slayt_sira").removeClass('btn-primary').addClass('btn-default');
					$(this).addClass('btn-primary');
					suan = $(this).html()-1;
					$(".thumbnail .slayt:eq("+index+") ul").animate({
						"margin-top":"-"+suan*resim_height+"px"
					},500);

				});
			});
			/* slider bitis */



/* genel ayarlar */
			$(".thumbnail").css('box-shadow','3px 3px 2px #337ab7');
			$("#sepet").hover(function() {
				$("#sepet_detay").fadeIn(500);
			});
			$("#sepet_mobil").click(function() {
					$("#sepet_detay").fadeIn(500);
			});
			$("#sepet_detay").hover(function() {

			}, function() {
				$(this).fadeOut(500);
			});
			$("navbar ul li a").css('color','white');
			$("#alt ul li a").hover(function() {
				$(this).css('color','white');
			}, function() {
				$(this).css('color','#777');
			});

			$("#search_input").css({
					'border-color':'#2e6da4',
					'border-right':'none',
					'width':'650px',
					'border-top-right-radius':'0px',
					'border-bottom-right-radius': '0px'

			});

			$("#search_button").css({
				 'border-left':'0',
				 'height': '55px',
				 'width':'45px'

			});

			$("#sepet").css('margin-left','30px');


		$("#search_button").click(function() {
			$("#giris_form").submit();
		});

		$("ul.hover li").hover(function() {
			$(this).css({
				'background-color':'#337ab7',
				'color':'white'
			});
			$(this).children().css('color','white');
		}, function() {
			$(this).css({
				'background-color':'white',
				'color':'black'
			});
			$(this).children("h4").css('color','black');
			$(this).children("a").css('color','#337ab7');
		});
		$("#search_button").hover(function(){
			$(this).removeClass('btn-default');
			$(this).addClass('btn-primary');

		}, function(){
			$(this).removeClass('btn-primary');
			$(this).addClass('btn-default');
		});
		$("nav ul li a").hover(function(){
			$(this).css('background-color','#337ab7');
		},
		function(){
			$(this).css('background-color','transparent');
		});
		$("#search_input").focus(function() {
			$(this).css({
				'border-color':'#2e6da4',
				'border':'4px'
			});
			$("#search_button").removeClass('btn-default');
			$("#search_button").addClass('btn-primary');
		});
		$("#search_input").focusout(function() {
			$(this).css('border-color','#ccc');
			$("#search_button").removeClass('btn-primary');
			$("#search_button").addClass('btn-default');
		});
		/* sifre kontrol */
					var deger_2 = 0;
					var sifre_kontrol = function(){
						var deger = 100;
						var kucuk_harf = 0;
						var buyuk_harf = 0;
						var sembol = 0,i;
						var k_harfler = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','y','z','x','q'];
						var b_harfler = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','Y','Z','X','Q'];
						var s_sembol = ['!','+','-','_','.',',',';','?','=',')','(','/','&','%','*'];
					$("input[name=password").keypress(function(){

						$("#sifre_gucluk").slideDown();

						deger_ver({ deger:deger});
					});
					var sifre = $("input[name=password]").val();
						var uzunluk = sifre.length;

						if(uzunluk > 7){
								deger += 200;

						}
						for(i=0;i<k_harfler.length;i++){
						if(sifre.indexOf(k_harfler[i]) != -1){
							kucuk_harf += 1;
							if(kucuk_harf <3){
							deger += 30;
								}

						} }
						for(i=0;i<b_harfler.length;i++){
						if(sifre.indexOf(b_harfler[i]) != -1){
							buyuk_harf += 1;
							if(buyuk_harf <3){
							deger += 30;
								}

						}
					}

						for(i=0;i<s_sembol.length;i++){
						if(sifre.indexOf(s_sembol[i]) != -1){
							sembol += 1;
							if(sembol <3){
							deger += 30;
								}
								}
							}



							if(kucuk_harf >= 2){
								deger += 40;
							}
							if(buyuk_harf >= 2){
								deger += 40;
							}
							if(sembol >=2){
								deger += 40;
							}
						deger_ver({ deger:deger});
						$("#sifre_deger").html("Zayıf");
						if(deger>100 && deger <300){
							$("#sifre_deger").html("Zayıf");
						}else if(deger>=300 && deger<360){
							$("#sifre_deger").html("Orta");
						}else if(deger >=360 && deger<500){
							$("#sifre_deger").html("Güçlü");
						}else if(deger>=500){
							$("#sifre_deger").html("Çok Güçlü");
						}
						deger_2 = deger;


				}
				var deger_ver = function(veri){
					$("#sifre_deger").attr('style', 'width:'+veri.deger+'px');
				}

						var sifre_durum = false;
				setInterval(sifre_kontrol,100);
				var sifre_es = function(){
					var ilk_sifre = $("input[name=password]").val();
					var ikinci_sifre = $("input[name=password_confirmation]").val();
					if(ilk_sifre != '' && ikinci_sifre != ''){
						if(ilk_sifre != ikinci_sifre){
							$("div#sifre_eslesme").slideDown();

						}else{
							sifre_durum = true;
							$("div#sifre_eslesme").slideUp();
						}
					}
				}
				setInterval(sifre_es,100);
				var form_submit = function(){
					if(deger_2 >= 300 && sifre_durum == true){
							$("input[name=kayit]").removeAttr('disabled');
					}else{
						$("input[name=kayit]").attr('disabled', 'disabled');
					}
				}
				setInterval(form_submit,200);


		});
