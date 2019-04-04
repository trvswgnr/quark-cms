<?php
require 'header.php';

$sql       = 'SELECT * FROM posts';
$statement = $conn->prepare( $sql );
$statement->execute();
$posts = $statement->fetchAll();
?>
<?php if ( count( $posts ) > 0 ) : ?>
	<ul>
	<?php foreach ( $posts as $post ) : ?>
		<li><a href="<?php echo get_site_directory() . '/single.php?id=' . $post['ID']; ?>"><?php echo $post['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php else : ?>
	<p>no posts to display</p>
<?php endif; ?>

<?php
require 'footer.php';
