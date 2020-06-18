$.ajax({
            url: "php/connectDB.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容
                $("#mes").html(data);
                //alert(data);   
            }   
        });

