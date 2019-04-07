<?php require 'header.php'; ?>
<div class="header">
	<h1>Register</h1>
</div>
<iframe width="100%" height="20px" border="0" name="dummyframe" id="dummyframe" style="border:none;"></iframe>
<form method="post" action="register.php" target="dummyframe">
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="user" value="">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password">
	</div>
	<div class="input-group">
		<label for="role">User Role</label>
		<select name="role" id="role">
			<option value="member">Member</option>
			<option value="admin">Admin</option>
		</select>
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="submit">Register</button>
	</div>
	<p>
		Already a member? <a href="<?php site_url(); ?>login.php">Sign in</a>
	</p>
</form>
<?php require 'footer.php'; ?>
