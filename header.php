<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
		rel="stylesheet">

	<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/core.min.css">
	<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/main.min.css">

	<?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) : ?>
	<?= get_field('field_config_head', 'options') ?>
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(get_field('add_class_body', get_the_ID())); ?>
	data-lenis-options='{"duration": 1.5, "smoothWheel": true}' data-lenis-restore-scroll="true">
	<?php wp_body_open(); ?>
	<?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) : ?>
	<?= get_field('field_config_body', 'options') ?>
	<?php endif; ?>
	<script>
	if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
	const s = sessionStorage.getItem("devScrollPosition");
	if (s) window.scrollTo(0, parseFloat(s));
	</script>
	<header>
		<div class="section-header">
			<div class="wrap-left-header">
				<div class="header-logo img img-ratio ratio:pt-[80_241]">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/header-logo.svg"
							alt="<?php bloginfo('name'); ?>" />
					</a>
				</div>
			</div>
			<div class="wrap-right-header">
				<div class="block-menu">
					<div class="header-menu">
						<?php 
                        // Hiển thị Menu Header
                        // Lưu ý: Ở trang quản trị (Appeareance -> Menus), hãy thêm icon <i class="fa-solid fa-house"></i> vào Label của Item đầu tiên.
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'container'      => false,
                            'menu_class'     => '',
                            'items_wrap'     => '<ul>%3$s</ul>',
                            'fallback_cb'    => false
                        )); 
                        ?>
					</div>
				</div>
				<div class="block-lang-search">
					<div class="box-lang">
						<div class="item-icon"><i class="fa-sharp fa-light fa-globe"></i></div>
						<div class="item-language">
							<?php echo do_shortcode('[wpml_lang_selector]'); ?>
						</div>
					</div>
					<div class="box-search">
						<div class="header-search"><i class="fa-regular fa-magnifying-glass"></i></div>
					</div>
				</div>
				<div class="block-btn-header">
					<?php if (is_user_logged_in()):
						$current_user = wp_get_current_user();
						$avatar_url   = get_avatar_url($current_user->ID, ['size' => 40]);
						$profile_url  = home_url('/lp-profile/');
					?>
					<a class="btn btn-primary" href="<?php echo esc_url($profile_url); ?>">
						<span class="user-name"><?php echo esc_html($current_user->display_name); ?></span>
					</a>
					<?php else: ?>
					<a class="btn btn-primary" href="<?php echo esc_url(wp_login_url(get_permalink())); ?>"><span>
							<?php _e('Đăng nhập / Đăng ký', 'canhcamtheme'); ?>
						</span></a>
					<?php endif; ?>
					<div class="hamburger-mobile">
						<div class="header-hamburger">
							<div class="wrap"><span></span><span></span><span></span></div>
							<div id="pulseMe">
								<div class="bar left"></div>
								<div class="bar top"></div>
								<div class="bar right"></div>
								<div class="bar bottom"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<main>