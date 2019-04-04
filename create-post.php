<?php require 'header.php'; ?>

<?php
if ( isset( $_POST['submit'] ) ) {
	$now      = date( 'Y-m-d H:i:s' );
	$date     = $_POST['date'] ?: $now;
	$modified = $_POST['modified'] ?: $now;
	$title    = $_POST['title'] ?: 'New Post';
	$content  = $_POST['content'] ?: 'This is just placeholder content. Edit or delete this.';
	$type     = 'post';

	try {
		$sql  = 'INSERT INTO posts (date, modified, title, content, type) VALUES (?,?,?,?,?)';
		$stmt = $conn->prepare( $sql );
		$stmt->execute( [ $date, $modified, $title, $content, $type ] );
	} catch ( PDOException $e ) {
		echo 'Error Adding Row: ' . $e->getMessage();
	}
}
?>

<h1>Create Post</h1>
<form action="" method="post">
	<div>
		<label for="title">Title:</label>
		<input type="text" name="title">
	</div>
	<div>
		<label for="content">Content</label>
		<textarea name="content"></textarea>
	</div>
	<input type="submit" name="submit" value="Submit">
</form>

<?php
require 'footer.php';
