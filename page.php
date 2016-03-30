<?php get_header();?>
			<div class="col-lg-9 col-sm-8 col-xs-12">
				<?php if (have_posts()) { ?>
				<?php while (have_posts()) { the_post(); ?> 
					<h2><?php the_title(); ?></h2>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
						<?php comments_template(); ?>
				<?php } ?>
				<?php } ?>
			</div>
  <?php get_sidebar(); ?>
  <?php get_footer(); ?>