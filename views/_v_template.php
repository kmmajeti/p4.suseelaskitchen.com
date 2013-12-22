<!DOCTYPE html>
<html>
	<head>
		<title><?php if(isset($title)) echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<!-- Link to stylesheet -->
		<link href="/css/p4.css" type="text/css" rel="stylesheet"/>
		<!-- Source to jQuery JavaScript Library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
		<!-- Controller Specific JS/CSS -->
		<script type="text/javascript" src="/js/p4.js"> </script>
		<?php if(isset($client_files_head)) echo $client_files_head; ?>
	</head>

	<body>	
		<h1 id="header"><a href="/"><?=APP_NAME?></a></h1>
		<div id='menu'>
			<a href="/">[Home]</a>
			<span> | </span>
			<!-- Menu for users who are logged in -->
			<?php if($user): ?>
				<a href="/users/logout">[Log out]</a>
				<span> | </span>
				<a href="/users/profile">[View Profile]</a>
				<span> | </span>
				<a href="/posts/add">[Add Post]</a>
				<span> | </span>
				<a href="/posts/index">[View Posts]</a>
				<span> | </span>
				<a href="/posts/users">[Manage Fellows]</a>
			<!-- Menu options for users who are not logged in -->
			<?php else: ?>
				<a href="/users/login">[Log in]</a>
				<span> | </span>
				<a href="/users/signup">[Sign Up]</a>
			<?php endif; ?>
		</div>
		<!-- Main content  -->
		<div id='maincontent'>
			<?php if(isset($content)) echo $content; ?>
		</div>
		<!-- Footer content  -->
		<div id='footer'>
			<p>Project: P4 - by Krishna Murthy Majeti</p>
		</div>
		<?php if(isset($client_files_body)) echo $client_files_body; ?>
	</body>
</html>