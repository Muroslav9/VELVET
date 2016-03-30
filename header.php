<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3c.org/TR/xhtml/11/DTD/xhtml/11.dtd">
<html xmlns="http://www.w3c.org/1999/xhtml" <?php language_attributes();?>>
	<head profile = "http://gmpg.org/xfn/11">
		<title><?php bloginfo('name');?><?php wp_title();?></title>
		<meta http-equiv = "Content-Type" content="<?php bloginfo('html_type');?> charset=<?php bloginfo('charset');?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/bootstrap.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/bootstrap-theme.css" />
		<?php wp_head();?>
	</head>
	<body <?php body_class(); ?>>
		<div class="container-fluid">
			<div class="row navbar navbar-inverse">
				<div class="header container">
					<div class="navbar-header">
						<a class="navbar-brand" href="/velvet/">[ VELVET ]</a>
		                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-inverse-collapse">
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                </button>
		            </div>
					<?php wp_nav_menu( array(   'theme_location'  => 'primary',
											    'container'       => 'nav',
												'container_class' => 'navbar-collapse collapse navbar-inverse-collapse',
												'menu_class'	  => 'nav navbar-nav' ) ); ?>
				</div>
			</div>	
			<?php velvet_login();?>
			<div class="container content">