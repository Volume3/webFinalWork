$(document).ready(function(){
	const GW_MAXFILESIZE = 2097152;

	$("#inbed").click(function() {

		var formData = new FormData();
		formData.append('bed_id', $("#bed_id").val());
		formData.append('mat_id', $("#mat_id").val());
		formData.append('condition', $("#condition").val());
		formData.append('date', $("#date").val());
		// //formData.append('score', $("#score").val());

		// // 判断上传图片的类型和大小，符合要求的话，添加到表单对象（formData）中
		$.each($('#screenshot')[0].files, function(i, file) {
	        var fileSize = $(this)[0].size;
	        var fileType = $(this)[0].type;
	        
	        // 如果大小和类型符合要求
	        if((fileType=='image/gif' || fileType=='image/jpeg' || fileType=='image/pjpeg' || fileType=='image/png') && (fileSize>0 && fileSize<GW_MAXFILESIZE)){
	            // 为表单添加数据
	              formData.append('screenshot', file);
	              //canUpload = true;
	        }
	        else{
	            alert("图像必须是 GIF, JPEG, 或者PNG格式, 文件大小不能超过2M!");
	        }
	    });
    
		$.ajax({
			url: 'addPatient.php',
			type: 'POST',
			data: formData,
	        contentType: false,    //不可缺
	        processData: false,    //不可缺
			
		}); // ajax结束
	}); // click事件结束

    $("#outbed").click(function() {
        //alert("adasd");
		var formData = new FormData();
		formData.append('bed_id', $("#bed_id").val());
		formData.append('mat_id', $("#mat_id").val());
		
		$.ajax({
			url: 'deletePatient.php',
			type: 'POST',
			data: formData,
	        contentType: false,    //不可缺
	        processData: false,    //不可缺
			// }
		}); // ajax结束
	}); // click事件结束

	$("#updatebed").click(function() {
		var firstbedId = $("#clickbed").children().children().children().attr("id");
		//alert("hajfhs");
		var formData = new FormData();
		formData.append('firstbedId', firstbedId);
		formData.append('bed_id', $("#bed_id").val());
		formData.append('mat_id', $("#mat_id").val());
		formData.append('condition', $("#condition").val());
        
        $.ajax({
			url: 'updatePatient.php',
			type: 'POST',
			data: formData,
	        contentType: false,    //不可缺
	        processData: false,    //不可缺
			
		}); // ajax结束
	}); // click事件结束


});