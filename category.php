<?php get_header();?>
		<h2 class="about-category-tags">Archive for category: <span class="cyan-color"><?php echo single_tag_title( '', false ); ?></span></h2>
			<?php if(category_description()){ ?>
			<div class="col-sm-12 col-xs-12 about-category-tags">
				<span class="col-sm-3 col-xs-12 author-info">Category description: </span>
				<span class="col-sm-9 col-xs-12"><?php echo category_description(); ?></span>
			</div>
			<?php } ?>
		<div class="col-lg-9 col-sm-8 col-xs-12">
		<?php if (have_posts()) { ?>
		<?php while (have_posts()) { the_post(); ?> 
			<article class="post-<?php the_ID();?>">
				<div class="post-title">
					<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
					<div class="section-title-bottom-line-single"></div>
					<span>Posted on <?php echo get_the_date(); ?></span>
					<span> by <?php the_author_posts_link(); ?></span>
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
