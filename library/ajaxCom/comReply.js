$(document).ready(function(){
	$(".reply").click(function(){
		id = $(this).attr("data-reid"); 
		$(".post-reply"+id).slideToggle();
	});
	$(".primary-button").click(function(){
		id = $(this).attr("data-comId");
		n = $("#nameReply"+id).val();
		e = $("#emailReply"+id).val();
		m = $("#messageReply"+id).val();
		
		id_news = $("#submitReply"+id).attr("data-idNews");
		$.ajax({
			url: "library/ajaxCom/ajaxReply.php",
			type: "post",
			data: "name="+n+"&email="+e+"&mess="+m+"&comId="+id+"&newsId="+id_news+"&pass="+p,
			async: true,
			success: function(kq){
				
				$("#reply-list"+id).append(kq);			
				$(".input").val("");
			}
		});
		return false;
	});
});
