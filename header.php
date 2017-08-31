<!doctype html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title('&mdash;', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <meta name="viewport" content="width=device-width">

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        window.___gcfg = {lang: 'pt-BR'};

          (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/platform.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>

        <?php do_action('before'); ?>

        <header class="site-header wrap">
            <a href="#main" title="<?php esc_attr_e('Ir para o conteúdo', 'cultural'); ?>" class="assistive-text"><?php _e('Ir para o conteúdo', 'cultural'); ?></a>

            <ul id="tabs-menu-handler" class="toggle-bar">
                <li><a href="#tabs-1" class="current main-toggle" data-tab="tab-1"><i class="fa fa-list-ul"></i></a></li>
                <?php if (is_active_sidebar('header-widget-area')) : ?>
                    <li><a href="#tab-2" class="highlights-toggle" data-tab="tab-2"><i class="fa fa-search"></i></a></li>
                <?php endif; ?>
                <li><a href="#tab-3" class="calendar-toggle" data-tab="tab-3"><i class="fa fa-calendar"></i></a></li>
            </ul>

			<div class="toggle-bar hidden" id="mobile-menu-handler">
				<a href="#tab-2" class="highlights-toggle alignright" data-tab="tab-2"><i class="fa fa-bars"></i></a> &nbsp;
			</div>

            <div id="share-buttons">
                <span><?php _e("Compartilhe:","cultural");?></span>
                <a href="#" title="<?php esc_attr_e('Compartilhar no Facebook', 'cultural'); ?>" class="facebook js-share"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook_button_share.png" alt="Facebook"></a>
                <a href="#" title="<?php esc_attr_e('Compartilhar no Twitter', 'cultural'); ?>" class="twitter js-share"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/twitter_button_share.png" alt="Twitter"></a>
                <a href="#" title="<?php esc_attr_e('Compartilhar no Google Plus', 'cultural'); ?>" class="gplus js-share"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/gplus_button_share.png" alt="Google+"></a>
            </div>

            <div id="tabs" class="toggle-tabs">
                <div class="site-header-inside">
                    <!-- Logo, description and main navigation -->
                    <div id="tab-1" class="tab-content current animated fadeIn">
                        <nav id="mobile-nav" class="hidden" role="navigation">
							<?php wp_nav_menu(array('theme_location' => 'mobile', 'container' => false, 'menu_class' => 'menu--mobile  menu', 'fallback_cb' => false)); ?>
						</nav>
                        <div class="branding">
                            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                                <?php
                                $logo = get_theme_mod('site_logo');
                                if ($logo == ''):
                                    ?>
                                    <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                                <?php else: ?>
                                    <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
                                <?php endif; ?>
                            </a>
                        </div>
                        
                        <nav class="access cf js-access" role="navigation">
                            <?php
                            if (!wp_is_mobile()) :
                                wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu--main  menu', 'fallback_cb' => 'default_menu'));
                                wp_nav_menu(array('theme_location' => 'secondary', 'container' => false, 'menu_class' => 'menu--sub  menu', 'fallback_cb' => false));
                                ?>
                            <?php endif; ?>
                        </nav>
                    </div>

                    <?php if (is_active_sidebar('header-widget-area')) : ?>
                        <div id="tab-2" class="tab-content animated fadeIn">
                            <?php dynamic_sidebar('header-widget-area'); ?>
                        </div>
                    <?php endif; ?>

                    <div id="tab-3" class="tab-content animated fadeIn">
                        <?php get_template_part('inc/featured-posts'); ?>
                        <div class="tab__description">
                            <a href="#"><i class="fa fa-arrow-right"></i> <?php _e('Ver mais eventos','cultural');?></a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="main  cf">
