/*<!-- FOR SHOW PRIVIOUS DATA ON INPUT -->*/
$(document).on('click','.update',function(e) {
	var id=$(this).attr("data-id");
	var coilid=$(this).attr("data-coilid");
	var action=$(this).attr("data-action");
	$('#id_u').val(id);
	$('#coilid_u').val(coilid);
	$('#action_u').val(action);
});
/*<!-- Update -->*/
$(document).on('click','#update',function(e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "backend/save.php",
		success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					$('#editEmployeeModal').modal('hide');
					alert('Data updated successfully !'); 
                    location.reload();						
				}
				else if(dataResult.statusCode==201){
				   alert(dataResult);
				}
		}
	});
});

/*<!-- Muliple Update -->*/

/* --- CUTTING_STATION_ONE --- */
$(document).on("click", "#CUTTING_STATION_1", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are You Sure !! You Want To Update "+(user.length>1?"These Rows":"This Row")+"?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache:false,
				data:{
					type: 1,						
					id : selected_values
				},
				success: function() {
					document.location.reload();
				} 
			}); 
		}  
	} 
});
/* --- CUTTING_STATION_TWO --- */
$(document).on("click", "#CUTTING_STATION_2", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are You Sure !! You Want To Update "+(user.length>1?"These Rows":"This Row")+"?";	
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache:false,
				data:{
					type: 2,						
					id : selected_values
				},
				success: function() {
					document.location.reload();		
				} 
			}); 
		}  
	} 
});
/* --- CUTTING_STATION_THREE --- */
$(document).on("click", "#CUTTING_STATION_3", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are You Sure !! You Want To Update "+(user.length>1?"These Rows":"This Row")+"?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache:false,
				data:{
					type: 3,						
					id : selected_values
				},
				success: function() {
					document.location.reload();	
				} 
			}); 
		}  
	} 
});
/* --- CUTTING_STATION_FOUR --- */
$(document).on("click", "#CUTTING_STATION_4", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are You Sure !! You Want To Update "+(user.length>1?"These Rows":"This Row")+"?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache:false,
				data:{
					type: 4,						
					id : selected_values
				},
				success: function() {
					document.location.reload();	
				} 
			}); 
		}  
	} 
});
/* --- SPOOLING STATION --- */
$(document).on("click", "#SPOOLING_STATION", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are You Sure !! You Want To Update "+(user.length>1?"These Rows":"This Row")+"?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache:false,
				data:{
					type: 5,						
					id : selected_values
				},
				success: function() {
					document.location.reload();	
				} 
			}); 
		}  
	} 
});
/* --- JUMBO_PACKING --- */
$(document).on("click", "#JUMBO_PACKING", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are You Sure !! You Want To Update "+(user.length>1?"These Rows":"This Row")+"?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache:false,
				data:{
					type: 6,						
					id : selected_values
				},
				success: function() {
					document.location.reload();	
				} 
			}); 
		}  
	} 
});
/* --- REJECT --- */
$(document).on("click", "#REJECT", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are You Sure !! You Want To Update "+(user.length>1?"These Rows":"This Row")+"?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache:false,
				data:{
					type: 7,						
					id : selected_values
				},
				success: function() {
					document.location.reload();	
				} 
			}); 
		}  
	} 
});
/* --- EMPTY --- */
$(document).on("click", "#EMPTY", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are You Sure !! You Want To Update "+(user.length>1?"These Rows":"This Row")+"?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache:false,
				data:{
					type: 8,						
					id : selected_values
				},
				success: function() {
					document.location.reload();	
				} 
			}); 
		}  
	} 
});
/* --- HOLD --- */
$(document).on("click", "#HOLD", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are You Sure !! You Want To Update "+(user.length>1?"These Rows":"This Row")+"?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache:false,
				data:{
					type: 9,						
					id : selected_values
				},
				success: function() {
					document.location.reload();	
				} 
			}); 
		}  
	} 
});
/* --- SPARE --- */
$(document).on("click", "#SPARE", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are You Sure !! You Want To Update "+(user.length>1?"These Rows":"This Row")+"?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "backend/save.php",
				cache:false,
				data:{
					type: 10,						
					id : selected_values
				},
				success: function() {
					document.location.reload();	
				} 
			}); 
		}  
	} 
});


