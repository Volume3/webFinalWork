$(document).ready(function(){
	$.ajax({
		url:"php/age.php",
		success:function(jsonStr){
			var json = JSON.parse(jsonStr);
			var a = json.m_age1;
			var b = json.m_age2;
			var c = json.m_age3;
			var d = json.m_age4;
	var ageCanvas = $("#ageChart");
	var ageCanvas = document.getElementById("ageChart");
	var ageCanvas = document.getElementById("ageChart").getContext("2d");
    var pieChart = new Chart(ageCanvas, {
  		type: 'pie',
 		data: {
    	labels: ["15-25岁", "25-35岁", "35-45岁","45岁以上"],
    	//select cout(*) from---data
    	datasets: [{
      	label: 'Pop',
      	data: [a,b,c,d],
      	backgroundColor: [
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(102, 205, 170, 0.6)'
      	]
    	}]
  	}
})
		}
	})
})