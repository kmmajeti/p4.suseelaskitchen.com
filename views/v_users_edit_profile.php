<div class="content">
	<!-- Form to display edit profile page elements -->
	<form method='POST' id="editProfile" action='/users/p_edit_profile' enctype="multipart/form-data">
		<!-- Print the header of the edit profile page -->
		<h1><?=$user->first_name?>, Edit your Profile</h1>
		<div class="formElements">
			<label for="first_name">First Name:</label>
			<input id="first_name" type='text' name='first_name' value="<?=$user->first_name?>">
			<br>
			<label for="last_name">Last Name:</label>
			<input id="last_name" type='text' name='last_name' value="<?=$user->last_name?>">
			<br>
			<label for="email">Email:</label>
			<input id="email" type='email' name='email' disabled="disabled" value="<?=$user->email?>">
			<br>
			<label for="password">Password:</label>
			<input id="password" type='password' name='password' disabled="disabled" value="<?=$user->password?>">
			<br>
			<label for="location">Location:</label>
			<input id="location" type='text' name='location' value="<?=$user->location?>">
			<br>
			<!-- if user has an avatar show the avatar and also an option to replace -->
			<?php if($user->alt != "placeholder avatar"): ?>
				<label for="avatar">Current Avatar:</label>
				<img src="<?=$user->avatar?>" alt="<?=$user->alt?>" height="50" width="50">
				<br>
				<label for="avatar">To Replace Avatar:</label>
			<!-- Otherwise, show the lable for avatar to select -->
			<?php else: ?>
				<label for="avatar">Avatar:</label>
			<?php endif; ?>
			<input id="avatar" type='file' name='avatar'>
			<br>
			<label for="bio">Bio:</label>
			<textarea id="bio" name="bio" rows="10" cols="50"><?=$user->bio?></textarea>
			<br>
			<!-- Submit button to update the user's profile with the changes made -->
			<div class="submitButton">
				<input type='submit' value='Update Profile'>
			</div>
		</div>
	</form>
	<!-- Cancel button to navigate back to user's profile page without doing an update -->
	<div class="submitButton signInButton">
		<form action="/users/profile" method="post"><button>Cancel</button></form>
	</div>
</div>