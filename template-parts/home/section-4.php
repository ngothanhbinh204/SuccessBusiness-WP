<?php
/**
 * Section 4: Sự kiện – lấy từ CPT su_kien qua relationship field
 * ACF field: home_4_events (relationship: su_kien, return: object)
 * CPT fields: sk_left_subtitle (wysiwyg), sk_btn (link), sk_right_title, sk_right_subtitle, sk_time
 */
$events = get_field('home_4_events'); // array of WP_Post objects
if ($events):
?>
<section class="section-home-4">
	<div class="section-py">
		<div class="container">
			<div class="block-swiper relative">
				<div class="swiper-column-auto auto-1-column" data-id-swiper="home-4"
					data-swiper-options='{"effect": "fade", "speed": 1200,"fadeEffect": { "crossFade": true } }'>
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($events as $event):
                                $event_id    = $event->ID;
                                $left_title  = $event->post_title;
                                $left_sub    = get_field('sk_left_subtitle', $event_id);
                                $btn         = get_field('sk_btn', $event_id);
                                $img_url     = get_the_post_thumbnail_url($event_id, 'large') ?: 'https://picsum.photos/700/450';
                                $img_alt     = get_the_title($event_id);
                                $right_title = get_field('sk_right_title', $event_id);
                                $right_sub   = get_field('sk_right_subtitle', $event_id);
                                $time        = get_field('sk_time', $event_id);
                            ?>
							<div class="swiper-slide">
								<div class="box-grid">
									<div class="item-left item-padding">
										<div class="item-left-icon"><i class="fa-solid fa-calendar-star"></i></div>
										<h2 class="item-left-title"><?php echo esc_html($left_title); ?></h2>
										<?php if ($left_sub): ?>
										<div class="item-left-sub-title">
											<div><?php echo wp_kses_post($left_sub); ?></div>
										</div>
										<?php endif; ?>
										<?php if ($btn && is_array($btn)): ?>
										<a class="btn btn-white" href="<?php echo esc_url($btn['url']); ?>"
											target="<?php echo esc_attr($btn['target'] ?: '_self'); ?>"><span><?php echo esc_html($btn['title']); ?></span></a>
										<?php endif; ?>
									</div>
									<div class="item-center">
										<div class="img img-parallax ratio:pt-[450_700] h-full"
											data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
											<?php echo get_image_post($event_id, 'image'); ?>
										</div>
									</div>
									<div class="item-right item-padding">
										<div class="main-content">
											<span class="item-right-title"><?php echo esc_html($right_title); ?></span>
											<div class="item-right-sub-title">
												<strong><?php echo esc_html($right_sub); ?></strong>
											</div>
										</div>
										<?php if ($time): ?>
										<div class="item-time-event"><span><?php _e('Thời gian diễn ra:', 'canhcamtheme'); ?></span><strong><?php echo esc_html($time); ?></strong></div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="button-swiper">
					<div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="home-4"><img
							src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt="" /></div>
					<div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="home-4"><img
							src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt="" /></div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>