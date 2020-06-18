$(document).ready(function(){

    var Links = $(".ul li");
    Links.each(function(){
    $(this).click(linkClick);
    })

    $.ajax({
        url: "../login/index2.php",        // 外部文件所在路径
        cache: false,                    // 是否需要将文件缓存
        success: function(data){   // 如果外部文件加载成功，执行下面的内容

            $("#personal").html(data); 
            //alert(data);
        }   
    });
    
});
function linkClick(){

  $(".ul li").attr("class","");

  $(".ul li a").attr("id","LinkActionOff");

  $(this).attr("calss","active");

  $(this).children().attr("id","LinkActionOn");

}