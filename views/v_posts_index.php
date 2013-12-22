<div class="content">
	<!-- Print the header of the page -->
	<h1><?=$user->first_name?> - Posts from users that you are following:</h1>
	<!-- Print the posts from the users they are following -->
	<?php foreach($posts as $post): ?>
		<div class="post">
			<!-- if user has an avatar then show the avatar -->
			<?php if(($post['avatar'] != "placeholder.png") && ($post['avatar'] != "")): ?>
				<p class="avatar"><img src="/uploads/avatars/<?=$post['avatar']?>" alt="<?=$post['alt']?>" height="100" width="100"></p>
			<?php endif; ?>
			<!-- Print Post user's name -->
			<h3><?=$post['first_name']?> <?=$post['last_name']?> posted:</h3>
			<!-- Print user's post content -->
			<p><?=$post['content']?></p>
			<!-- Print post created timestamp -->
			<p><?= date('F d, Y @ g:ia',$post['created'])?></p>
		</div>
	<?php endforeach; ?>
</div>
