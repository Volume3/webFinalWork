$(document).ready(function(){
	$.ajax({
		url:"php/date.php",
		success:function(jsonStr){
	var json = JSON.parse(jsonStr);
	var a = json.m1;
	var b = json.m2;
	var c = json.m3;
	var d = json.m4;
	var e = json.m5;
	var f = json.m6;
	var g = json.m7;
	var h = json.m8;
	var i = json.m9;
	var j = json.m10;
	var k = json.m11;
	var l = json.m12;
    var ageCanvas = $("#Chart");
	var ageCanvas = document.getElementById("Chart");
	var ageCanvas = document.getElementById("Chart").getContext("2d");
    	var myChart = new Chart(ageCanvas, {
       	 	type: 'line', // line 表示是 曲线图，当然也可以设置其他的图表类型 如柱形图 : bar  或者其他
        	data: {
            labels : ["Jan.","Feb.","Mar.","Apr.","May.","Jun.","Jul.","Aug.","Sept.","Oct.","Nov.","Dec."], //按时间段 可以按星期，按月，按年
            datasets : [
                {
                    label: "入住人数",  //当前数据的说明
                    fill: true,  //是否要显示数据部分阴影面积块  false:不显示
                    borderColor: "rgba(200,162,205,1)",//数据曲线颜色
                    pointBackgroundColor: "#fff", //数据点的颜色
                    data: [a, b, c, d, e, f, g,h,i,j,k,l],  //填充的数据
                }
            ]
        }
    });
}})})