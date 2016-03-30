<div class="log_out">
	<ul class="velvet_menu">
		<b>MENU</b>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/profile.php">Profile</a>
		</li>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/post-new.php">New post</a>
		</li>
		<hr>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/edit.php?post_status=draft">Draft posts</a>
		</li>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/edit.php?post_status=private">Private posts</a>
		</li>
		<hr>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/edit-comments.php">All comments</a>
		</li>
		<hr>
		<li>
			<a href="<?php echo wp_logout_url( home_url() ); ?>">Log out</a>
		</li>
	</ul>
</div>