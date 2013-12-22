<?php
class users_controller extends base_controller {
	# Code here to call the base constructor
	public function __construct() {
		# Call the base constructor
		parent::__construct();
	}
	
	# Code here to the index page
	public function index() {
		echo "This is the index page";
	}
	
	# Code here to the signup form
	public function signup($error = NULL) {
		# Setup view
			$this->template->content = View::instance('v_users_signup');
			$this->template->title   = "Sign Up";
		
		# Pass data to the view
		$this->template->content->error = $error;
		
		# Render template
			echo $this->template;
	}
	
	# Code here to process the signup form
	public function p_signup() {
		# More data we want stored with the user
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		# store default placeholder.png as the avatar
		$_POST['avatar'] = "placeholder.png";
		$_POST['alt'] = "placeholder avatar";

		
		# Encrypt the password  
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

		# Create an encrypted token via their email address and a random string
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 
		
		# Search the db for this email to check for the existing account
		$q = "SELECT user_id 
						FROM users 
						WHERE email = '".$_POST['email']."'"; 

		# Verify the result and send it to login page to login if account already exists in db
		$token = DB::instance(DB_NAME)->select_row($q);
		
		# If we find a matching record in the database, it means account already exists
		if($token) {

			# Send them back to the signup page with error
			Router::redirect("/users/signup/error"); 

		# But if we don't find the record, then signup is for new account! 
		} else {

			# Insert this user into the database
			$user_id = DB::instance(DB_NAME)->insert('users', $_POST);

			#Auto Login and retrieve the token if it's available 
			$q = "SELECT token 
							FROM users 
							WHERE user_id = ".$user_id;
									
			$token = DB::instance(DB_NAME)->select_field($q);
			
			# Set cookie to login
			@setcookie("token", $token, strtotime('+1 year'), '/');

			# Redirect to the user's profile page 
			Router::redirect('/users/profile');
		}
	}
	
	# Code here to the login form	
	public function login($error = NULL) {

		# Setup view
		$this->template->content = View::instance('v_users_login');
		$this->template->title   = "Login";

		# Pass data to the view
		$this->template->content->error = $error;

		# Render template
		echo $this->template;
	}
	
	# Code here to process the login form
	public function p_login() {

		# Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);

		# Hash submitted password so we can compare it against one in the db
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		# Search the db for this email and password
		# Retrieve the token if it's available
		$q = "SELECT token 
				FROM users 
				WHERE email = '".$_POST['email']."' 
				AND password = '".$_POST['password']."'";

		$token = DB::instance(DB_NAME)->select_field($q);

		# If we didn't find a matching token in the database, it means login failed
		if(!$token) {

			# Send them back to the login page with error
			Router::redirect("/users/login/error"); 

		# But if we did, login succeeded! 
		} else {

				/* 
				Store this token in a cookie using setcookie()
				Important Note: *Nothing* else can echo to the page before setcookie is called
				Not even one single white space.
				param 1 = name of the cookie
				param 2 = the value of the cookie
				param 3 = when to expire
				param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
				*/
				setcookie("token", $token, strtotime('+1 year'), '/');

				# Redirect to the user's profile page 
				Router::redirect('/users/profile');
		}
	}
	
	# Code here to the logout form
	public function logout() {

		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

		# Create the data array we'll use with the update method
		# In this case, we're only updating one field, so our array only has one entry
		$data = Array("token" => $new_token);

		# Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

		# Delete their token cookie by setting it to a date in the past - effectively logging them out
		setcookie("token", "", strtotime('-1 year'), '/');

		# Send them back to the main index.
		Router::redirect("/");
	}
	
	# Code here to the profile form
	public function profile($user_id = NULL) {

		# If user is blank, they're not logged in; redirect them to the home page
		if(!$this->user) {
				Router::redirect('/');
				die();
		}

		# Setup view
		$this->template->content = View::instance('v_users_profile');
		$this->template->title   = "Profile of ".$this->user->first_name;

		# If there is user_id passed, then set to the current user
		if($user_id === NULL) {
			$user_id = $this->user->user_id;
		} else {
			$user_id = DB::instance(DB_NAME)->sanitize($user_id);
		}

		# Query to select the user information and pass it to the content
		$q = 'SELECT *
						FROM users
						WHERE user_id = '.$user_id;
		
		$profile_user = DB::instance(DB_NAME)->select_row($q);
		$this->template->content->profile_user = $profile_user;
		
						
		# Query to select posts of the user
		$pq = 'SELECT 
						posts.post_id,
						posts.user_id,
						posts.created,
						posts.content
				FROM posts
				JOIN users USING (user_id)
				WHERE user_id = '.$user_id.'
				ORDER BY posts.created DESC';

		# Run the query, store the results in the variable $posts
		$posts = DB::instance(DB_NAME)->select_rows($pq);

		# Pass data to the View
		$this->template->content->posts = $posts;
		
		# Render template
		echo $this->template;
	}
	
	# Code here to the edit_profile form
	public function edit_profile() {

		# If user is blank, they're not logged in; redirect them to the home page
		if(!$this->user) {
				Router::redirect('/');
				die();
		}

		# If they weren't redirected away, continue:

		# Setup view
		$this->template->content = View::instance('v_users_edit_profile');
		$this->template->title   = "Edit Profile of ".$this->user->first_name;

		# Render template
		echo $this->template;
	}
	
	# Code here to process the edit_profile form
	public function p_edit_profile() {
	
		# More data we want stored with the user
		$_POST['modified'] = Time::now();

		# Upload the avatar to server if any image was selected
		if ($_FILES['avatar']['name'] != "") {
			# Upload submitted image to server
			$avatar = Upload::upload($_FILES, "/uploads/avatars/", array("tif", "jpg", "bmp", "gif", "png"), "avatar_".$this->user->user_id);

			# Crop the avatar size and save to the app uploads/avatars folder
			$avatarObj = new Image(APP_PATH."uploads/avatars/".$avatar);
			$avatarObj->resize(100,100,"crop");
			$avatarObj->save_image(APP_PATH."uploads/avatars/".$avatar, 100);

			# Specify an alternate text for avatar
			$_POST['avatar'] = $avatar;
			$_POST['alt'] = "avatar of ".$this->user->first_name;
		} 
		
		# Do not change the password 
		unset($_POST['password']);

		# Do not change the email 
		unset($_POST['email']);

		# Do the update
		DB::instance(DB_NAME)->update("users", $_POST, "WHERE token = '".$this->user->token."'");

		# Redirect to the user's profile page 
		Router::redirect('/users/profile');
	}
}
?>
