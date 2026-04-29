<?php
$title = get_field('home_3_title') ?: __('Diễn giả', 'canhcamtheme');
$speakers = get_field('home_3_speakers');
if ($speakers):
?>
<section class="section-home-3" data-gsap-layout>
	<div class="wrap-padding">
		<div class="container">
			<div class="block-top" data-gsap-options='{"type": "fade-up", "delay": 0.8, "duration": 1}'>
				<h2 class="title-heading heading-2"><?php echo esc_html($title); ?></h2>
				<div class="button-swiper">
					<div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="home-3"><img
							src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt="" /></div>
					<div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="home-3"><img
							src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt="" /></div>
				</div>
			</div>
			<div class="block-bottom" data-gsap-options='{"type": "fade-down", "delay": 1, "duration": 1.2}'>
				<div class="swiper-column-auto auto-3-column" data-id-swiper="home-3">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($speakers as $index => $sp): 
                                $sp_id = $sp->ID;
                                $thumb = get_the_post_thumbnail_url($sp_id, 'large') ?: get_template_directory_uri().'/img/avatar.jpg';
                                $chuc_vu = get_field('position', $sp_id);
                                $popup_id = 'popup-Author-' . $sp_id;
                            ?>
							<div class="swiper-slide">
								<div class="card-author group" data-popup-trigger="<?php echo esc_attr($popup_id); ?>"
									role="button" tabindex="0">
									<div class="card-img">
										<div class="img img-ratio ratio:pt-[440_490] zoom-img">
											<img class="lozad" data-src="<?php echo esc_url($thumb); ?>"
												alt="<?php echo esc_attr($sp->post_title); ?>" />
										</div>
									</div>
									<div class="card-info">
										<div class="info-content">
											<h3 class="info-name heading-3"><?php echo esc_html($sp->post_title); ?>
											</h3>
											<div class="sub-info">
												<p><?php echo esc_html($chuc_vu); ?></p>
											</div>
										</div>
										<div data-toggle="popup-form" data-id-popup="<?php echo esc_attr($popup_id); ?>"
											class="btn-info">
											<span><?php _e('Xem chi tiết', 'canhcamtheme'); ?></span>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="wrap-image-top"><img src="<?php echo get_template_directory_uri(); ?>/img/home-3.svg" alt="" /></div>
</section>

<?php
// Render popups cho từng author
foreach ($speakers as $sp):
    $sp_id = $sp->ID;
    $thumb = get_the_post_thumbnail_url($sp_id, 'large') ?: get_template_directory_uri().'/img/avatar.jpg';
    $chuc_vu = get_field('position', $sp_id);
    $content = get_post_field('post_content', $sp_id);
    $popup_id = 'popup-Author-' . $sp_id;
?>
<section class="popup-wrapper popup-Author" id="<?php echo esc_attr($popup_id); ?>"
	data-id-popup="<?php echo esc_attr($popup_id); ?>" data-lenis-prevent>
	<div class="overlay"></div>
	<div class="popup-content">
		<button class="close-btn">&times;</button>
		<div class="main-content">
			<div class="section-xl-px py-base block-content">
				<div class="box-top">
					<div class="item-left">
						<div class="img img-ratio ratio:pt-[255_216] zoom-img rounded-3">
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($sp->post_title); ?>" />
						</div>
					</div>
					<div class="item-right">
						<strong class="heading-3"><?php echo esc_html($sp->post_title); ?></strong>
						<?php if ($chuc_vu): ?>
						<span class="body-3">
							<?php echo esc_html($chuc_vu); ?></span>
						<?php endif; ?>
					</div>
				</div>
				<?php if ($content): ?>
				<div class="box-bottom">
					<div class="prose">
						<?php echo wp_kses_post($content); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php endforeach; ?>

<?php endif; ?>