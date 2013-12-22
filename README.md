p4.suseelaskitchen.com
======================

Project 4

Description of the application:

	My P4 Project is an extension of my P2 project. The name of the application is 'Chatter' and it is an online microblogging service that enables users to post short status updates and follow the status updates of friends. Added more features such as implemented client side validation using JavaScript and used Ajax on new post form using JS code in posts_add.js. So now instead of submitting new blog posts via traditional POST, it submits via ajax and after submitting a new post the page will receive the data back from ajax such as when the post was created using a separate view named 'v_posts_p_add.php'. I also fixed most of the validation errors and now all pages are validated for HTML5.

	Users can register for free and registered users can login to the system using 'Sign In' button on the home page or by selecting 'Log in' menu item. Upon login to the system, the control takes to the user's profile page and lists the information related to the user such as when was the account created first name, last name and email. User have an option to update his/her profile to add more information such as location, bio and to upload an avatar for profile. User can add new posts using 'Add Post' menu item and the 'View profile' page lists his/her own posts. From 'View Profile' page user can also delete his/her own posts using the 'Delete' button on each post. The 'Manage Fellows' menu will list all registered users in the system and user can decide on whom to follow and whom to unfollow. Follow/Unfollow is a toggle button and navigating to the 'View Posts' page will show the posts from users that you were following based on the selected users on 'Manage Fellows' page. The posts from users will show a thumbnail version of the user's avatar. At the end user can logout the session to exit the session.

List of features:

	a) Login/Sign In
	b) Log out/Sign Out
	c) View Profile
	d) Edit Profile to provide location, bio and upload/replace an avatar for profile
	e) Add Post - To add new post. The page uses Ajax and JS code to receive the data
	f) Total Number of posts on view profile page
	g) Delete posts from user's profile page
	h) Follow/Unfollow other users using Manage fellows
	i) View Posts page will show the posts from the followed users
	j) A thumbnail version of the avatar in user's posts

What aspects are being managed by JavaScript:

	a) Client side validation on Log in page, Sign Up page, Edit profile page
	b) JS code in 'posts_add.js' file is used to receive the data from server and show the results through Ajax using the view (v_posts_p_add.php)
	
Note: Please see the included 'database.sql' file to see exported database SQL code.
