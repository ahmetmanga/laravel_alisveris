
   								/*

                                 ahmet manga
                           */
                           function setCookie(name, value, days) {
                            if (days) {
                                var date = new Date();
                                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                                var expires = "; expires=" + date.toGMTString();
                            }
                            else var expires = "";
                            document.cookie = name + "=" + value + expires + "; path=/";
                        }

                        function getCookie(name) {
                            var nameEQ = name + "=";
                            var ca = document.cookie.split(';');
                            for (var i = 0; i < ca.length; i++) {
                                var c = ca[i];
                                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                            }
                            return null;
                        }
                          if(getCookie("backcolor") == null){
   									$("input[name=renk_sec]").val("#D8D8D8");
   									$("#ust_div").removeAttr("style");
	   						 	 	$("#ust_div").attr('style','background-color:#D8D8D8');

                              /*
                              eski renk #989898
                              */

									}else{
										$("input[name=renk_sec]").val(getCookie("backcolor"));
										$("#ust_div").removeAttr("style");
										$("#ust_div").attr('style','background-color:'+getCookie("backcolor"));
									}
   						 			
   						 	 
   						 	 $("input[name=renk_sec").change(function(event) {
   						 	 	arkaplan = $(this).val();
   						 	 	setCookie("backcolor",arkaplan);
   						 	 	$("#ust_div").removeAttr("style");
								$("#ust_div").attr('style','background-color:'+getCookie("backcolor"));
   						 	 	 });
					