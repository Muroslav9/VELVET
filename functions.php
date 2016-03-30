<?php
function velvet_error(){
	get_template_part('/lib/error');
}
function velvet_load(){
	/* add nav menu from admin panel */
	register_nav_menu( 'primary', __('Navigation menu', 'velvet') );

	/* add background from admin panel */
	$defaults = array(
		'default-color' => 'fdfdfd'
	);
	add_theme_support( 'custom-background', $defaults );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );
	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	/* sidebar */
	register_sidebar(array('name'=>'sidebar'));
  register_sidebar(array('name'=>'Footer-Sidebar'));
}
add_action('after_setup_theme','velvet_load');

add_filter('show_admin_bar', '__return_false');

function velvet_slider() { 
/*******************************/
/*******************************/
}
add_shortcode('slider', 'velvet_slider');

function my_dashicons() {
    wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'my_dashicons' );

function velvet_navigation( $before = '', $after = '', $echo = true ) {
	/* ================ Настройки ================ */
	$text_num_page = ''; // Текст перед пагинацией. {current} - текущая; {last} - последняя (пр. 'Страница {current} из {last}' получим: "Страница 4 из 60" )
	$num_pages = 10; // сколько ссылок показывать
	$stepLink = 0; // ссылки с шагом (значение - число, размер шага (пр. 1,2,3...10,20,30). Ставим 0, если такие ссылки не нужны.
	$backtext = '…« '; // текст "перейти на предыдущую страницу". Ставим 0, если эта ссылка не нужна.
	$nexttext = ' »…'; // текст "перейти на следующую страницу". Ставим 0, если эта ссылка не нужна.
	$first_page_text = 'на початок'; // текст "к первой странице". Ставим 0, если вместо текста нужно показать номер страницы.
	$last_page_text = 'в кінець'; // текст "к последней странице". Ставим 0, если вместо текста нужно показать номер страницы.
	/* ================ Конец Настроек ================ */ 
	global $wp_query;
	$posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
	$paged = (int) $wp_query->query_vars['paged'];
	$max_page = $wp_query->max_num_pages;
	//проверка на надобность в навигации
	if( $max_page <= 1 )
		return false; 
	if( empty($paged) || $paged == 0 ) 
		$paged = 1;
	$pages_to_show = intval( $num_pages );
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor( $pages_to_show_minus_1/2 ); //сколько ссылок до текущей страницы
	$half_page_end = ceil( $pages_to_show_minus_1/2 ); //сколько ссылок после текущей страницы
	$start_page = $paged - $half_page_start; //первая страница
	$end_page = $paged + $half_page_end; //последняя страница (условно)
	if( $start_page <= 0 ) 
		$start_page = 1;
	if( ($end_page - $start_page) != $pages_to_show_minus_1 ) 
		$end_page = $start_page + $pages_to_show_minus_1;
	if( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}
	if( $start_page <= 0 ) 
		$start_page = 1;
	//выводим навигацию
	$out = '';
	// создаем базу чтобы вызвать get_pagenum_link один раз
	$link_base = get_pagenum_link( 99999999 ); // 99999999 будет заменено
	$link_base = str_replace( 99999999, '___', $link_base);
	$first_url = get_pagenum_link( 1 );
	$out .= $before . "<div class='col-sm-12 navigation'>\n";
		if( $text_num_page ){
			$text_num_page = preg_replace( '!{current}|{last}!', '%s', $text_num_page );
			$out.= sprintf( "<span class='pages'>$text_num_page</span> ", $paged, $max_page );
		}
		// в начало
			$out.= '<span class="col-md-2 col-sm-3 col-xs-12 previous-entries"><a class="btn-pagin-text first" href="'. $first_url .'">'. ( $first_page_text ? $first_page_text : 1 ) .'</a></span> ';
			$out .= '<div class="col-sm-6 col-md-offset-2 col-xs-12 paginavi">';
		// назад
		if ( $backtext && $paged != 1 ) 
			$out .= '<a class="prev" href="'. str_replace( '___', ($paged-1), $link_base ) .'">'. $backtext .'</a> ';
		// пагинация
		for( $i = $start_page; $i <= $end_page; $i++ ) {
			if( $i == $paged )
				$out .= '<span class="current">'.$i.'</span> ';
			elseif( $i == 1 )
				$out .= '<a href="'. $first_url .'">1</a> ';
			else
				$out .= '<a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a> ';
		}
		//ссылки с шагом
		if ( $stepLink && $end_page < $max_page ){
			for( $i = $end_page+1; $i<=$max_page; $i++ ) {
				if( $i % $stepLink == 0 && $i !== $num_pages ) {
					if ( ++$dd == 1 ) 
					$out.= '<a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a> ';
				}
			}
		}
		// вперед
		if ( $nexttext && $paged != $end_page ) 
			$out.= '<a class="next" href="'. str_replace( '___', ($paged+1), $link_base ) .'">'. $nexttext .'</a> ';
		// в конец
			$out.= '</div><span class="col-md-2 col-sm-3 col-xs-12 next-entries"><a class="btn-pagin-text last" href="'. str_replace( '___', $max_page, $link_base ) .'">'. ( $last_page_text ? $last_page_text : $max_page ) .'</a></span> ';
	$out .= "</div>". $after ."\n";
	if ( ! $echo ) 
		return $out;
	echo $out;
}

if( !current_user_can( 'edit_users' ) ){
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
	// для 3.0+
	add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );
}

