<?php require 'header.php'; ?>

<?php
if ( isset( $_POST['submit'] ) ) {
	$id       = $_GET['id'];
	$modified = date( 'Y-m-d H:i:s' );
	$title    = $_POST['title'];
	$content  = $_POST['content'];
	$type     = 'post';

	try {
		$sql  = 'INSERT INTO posts (date, modified, title, content, type) VALUES (?,?,?,?,?)';
		$sql  = 'UPDATE posts SET modified=?, title=?, content=? WHERE id=?';
		$stmt = $conn->prepare( $sql );
		$stmt->execute( [ $modified, $title, $content, $id ] );
		echo '<p class="text-success">post updated</p>';
	} catch ( PDOException $e ) {
		echo '<p class="text-danger">Error Adding Row: ' . $e->getMessage() . '</p>';
	}
}
?>


<?php
if ( ! $_GET['id'] ) {
	echo 'no post to edit';
	die();
}
try {
	$post_id = $_GET['id'] ?: 1;
	$sql = "SELECT * FROM posts WHERE ID=$post_id LIMIT 1";
	$post = $conn->query($sql)->fetch();
} catch ( PDOException $e ) {
	echo 'Error Getting Post: ' . $e->getMessage();
}
?>
<a href="<?php echo get_site_directory() . '/single.php?id=' . $post['ID']; ?>">View Post</a>
<h1>Edit Post</h1>
<form action="" method="post">
	<div>
		<label for="title">Title:</label>
		<input type="text" name="title" value="<?php echo $post['title']; ?>">
	</div>
	<div>
		<label for="content">Content</label>
		<textarea name="content"><?php echo $post['content']; ?></textarea>
	</div>
	<input type="submit" name="submit" value="Submit">
</form>

<?php
require 'footer.php';
