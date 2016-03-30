<div class="log_out">
	<ul class="velvet_menu">
		<b>MENU</b>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/index.php">Admin panel</a>
		</li>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/post-new.php">New post</a>
		</li>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/post-new.php?post_type=page">New page</a>
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
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/edit-comments.php?comment_status=moderated">Comments moderated</a>
		</li>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/edit-comments.php">All comments</a>
		</li>
		<hr>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/edit-tags.php?taxonomy=post_tag">Tags</a>
		</li>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/edit-tags.php?taxonomy=category">Categories</a>
		</li>
		<li>
			<a href="<?php echo get_bloginfo('siteurl');?>/wp-admin/plugins.php">Plugins</a>
		</li>
		<li>
			<a href="<?php echo wp_logout_url( home_url() ); ?>">Log out</a>
		</li>
	</ul>
</div>