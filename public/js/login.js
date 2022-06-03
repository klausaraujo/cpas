function showPassword() {
    
    var key_attr = $('#key').attr('type');
    
    if(key_attr != 'text') {
        
        $('.checkbox').addClass('show');
        $('#key').attr('type', 'text');
        
    } else {
        
        $('.checkbox').removeClass('show');
        $('#key').attr('type', 'password');
        
    }
    
}

$(document).ready(function(){

		$("#login-form").validate({
			rules:{
				usuario:{required:true},
				key:{required:true}
			},
			messages:{
				usuario:{required:"Ingresa tu usuario"},
				key:{required:"Ingresa tu contrase\xf1a"}
			},
			submitHandler:function(form,event) {
				event.preventDefault();
				$("#btn-login").html('<i class="fa fa-spinner fa-pulse"></i>');
				$("#btn-login").addClass('disabled');
				setTimeout( function() { form.submit(); },3000);
			}
		});

});