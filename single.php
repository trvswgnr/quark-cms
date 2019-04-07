<?php
require 'header.php';

try {
	$post_slug = $_GET['slug'];
	$message   = $post_slug == '' ? 'no slug found' : false;
	$sql       = "SELECT * FROM posts WHERE slug='$post_slug' LIMIT 1";
	$post      = $conn->query( $sql )->fetch();
} catch ( PDOException $e ) {
	echo 'Error Getting Post: ' . $e->getMessage();
}
?>

<h1><?php echo sanitize_html( $post['title'] ); ?></h1>
<p><small>Published: <?php echo sanitize_html( $post['date'] ); ?></small></p>
<p><small>Modified: <?php echo sanitize_html( $post['modified'] ); ?></small></p>
<div><?php echo sanitize_html( $post['content'] ); ?></div>
<p>
<a href="<?php echo get_site_url() . 'edit-post.php?id=' . $post['ID']; ?>">Edit</a>
</p>
<?php require 'footer.php'; ?>
