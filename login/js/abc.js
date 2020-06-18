$(document).ready(initPage);

function initPage() {

  $.ajax({
        url: "index3.php",        // 外部文件所在路径
        cache: false,                    // 是否需要将文件缓存
        success: function(data){   // 如果外部文件加载成功，执行下面的内容

            $("#personal").html(data); 
            //alert(data);
        }   
    });
}