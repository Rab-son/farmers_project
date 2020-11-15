
$(document).ready(function(){
	$("#access").hide();
	$("#type").change(function(){
		var type = $("#type").val();
		if(type == "Admin"){
			$("#access").hide();
		}else{
			$("#access").show();
		}
	});
	
	$('#district_id').on('change', function () {
		let id = $(this).val();
		$('#epaname').empty();
		$('#epaname').append(`<option value="0" disabled selected>Processing...</option>`);
		$.ajax({
		type: 'GET',
		url: '/admin/GetSubCatAgainstMainCatEdit/' + id,
		success: function (response) {
		console.log('failing');
		var response = JSON.parse(response);
		console.log(response);   
		$('#epaname').empty();
		$('#epaname').append(`<option value="0" disabled selected>Select EPA Name</option>`);
		response.forEach(element => {
				$('#epaname').append(`<option value="${element['epaname']}">${element['epaname']}</option>`);

				});
		}
		
});
});

	


	$("#current_pwd").keyup(function(){
		var current_pwd = $("#current_pwd").val();
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				if(resp=="false"){
					$("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
				}else if(resp=="true"){
					$("#chkPwd").html("<font color='green'>Current Password is correct</font>");
				}
			},error:function(){
				alert("Error");
			}
		});
	});
	
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	

	// Add Farmer Validation
    $("#add_farmer").validate({
		rules:{
			farmer_name:{
				required:true
			},
			phone_number:{
				required:true,
				minlength:13,
				maxlength:13
			},
			dob:{
				required:true,
				date: true
			},
			id_number:{
				required:true,
			},
			next_of_kin:{
				required:true,
			},
			sex:{
				required:true,
			},
			location:{
				required:true,
			}
		
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	// Edit Farmer Validation
    $("#edit_farmer").validate({
		rules:{
			farmer_name:{
				required:true
			},
			phone_number:{
				required:true,
				minlength:13,
				maxlength:13
			},
			dob:{
				required:true,
				date: true
			},
			id_number:{
				required:true,
			},
			next_of_kin:{
				required:true,
			},
			sex:{
				required:true,
			},
			location:{
				required:true,
			}
		
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	// Add Market Validation
    $("#add_market").validate({
		rules:{
			mark_name:{
				required:true
			},
			mark_location:{
				required:true,
				number:false
			}
		
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	// Edit Market Validation
    $("#edit_market").validate({
		rules:{
			mark_name:{
				required:true
			},
			mark_location:{
				required:true,
				number:false
			}
		
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	// Add Supplier Validation
    $("#add_supplier").validate({
		rules:{
			supplier_name:{
				required:true
			},
			supplier_phonenumber:{
				required:true,
				minlength:10,
				maxlength:10,
				number:true

			},
			supplier_location:{
				required:true,
				number:false
			}
		
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	// Edit Supplier Validation
    $("#edit_supplier").validate({
		rules:{
			supplier_name:{
				required:true
			},
			supplier_location:{
				required:true,
				number:false
			}
		
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	// Add Advisor
    $("#add_advisor").validate({
		rules:{
			advisor_name:{
				required:true
			},
			phone_number:{
				required:true,
				maxlength:10,
				minlength:10

			},
			advisor_location:{
				required:true
			},
			days:{
				required:true,
			},
			start_time:{
				required:true,
			},
			end_time:{
				required:true,
			},
			specialty:{
				required:true,
			},
			status:{
				required:true,
			}
			
		
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	// Edit Advisor
    $("#edit_advisor").validate({
		rules:{
			advisor_name:{
				required:true
			},
			phone_number:{
				required:true,
				maxlength:12,
				minlength:12,
				number: true
			},
			advisor_location:{
				required:true,
			},
			days:{
				required:true,
			},
			start_time:{
				required:true,
			},
			end_time:{
				required:true,
			},
			specialty:{
				required:true,
			},
			status:{
				required:true,
			}
			
		
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	// Add  Adminstrator
	$("#add_admin").validate({
		rules:{
			username:{
				required:true
			},
			password:{
				required:true
			}
			
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			phone_number:{
				required:true,
				number:true,
				minlength:10,
				maxlength:16
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#text_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			body:{
				required:true,
				text:true,
				minlength:0,
				maxlength:100
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#password_validate1").validate({
		rules:{
			password:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#password"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#delFarmer").click(function(){
		if(confirm('Are You Sure You Want To Delete ?')){
			return true;
		}
		return false;
	});
});
