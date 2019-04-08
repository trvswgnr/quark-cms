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
<?php if ( is_current_file( 'create-post.php' ) || is_current_file( 'edit-post.php' ) ) : ?>
	<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=unt9ua16ospnja64euz4j8h7o4bicm35qq1y033fq9rf9fyl"></script>
	<script>
	tinymce.init( {
		selector: '.js-content-editor',
		plugins: 'advcode'
	} );
	</script>
<?php endif; ?>
</body>
</html>
