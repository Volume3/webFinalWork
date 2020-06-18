    $(document).ready(function(){
	$.ajax({
		url:"php/population.php",
		success:function(jsonStr){
			var json = JSON.parse(jsonStr);
			var a = json.doctor;
 			var b = json.mate;
 			var c = json.nur;
			var popCanvas = $("#popChart");
			var popCanvas = document.getElementById("popChart");
			var popCanvas = document.getElementById("popChart").getContext("2d");
    		var barChart = new Chart(popCanvas, {
  				type: 'bar',
 				data: {
    			labels: ["医生", "护士", "产妇"],
    	//医生（select cout(*) from doctor） 护士(select cout(*) from nurse)  产妇（select cout(*) from maternal）---data
    			datasets: [{
      			label: 'Population',
      			data: [a,c,b],
      			backgroundColor: [
        		'rgba(255, 99, 132, 0.6)',
        		'rgba(54, 162, 235, 0.6)',
        		'rgba(255, 206, 86, 0.6)'
      			]
    			}]
  			},
  			options:{
  				maintainAspectRatio:true,
  				scales:{
  					yAxes:[{
  						ticks:{
  							beginAtZero:true
  						}
		  			}]
		  		}
  			}
		})
			//alert(json.doctor);
		}
	})
})