				</div>
		<footer class="container footer">
			<p><?php echo stripslashes(get_option('v_footer_text')); ?></p>
			<div class="section-title-bottom-after-single"></div>
			<div class="border-circle"></div>
			<ul class="ul-footer col-lg-12 col-sm-12">
	   			<?php dynamic_sidebar('Footer-Sidebar') ?>
			</ul>
		</footer>
		<?php wp_footer();?>
		</div> 
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="<?php bloginfo('template_directory'); ?>/js/<?php echo get_option('v_color_scheme'); ?>.js"></script>
	    <!-- Включення мінімізованої збірки всіх плагінів. -->
	    <script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
		<script src="<?php echo get_template_directory_uri();?>/js/velvet.js"></script>
	</body>
</html>