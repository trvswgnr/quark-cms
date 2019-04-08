<?php
if ( is_logged_in() ) :
	?>
	<h2>Temporary Navigation</h2>
	<ul>
		<li><a href="<?php site_url(); ?>">Quark Home</a></li>
		<li><a href="<?php site_url(); ?>display-posts.php">View Posts</a></li>
		<li><a href="<?php site_url(); ?>create-post.php">Create Post</a></li>
		<li><a href="<?php site_url(); ?>add-user.php">Add User</a></li>
	</ul>
	<a href="<?php site_url(); ?>login.php?logout=true">Logout</a>
	<?php
endif;
?>
</div>
</body>
</html>
