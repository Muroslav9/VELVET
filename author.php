<?php get_header();?>
		<h2 class="author-enrties">About author</h2>
		<div class="col-sm-12 col-xs-12 about-author">
			<div class="col-sm-3 col-xs-12 about-author-img">
				<span class="img-thumbnail"><?php echo get_avatar( $comment, 72 ); ?></span>
			</div>
			<div class="col-sm-9 col-xs-12">
				<?php if(get_the_author_meta('user_nicename')){ ?>
				<div class="col-sm-12 col-xs-12">
					<span class="col-sm-4 col-xs-12 author-info">Author name: </span>
					<span class="col-sm-8 col-xs-12"><?php echo get_the_author_meta('user_nicename');?></span>
				</div>
				<?php } ?>
				<?php if(get_the_author_meta('user_email')){ ?>
				<div class="col-sm-12 col-xs-12">
					<span class="col-sm-4 col-xs-12 author-info">Author email: </span>
					<span class="col-sm-8 col-xs-12"><?php echo get_the_author_meta('user_email');?></span>
				</div>
				<?php } ?>
				<?php if(get_the_author_meta('description')){ ?>
				<div class="col-sm-12 col-xs-12">
					<span class="col-sm-4 col-xs-12 author-info">Author description: </span>
					<span class="col-sm-8 col-xs-12"><?php echo get_the_author_meta('description');?></span>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="col-lg-9 col-sm-8 col-xs-12">
		<h2 class="author-enrties">Entries by <span class="cyan-color"><?php the_author();?></span></h2>
		<?php if (have_posts()) { ?>
		<?php while (have_posts()) { the_post(); ?> 
			<article class="post-<?php the_ID();?>">
				<div class="post-title">
					<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
					<div class="section-title-bottom-line-single"></div>
					<span>Posted on <?php echo get_the_date(); ?></span>
					<div class="section-title-bottom-line-single"></div>
				</div>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
				<div class="post-footer">
					<span class="post-comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span> 
					<span class="post-cat">Category: <a href="#"><?php the_category(' / ') ;?></a></span>
					<?php the_tags('Tags: ', ' / '); ?>
				</div>
			</article>
		<?php } } else { ?>
			<?php velvet_error();?>
		<?php } ?> 
		</div>
<?php get_sidebar();?>
<?php velvet_navigation(); ?>
<?php get_footer();?>
