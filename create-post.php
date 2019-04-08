<?php require 'header.php'; ?>

<?php
if ( isset( $_POST['submit'] ) ) {
	$now      = date( 'Y-m-d H:i:s' );
	$date     = secure_input('date') ?: $now;
	$modified = secure_input('modified') ?: $now;
	$title    = secure_input('title') ?: 'A New Post';
	$content  = filter_input( INPUT_POST, 'content' ) ?: 'Placeholder content!';
	$slug     = secure_input('slug') ?: $title;
	$type     = 'post';

	try {
		$sql  = 'INSERT INTO posts (date, modified, title, content, slug, type) VALUES (?,?,?,?,?,?)';
		$stmt = $conn->prepare( $sql );
		$stmt->execute( [ $date, $modified, $title, sanitize_html( $content ), title_to_slug( $slug ), $type ] );
		echo '<p class="text-success">Post created successfully!</p>';
	} catch ( PDOException $e ) {
		echo 'Error Adding Row: ' . $e->getMessage();
	}
}
?>

<h1>Create Post</h1>
<form action="" method="post">
	<div class="input-group">
		<label for="title">Title</label>
		<input type="text" name="title">
	</div>
	<div class="input-group">
		<label for="slug">Slug</label>
		<input type="text" name="slug">
	</div>
	<div class="input-group">
		<label for="content">Content</label>
		<textarea name="content" id="primary-content-editor" class="textarea-content js-content-editor"></textarea>
	</div>
	<div class="input-group">
		<input type="submit" name="submit" value="Submit">
	</div>
</form>

<?php
require 'footer.php';
