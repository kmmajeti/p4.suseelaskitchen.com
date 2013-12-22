<?php
class posts_controller extends base_controller {
	# Code here to call the base constructor
	public function __construct() {
			# Call the base constructor
			parent::__construct();

			# Make sure user is logged in if they want to use anything in this controller
			if(!$this->user) {
					die("This page is for Members only. Please <a href='/users/login'>Login</a>");
			}
	}

	# Code here to call the Posts Index page to display all posts
	public function index() {
		# Set up the View
		$this->template->content = View::instance('v_posts_index');
		$this->template->title   = "All Posts";

		# Query to select the posts in descending order
		$q = 'SELECT 
						posts.content,
						posts.created,
						posts.user_id AS post_user_id,
						users_users.user_id AS follower_id,
						users.first_name,
						users.last_name,
						users.avatar,
						users.alt
				FROM posts
				INNER JOIN users_users 
						ON posts.user_id = users_users.user_id_followed
				INNER JOIN users 
						ON posts.user_id = users.user_id
				WHERE users_users.user_id = '.$this->user->user_id.'
				ORDER BY posts.created DESC';

		# Run the query, store the results in the variable $posts
		$posts = DB::instance(DB_NAME)->select_rows($q);

		# Pass data to the View
		$this->template->content->posts = $posts;

		# Render the View
		echo $this->template;
	}

	# Code here to call the Add Post page
	public function add() {

			# Setup view
			$this->template->content = View::instance('v_posts_add');
			$this->template->title   = "New Post";

			# Load JS files
			$client_files_body = Array(
				"/js/jquery.form.js",
				"/js/posts_add.js"
			);
			
			$this->template->client_files_body = Utils::load_client_files($client_files_body);   
			
			# Render template
			echo $this->template;
	}

	# Code here to process the Add Post page
	public function p_add() {

			# Associate this post with this user
			$_POST['user_id']  = $this->user->user_id;

			# Unix timestamp of when this post was created / modified
			$_POST['created']  = Time::now();
			$_POST['modified'] = Time::now();

			# Insert if content is not empty
			# Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
			if(!empty($_POST['content'])) {
				$new_post_id = DB::instance(DB_NAME)->insert('posts', $_POST);
				
				# Set up the view
				$view = View::instance('v_posts_p_add');

				# Pass data to the view
				$view->created     = $_POST['created'];
				$view->new_post_id = $new_post_id;

				# Render the view
				echo $view;
			} 
	}
	
	
	# Code here to process the delete Post
	public function p_delete($post_id = NULL) {

		# Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
		$post_id = DB::instance(DB_NAME)->sanitize($post_id);

		# Delete the post when the post_id belongs to the current user
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND post_id = '.$post_id;
		DB::instance(DB_NAME)->delete('posts', $where_condition);
	
		# Send them back to the user's profile page 
		Router::redirect('/users/profile');
	}
	
	# Code here to call the users (manage fellows) form
	public function users() {

		# Set up the View
		$this->template->content = View::instance("v_posts_users");
		$this->template->title   = "Users";

		# Build the query to get all the users
		$q = "SELECT *
						FROM users
						ORDER BY first_name ASC";

		# Execute the query to get all the users. 
		# Store the result array in the variable $users
		$users = DB::instance(DB_NAME)->select_rows($q);

		# Build the query to figure out what connections does this user already have? 
		# I.e. who are they following
		$q = "SELECT * 
				FROM users_users
				WHERE user_id = ".$this->user->user_id;

		# Execute this query with the select_array method
		# select_array will return our results in an array and use the "users_id_followed" field as the index.
		# This will come in handy when we get to the view
		# Store our results (an array) in the variable $connections
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

		# Pass data (users and connections) to the view
		$this->template->content->users       = $users;
		$this->template->content->connections = $connections;

		# Render the view
		echo $this->template;
	}
	
	# Code here to show the users followed
	public function follow($user_id_followed) {

		# Prepare the data array to be inserted
		$data = Array(
				"created" => Time::now(),
				"user_id" => $this->user->user_id,
				"user_id_followed" => $user_id_followed
				);

		# Do the insert
		DB::instance(DB_NAME)->insert('users_users', $data);

		# Send them back
		Router::redirect("/posts/users");
	}

	# Code here to show the users unfollowed
	public function unfollow($user_id_followed) {

		# Delete this connection
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
		DB::instance(DB_NAME)->delete('users_users', $where_condition);

		# Send them back
		Router::redirect("/posts/users");
	}
	
}
?>
