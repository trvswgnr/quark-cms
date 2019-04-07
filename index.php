<?php
/**
 * Name: Quark CMS
 * Description: A fast, basic CMS for building and maintaining websites.
 * Author: Travis Wagner
 * Author URI: https://travisaw.com
 * Version: 0.1.0-alpha
 *
 * @package quark
 */

?>

<?php require 'header.php'; ?>
<?php
$content = "<p>This is the home page. Currently it can only be edited with a text editor, which isn't desirable.</p>
<?php echo 'evil should be escaped'; ?>
<script>console.log('hello');</script>
<p>this is allowed</p>";
?>

<h1>Welcome!</h1>
<div class="content">
<?php echo kses( $content ); ?>
<div>
<a href="<?php echo esc_url( get_site_url() . 'display-posts.php' ); ?>">View Posts</a>
</div>
</div>
<?php require 'footer.php'; ?>
