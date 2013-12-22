//javascript code to validate the form input fields on signin form-->
$(function(){
	$("#signInForm").validate({
		errorClass: "invalid",
		rules: {
			password: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			password: " Please specify your password to Login",
			email: {
				required: " Please specify your email",
				email: " Please enter your email address in the format of name@domain.com"
			}
		}
	});
});

//javascript code to validate the form input fields on signUp form-->
$(function(){
	$("#signUpForm").validate({
		errorClass: "invalid",
		rules: {
			first_name: "required",
			last_name: "required",
			password: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			first_name: " Please specify your First Name",
			last_name: " Please specify your Last Name",
			password: " Please specify your password to Login",
			email: {
				required: " Please specify your email",
				email: " email address must be in the format of name@domain.com"
			}
		}
	});
});

//javascript code to validate the form input fields on edit profile form-->
$(function(){
	$("#editProfile").validate({
		errorClass: "invalid",
		rules: {
			first_name: "required",
			last_name: "required",
			password: "required"
		},
		messages: {
			first_name: " Please specify your first name",
			last_name: " Please specify your last name",
			password: " Please specify your password to login"
		}
	});
});

