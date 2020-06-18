var pageIndex = 1;    //页面索引初始值   
var pageSize = 10;     //每页显示条数初始化，修改显示条数，修改这里即可   
var pageCount = 30;   //总的记录数，随便赋个初值好了，后面会重新赋值的 
$(document).ready(function () {
	// 得到要显示的总的记录数
	$.ajax({
		url: 'connectDBDoc.php',
		async: false,  // 取消异步，因为只有先得到总记录数，才能计算实际需要多少页
		type: 'POST',
		dataType: 'json',
		data: {index: '0', size: pageSize}, // 提交数据
		success: function(data){
			 pageCount = data.total;
		},
		error: function() {
			alert("error");
		}
	});
    InitTable(pageIndex);    //初始化表格数据
    InitPager();
});

function InitPager() {
    //分页，PageCount是总条目数，这是必选参数，其它参数都是可选
    $("#pager").pagination(pageCount, {
        callback: pageCallback,  //PageCallback() 为翻页调用次函数。
        prev_text: "上一页",
        next_text: "下一页",
        items_per_page: pageSize,
        num_edge_entries: 2,       //两侧首尾分页条目数
        num_display_entries: 3,    //连续分页主体部分分页条目数
        current_page: pageIndex - 1,   //当前页索引
    });

}
//翻页调用   
function pageCallback(index, jq) {
    InitTable(index + 1);
}
//请求数据   
function InitTable(pageIndex) {
    $.ajax({
        type: "POST",
        url: "connectDBDoc.php",
        dataType: "json",
        //提交两个参数：pageIndex(页面索引)，pageSize(显示条数)
        data: {index: pageIndex, size: pageSize},                    
        success: function (data) {
            $("#divtest").html("<table id='testTable'></table>");
            // 设置表格标题
            var str = "";
            str += "<tr>"
            str += "<th class='doc_id' >工号</th>";
            str += "<th class='name'>姓名</th>";
            str += "<th class='gender'>性别</th>";
            str += "<th class='age'>年龄</th>";
            str += "<th class='rdirection'>科室</th>";
            str += "<th class='phone'>联系电话</th>";
            str += "</tr>";

            // 设置表格内容
            $.each(data, function(){
            	str += "<tr class='testRow'>";
                str += "<td class='doc_id'>" + this['doc_id'] + "</td>";
                str += "<td class='name'>" + this['name'] + "</td>";
                str += "<td class='gender'>" + this['sex'] + "</td>";
                str += "<td class='age'>" + this['age'] + "</td>";
                str += "<td class='rdirection'>" + this['direction'] + "</td>";
                str += "<td class='phone'>" + this['phone'] + "</td>";
                str += "</tr>";
            });
            $("#testTable").html(str);
        },
        error: function() {
			alert("error");
		}
    });
}

function showE(){
    $("#bg").attr("style","display:");
    $("#Edit").attr("style","display:block");
}
function showD(){
    $("#bg").attr("style","display:");
    $("#Delete").attr("style","display:block");
}
function showA(){
    $("#bg").attr("style","display:");
    $("#Add").attr("style","display:block");
}
function hide(){
    $("#bg").attr("style","display:none");
    $("#Edit").attr("style","display:none");
    $("#Delete").attr("style","display:none");
    $("#Add").attr("style","display:none");
}
// function delete1(){
//     //var doc_id = $("#doc_id").val();
//     var formData = new FormData();
//     formData.append('doc_id',$("#doc_id").val());
//     //alert(doc_id);
//     $.ajax({
//         url: "../Delete.php",
//         data: formData,
//         contentType:false,
//         processData:false,
//         success:function(jsonStr){
//             var json = JSON.parse(jsonStr);
//             if(json.status=='success'){
//                 alert("删除成功！");
//             }
//         }
//     });
// }