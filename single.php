<?php get_header(); ?>
			<div class="col-lg-9 col-sm-8 col-xs-12">
				<?php if (have_posts()) { ?>
				<?php while (have_posts()) { the_post(); ?> 
					<div class="post-title">
						<h1><?php the_title(); ?></h1>
						<div class="section-title-bottom-line-single"></div>
						<span>Posted on <?php echo get_the_date(); ?></span>
						<span> by <?php the_author_posts_link(); ?></span>
						<div class="section-title-bottom-line-single"></div>
					</div>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
					<?php comments_template(); ?>
				<?php } ?>
				<div class="col-sm-12">
				<div class="col-sm-6 col-xs-12 previous-entries-single"><?php previous_post_link('%link'); ?></div>
				<div class="col-sm-6 col-xs-12 next-entries-single"><?php next_post_link('%link') ;?></div> 
				</div>
				<?php } ?>
			</div>
  <!--/content -->
  <?php get_sidebar(); ?>
  <?php get_footer(); ?>