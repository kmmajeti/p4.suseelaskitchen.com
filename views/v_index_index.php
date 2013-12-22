<div class="content">
	<!-- Welcome message for the application -->
	<div class="welcome">
		<h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1>
		<p><?=APP_NAME?> is an online microblogging service that enables users to post short status updates and follow the status updates of friends.</p>
	</div>

	<!-- If user is not logged in then show SignIn and Sign Up actions -->
	<?php if(!$user): ?>
		<!-- SignIn button to login on the home page -->
		<div class="submitButton signInButton">
			<form action="/users/login" method="post"><button>Sign in</button></form>
			<br><br>
		</div>

		<!-- link to signup page on the home page -->
		<div class="signUpNow">
			<span>Don't have an account? </span>
			<a href='/users/signup'>Sign up now</a>
		</div>

	<!-- Otherwise, show the Logout action -->
	<?php else: ?>
			<div class="submitButton signInButton">
				<br><br>
				<p>Please sign out before closing the browser...</p>
				<form action="/users/logout" method="post"><button>Sign out</button></form>
				<br><br>
			</div>
	<?php endif; ?>
</div>