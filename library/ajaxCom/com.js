$(document).ready(function(){
					$("#primary-button").click(function(){
						n = $("#nameReader").val();
						e = $("#emailReader").val();
						m = $("#messageReader").val();
						id = $("#primary-button").attr("data-newsid");
						$.ajax({
							url:"library/ajaxCom/ajaxCom.php",
							type:"post",
							data: "name="+n+"&email="+e+"&message="+m+"&id="+id,
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