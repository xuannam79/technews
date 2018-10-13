			$(document).ready(function(){
					$("#primary-button2").click(function(){
						id = $("#primary-button2").attr("data-newsid");
						nU = $("#nameUser").val();
						p = $("#password").val();
						mU = $("#messageUser").val();
						$.ajax({
							url:"library/ajaxCom/ajaxComU.php",
							type:"post",
							data: "nameU="+nU+"&pass="+p+"&messageU="+mU+"&id="+id,
							async: true,
							success: function(kq){
								if($(".com-list span").length==0){
									$("#com-list").append(kq);
								}else{
									$(".com-list span:eq(0)").before(kq);
								}	
							}
						})
						return false;
					});	
				});				