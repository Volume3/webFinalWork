$(document).ready(initPage);

function initPage() {

  showBed();
  
  var Links = $(".ul li");
  Links.each(function(){
    $(this).click(linkClick);
  })

  var beds = $(".col-sm-3.col-md-3");
  beds.each(function(){
    $(this).click(bedclick)
  })

  $.ajax({
        url: "login/index.php",        // 外部文件所在路径
        cache: false,                    // 是否需要将文件缓存
        success: function(data){   // 如果外部文件加载成功，执行下面的内容

            $("#personal").html(data); 
            //alert(data);
        }   
    });
}

//定义onclick事件调用的函数
function showBed(){
  
      $.ajax({
            url: "PHP/bed1.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed1").html(data);
                //alert(data);  
            }   
        });

      $.ajax({
            url: "PHP/bed2.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed2").html(data);
                //alert(data);   
            }   
        });

      $.ajax({
            url: "PHP/bed3.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed3").html(data);
                //alert(data);   
            }   
        });

      $.ajax({
            url: "PHP/bed4.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed4").html(data);
                //alert(data);   
            }   
        });

      $.ajax({
            url: "PHP/bed5.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed5").html(data);
                //alert(data);   
            }   
        });

      $.ajax({
            url: "PHP/bed6.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed6").html(data);
                //alert(data);   
            }   
        });

      $.ajax({
            url: "PHP/bed7.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed7").html(data);
                //alert(data);   
            }   
        });

      $.ajax({
            url: "PHP/bed8.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed8").html(data);
                //alert(data);   
            }   
        });

      $.ajax({
            url: "PHP/bed9.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed9").html(data);
                //alert(data);   
            }   
        });

      $.ajax({
            url: "PHP/bed10.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed10").html(data);
                //alert(data);   
            }   
        });

      $.ajax({
            url: "PHP/bed11.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed11").html(data);
                //alert(data);   
            }   
        });

      $.ajax({
            url: "PHP/bed12.php",        // 外部文件所在路径
            cache: false,                    // 是否需要将文件缓存
            //dataType: "",
            success: function(data){   // 如果外部文件加载成功，执行下面的内容

                $("#bed12").html(data);
                //alert(data);   
            }   
        });
}

//定义onmouseover事件调用的函数
function linkClick(){

  $(".ul li").attr("class","");

  $(".ul li a").attr("id","LinkActionOff");

  $(this).attr("calss","active");

  $(this).children().attr("id","LinkActionOn");

}

function bedclick(){
  $(".col-sm-3.col-md-3").attr("id","bed");
  $(this).attr("id","clickbed");
  
  var number = $(this).children().children().children().attr("id");
    $.ajax({
        url: "PHP/information.php",
        data: {temp:number},
        success: function(jsonStr){   // 如果外部文件加载成功，执行下面的内容
          var json = JSON.parse(jsonStr);

          if(json.state=='占用'){
            $("#bed_id").attr("value", json.bed_id);
            $("#bed_id").removeAttr("onfocus");

            $("#name").attr("value", json.name);
            $("#name").attr("onfocus", "this.blur()");

            $("#mat_id").attr("onfocus", "this.blur()");

            $("#condition").attr("value", json.condition);
            $("#condition").removeAttr("onfocus");

            $("#date").attr("value", json.date);
            $("#date").attr("onfocus", "this.blur()");

            $("#inbed").attr("style","display:none;");
            $("#updatebed").attr("style","display:block;");

          }
          else if(json.state=='空闲'){
            $("#bed_id").attr("value", json.bed_id);
            $("#bed_id").attr("onfocus", "this.blur()");

            $("#name").attr("value", json.name);
            $("#name").removeAttr("onfocus");

            // $("#mat_id").attr("value", json.mat_id);
            $("#mat_id").removeAttr("onfocus");

            $("#condition").attr("value", json.condition);
            $("#condition").removeAttr("onfocus");

            $("#date").removeAttr("value");
            // $("#date").attr("value", "");
            $("#date").removeAttr("onfocus");

            $("#inbed").attr("style","display:block;");
            $("#updatebed").attr("style","display:none;");
          }
        }   
    });

    var mat_id = $("#mat_id").val();
       $.ajax({
        url: "PHP/matIdSearch.php",
        data: {bedId: number},
        success: function(data){   // 如果外部文件加载成功，执行下面的内容

          $("#mat_id").html(data);

        }   
    });

    //var condition = $("#condition").val();
       $.ajax({
        url: "PHP/conditionSearch.php",
        data: {bedId: number},
        success: function(data){   // 如果外部文件加载成功，执行下面的内容

          $("#condition").html(data);

        }   
    });
}