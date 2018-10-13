// Biến dùng kiểm tra nếu đang gửi ajax thì ko thực hiện gửi thêm
var is_busy = false;
     
// Biến lưu trữ trang hiện tại
var page = 1;
 
// Số record trên mỗi trang
var record_per_page = 3;
 
// Biến lưu trữ rạng thái phân trang 
var stopped = false;
 
$(document).ready(function()
{
    // Khi kéo scroll thì xử lý
    $('#load_more1').click(function()
    {
        // Element append nội dung
        $element = $('#content1');
 
        // ELement hiển thị chữ loadding
        $button = $(this);
         
        // Nếu đang gửi ajax thì ngưng
        if (is_busy == true) {
            return false;
        }
         
        // Tăng số trang lên 1
        page = page + 1;
 
		console.log(page);
        // Hiển thị loadding ...
        $button.html('LOADDING ...');
 
        // Gửi Ajax
        $.ajax(
        {
            type: 'post',
            dataType: 'json',
            url: 'library/ajaxPop/dataPop.php',
            data: {page: page},
            success: function(result)
            {
                var html = '';
                // Trường hợp hết dữ liệu cho trang kết tiếp
                if (result.length <= record_per_page)
                {
                    // Lặp dữ liêụ
                    $.each(result, function (key, obj){
                       html += "<div class='col-md-12'>"+"<div class='post post-row'>"+
							"<a class='post-img' href='/"+obj.name+"-"+obj.news_id+".html'>"+
							"<img src='/files/"+obj.picture+"' alt=''></a>"+
							"<div class='post-body'>"+"<div class='post-meta'>"+
							"<a class='post-category cat-"+obj.catcolor+"' href='/cat/"+obj.catname+"-"+obj.cat_id+"'>"+obj.catname+
							"</a>"+"<span class='post-date'>"+obj.date_create+"</span>"+
							"&nbsp; <i class='fa fa-eye' style='font-size:14px;color:#3D455C'>"+obj.counter+"</i>"+
							"</div>"+"<h3 class='post-title'><a href='/"+obj.name+"-"+obj.news_id+".html'>"+obj.name+"</a></h3>"+
							"<p>"+obj.preview+"</p>"+
							"</div>"+"</div>"+
							"</div>"
							;
					});
 
                    // Thêm dữ liệu vào danh sách
                    $element.append(html);
 
                    // Xóa button
                    $button.remove();
                }
                else{ // Trường hợp còn dữ liệu cho trang kế tiếp
                    // Lặp dữ liêụ, trường hợp này ta lặp bỏ đi phần record cuối cùng vì ta select với limit + 1
                    $.each(result, function (key, obj){
                        if (key < result.length - 1){
                            html += "<div class='col-md-12'>"+"<div class='post post-row'>"+
							"<a class='post-img' href='/"+obj.name+"-"+obj.news_id+".html' >"+
							"<img src='/files/"+obj.picture+"' alt=''></a>"+
							"<div class='post-body'>"+"<div class='post-meta'>"+
							"<a class='post-category cat-"+obj.catcolor+"' href='/cat/"+obj.catname+"-"+obj.cat_id+"'>"+obj.catname+
							"</a>"+"<span class='post-date'>"+obj.date_create+"</span>"+
							"&nbsp; <i class='fa fa-eye' style='font-size:14px;color:#3D455C'>"+obj.counter+"</i>"+
							"</div>"+"<h3 class='post-title'><a href='/"+obj.name+"-"+obj.news_id+".html'>"+obj.name+"</a></h3>"+
							"<p>"+obj.preview+"</p>"+
							"</div>"+"</div>"+
							"</div>"
							;
                        }
                    });
                    // Thêm dữ liệu vào danh sách
                    $element.append(html);
                }
 
            }
        })
        .always(function()
        {
            // Sau khi thực hiện xong thì đổi giá trị cho button
            $button.html('LOAD MORE');
            is_busy = false;
        });
 
    });
});