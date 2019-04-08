<?php
/**
 * Quark CMS.
 *
 * @package quark
 * @desc A fast, basic CMS for building and maintaining websites.
 * @author Travis Wagner <travis@travisaw.com>
 * @version 0.3.0-alpha
 */

?>

<?php require 'header.php'; ?>

<?php
$content = "<p>This is the admin home. There's not much to do here now, but it will provide dashboards in the future.</p>
<?php echo 'evil should be escaped'; ?>
<script>console.log('hello');</script>
<p>this is allowed</p>";
?>

<h1>Welcome to Quark CMS!</h1>
<div class="content">
<?php echo kses( $content ); ?>
<div>
<a href="<?php echo esc_url( get_site_url() . 'display-posts.php' ); ?>">View Posts</a>
</div>
</div>
<?php require 'footer.php'; ?>