function velvet_login(){
				if(!is_user_logged_in()) { ?>		
	 		    <div class="log_in">
					<a class="btn" data-toggle="modal" data-target="#myModal">[Log in]</a>
				</div> -->
				<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				    <div class="modal-dialog">
				    	<div class="modal-content">
					        <div class="modal-header">
					        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					        	<h4 class="modal-title" id="myModalLabel">Login Form</h4>
					        </div>
				        <div class="modal-body">
				        	<form name="loginform" id="loginform" action="<?php echo wp_login_url();?>" method="post">
								<p class="login-username">
									<label for="user_login">Username*</label>
									<input type="text" name="log" id="user_login" class="form-control" value="" size="20" tabindex="10" required/>
								</p>
								<p class="login-password">
									<label for="user_pass">Password*</label>
									<input type="password" name="pwd" id="user_pass" class="form-control" value="" size="20" tabindex="20" required/>
								</p>
								<p class="login-submit">
									<input type="submit" name="wp-submit" id="wp-submit" class="btn" value="Submit" tabindex="100" />
									<input type="hidden" name="redirect_to" value="<?php echo get_bloginfo('siteurl');?>" />
								</p>
							</form>
				        </div>
				        <div class="modal-footer">
				        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        </div>
				      </div><!-- /.modal-content -->
				    </div><!-- /.modal-dialog -->
				  </div><!-- /myModal -->

				<?php   } elseif( current_user_can('administrator') ){ 
							require_once("lib/administrator.php");
						} elseif( current_user_can('editor') ){ 
							require_once("lib/editor.php");
						} elseif( current_user_can('author') ){ 
							require_once("lib/author.php");
						} elseif( current_user_can('contributor') ){ 
							require_once("lib/contributor.php");
						} elseif( current_user_can('subscriber') ){ 
							require_once("lib/subscriber.php");
						}
} 

$themename = "[VELVET]";
$shortname = "v";
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category");
$options = array (
  
array(  "name" => $themename." Options",
   		"type" => "title"),
array(  "name" => "Layout",
   		"type" => "section"),
array(  "type" => "open"),
array(  "name" => "Choose Your Layout Style",
    	"desc" => "Select the layout style for the theme",
    	"id" => $shortname."_color_scheme",
    	"type" => "select",
    	"options" => array("wide", "boxed")),
array(  "name" => "Logo URL",
    	"desc" => "Enter the link to your logo image",
    	"id" => $shortname."_logo",
    	"type" => "text",
    	"std" => ""),
array(  "name" => "Custom CSS",
    	"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
    	"id" => $shortname."_custom_css",
    	"type" => "textarea",
    	"std" => ""),        
array(  "type" => "close"),
array(  "name" => "Homepage",
    	"type" => "section"),
array(  "type" => "open"),
array(  "name" => "Homepage header image",
    	"desc" => "Enter the link to an image used for the homepage header.",
    	"id" => $shortname."_header_img",
    	"type" => "text",
    	"std" => ""), 
array(  "name" => "Homepage featured category",
    	"desc" => "Choose a category from which featured posts are drawn",
    	"id" => $shortname."_feat_cat",
    	"type" => "select",
    	"options" => $wp_cats,
    	"std" => "Choose a category"),
array(  "type" => "close"),
array(  "name" => "Footer",
    	"type" => "section"),
array(  "type" => "open"), 
array(  "name" => "Footer copyright text",
    	"desc" => "Enter text used in the right side of the footer. It can be HTML",
    	"id" => $shortname."_footer_text",
    	"type" => "text",
    	"std" => ""),
array(  "name" => "Google Analytics Code",
    	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
    	"id" => $shortname."_ga_code",
    	"type" => "textarea",
    	"std" => ""),    
array(  "name" => "Custom Favicon",
    	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
    	"id" => $shortname."_favicon",
    	"type" => "text",
    	"std" => get_bloginfo('url') ."/favicon.ico"),    
array(  "name" => "Feedburner URL",
    	"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
    	"id" => $shortname."_feedburner",
    	"type" => "text",
    	"std" => get_bloginfo('rss2_url')),
array(  "type" => "close")
);

function mytheme_add_admin() {
  
global $themename, $shortname, $options;
  
if ( $_GET['page'] == basename(__FILE__) ) {
  
    if ( 'save' == $_REQUEST['action'] ) {
  
        foreach ($options as $value) {
        update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
  
foreach ($options as $value) {
    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
  
    header("Location: admin.php?page=functions.php&saved=true");
die;
  
} 
else if( 'reset' == $_REQUEST['action'] ) {
  
    foreach ($options as $value) {
        delete_option( $value['id'] ); }
  
    header("Location: admin.php?page=functions.php&reset=true");
die;
  
}
}
  
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
  
global $themename, $shortname, $options;
$i=0;
  
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
  
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>
  
<div class="rm_opts">
<form method="post">
  <?php foreach ($options as $value) {
switch ( $value['type'] ) {
  
case "open":
?>
  
<?php break;
  
case "close":
?>
  
</div>
</div>
<br />
 
  
<?php break;
  
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>
 
  
<?php break;
  
case 'text':
?>
 
<div class="rm_input rm_text">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
  
 </div>
<?php
break;
  
case 'textarea':
?>
 
<div class="rm_input rm_textarea">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
  
 </div>
   
<?php
break;
  
case 'select':
?>
 
<div class="rm_input rm_select">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
     
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
        <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>
 
    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
  
case "checkbox":
?>
 
<div class="rm_input rm_checkbox">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
     
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
 
 
    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break;
case "section":
 
$i++;
 
?>
 
<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/images/images.jpg" class="inactive" alt=""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">
 
  
<?php break;
  
}
}
?>
  
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
</div> 
  
 
<?php
}
 
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');

function mytheme_add_init() {
	$file_dir=get_bloginfo('template_directory');
	wp_enqueue_style("functions", $file_dir."/lib/admin/edit.css", false, "1.0", "all");
	wp_enqueue_script("rm_script", $file_dir."/lib/admin/edit.js", false, "1.0");
}