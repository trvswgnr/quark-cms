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
		<li><a href=""><?php echo $post['title']; ?></a></li>
		<?php
		// base directory
		$base_dir = __DIR__;

		// server protocol
		$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';

		// domain name
		$domain = $_SERVER['SERVER_NAME'];

		// base url
		$base_url = preg_replace("!^${doc_root}!", '', $base_dir);

		// server port
		$port = $_SERVER['SERVER_PORT'];
		$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";

		// put em all together to get the complete base URL
		$url = "${protocol}://${domain}${disp_port}${base_url}";

		echo $url; // = http://example.com/path/directory
		?>
	<?php endforeach; ?>
	</ul>
<?php else : ?>
	<p>no posts to display</p>
<?php endif; ?>

<?php
require 'footer.php';
