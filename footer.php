<?php
if ( is_logged_in() ) :
	?>
	<h2>Temporary Navigation</h2>
	<?php list_file_links( 'php' ); ?>
	<a href="<?php site_url(); ?>login.php?logout=true">Logout</a>
	<?php
endif;
?>
</div>
</body>
</html>
