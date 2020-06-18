$(document).ready(function(){
	$.ajax({
		url:"php/age_nur.php",
		success:function(jsonStr){
			var json = JSON.parse(jsonStr);
			var a = json.n_age1;
			var b = json.n_age2;
			var c = json.n_age3;
			var d = json.n_age4;
	var ageCanvas = $("#nurChart");
	var ageCanvas = document.getElementById("nurChart");
	var ageCanvas = document.getElementById("nurChart").getContext("2d");
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