<div class="content">
	<!-- Print the header of the login page-->
	<div class="welcome">
		<h2>Member Login</h2>
	</div>
	<div class="login">
		<!-- Form to display login elements -->
		<form method='POST' id="signInForm" action='/users/p_login' autocomplete="off">
			<div class="formElements">
				<label for="email">Email:</label>
				<input id="email" type='email' name='email'>
				<br><br>
				<label for="password">Password:</label>
				<input id="password" type='password' name='password'>
				<br><br>
				<div class="submitButton">
					<input type='submit' name='login' value='Log in'>
				</div>
			</div>
		</form>
	</div>
	<!-- Print the error message incase if login failed-->
	<?php if(isset($error)): ?>
			<h3 class="invalid">Login failed! Please double check your email and password.</h3>
	<?php endif; ?>
	
</div>
