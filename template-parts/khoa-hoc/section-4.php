<?php
$curriculum         = get_field('curriculum_display');
$instructors        = get_field('instructors');
extract( canhcam_get_course_cta() );

if (!$curriculum && !$instructors) return;
?>
<section class="section-courseDetail-4">
	<div class="section-xl-py">
		<div class="container">

			<?php if ($curriculum): ?>
			<div class="block-main course-sync-container section-course-sync row" data-id-swiper="course-01">

				<div class="col-lg-4 box-left course-menu">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($curriculum as $index => $item):
                                $module_title = $item['module_title'];
								$text_buoi = __('Buổi', 'canhcamtheme');
                                $label = $text_buoi . ' ' . ($index + 1);
                            ?>
							<div class="swiper-slide">
								<div class="main-slide-left">
									<div class="item-left"><strong><?php echo esc_html($label); ?></strong></div>
									<?php if ($module_title): ?>
									<div class="item-right"><span><?php echo esc_html($module_title); ?></span></div>
									<?php endif; ?>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<div class="col-lg-4 box-mid course-images">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($curriculum as $index => $item):
                                $module_image = $item['module_image'];
                            ?>
							<div class="swiper-slide">
								<?php if ($module_image): ?>
								<div class="img img-parallax ratio:pt-[524_440] rounded-6"
									data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
									<img src="<?php echo esc_url($module_image['url']); ?>"
										alt="<?php echo esc_attr($module_image['alt']); ?>" />
								</div>
								<?php else: ?>
								<div class="img img-parallax ratio:pt-[524_440] rounded-6">
									<img src="https://picsum.photos/440/524?random=<?php echo get_the_ID() . $index; ?>"
										alt="" />
								</div>
								<?php endif; ?>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<div class="col-lg-4 box-right course-content">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($curriculum as $index => $item):
                                $module_title   = $item['module_title'];
								$module_sub_title   = $item['module_sub_title'];
                                $module_content = $item['module_content'];
								$text_buoi = __('Buổi', 'canhcamtheme');
								$label = $text_buoi . ' ' . ($index + 1);
                            ?>
							<div class="swiper-slide">
								<div class="main-item-right">
									<div class="item-right-top">
										<div class="item-right-icon"><strong><?php echo esc_html($label); ?></strong>
										</div>
										<?php if ($module_sub_title): ?>
										<h3 class="heading-3"><?php echo esc_html($module_sub_title); ?></h3>
										<?php endif; ?>
									</div>

									<?php if ($module_content): ?>
									<div class="item-right-mid">
										<div><?php echo wp_kses_post($module_content); ?></div>
									</div>
									<?php endif; ?>

									<?php if ($show_register || $brochure_file): ?>
									<div class="item-right-bottom">
										<?php if ($show_register): ?>
										<a class="btn btn-white" href="<?php echo esc_url($register_url); ?>"
											target="<?php echo esc_attr($register_target); ?>">
											<span><?php echo esc_html($register_label); ?></span>
										</a>
										<?php endif; ?>
										<?php if ($brochure_file): ?>
										<a class="btn btn-primary" href="#popup-brochure" data-toggle="popup-brochure">
											<span><?php echo esc_html($brochure_btn_title); ?></span>
											<i class="fa-solid fa-download"></i>
										</a>
										<?php endif; ?>
									</div>
									<?php endif; ?>
								</div>

								<div class="button-swiper">
									<div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="course-01">
										<img src="<?php echo esc_url(get_template_directory_uri() . '/img/left-icon.svg'); ?>"
											alt="" />
									</div>
									<div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="course-01">
										<img src="<?php echo esc_url(get_template_directory_uri() . '/img/left-icon.svg'); ?>"
											alt="" />
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

			</div>
			<?php endif; ?>

			<?php if ($instructors): ?>
			<div class="block-swiper">
				<div class="swiper-column-auto auto-1-column" data-id-swiper="courseDetail-4"
					data-swiper-options='{"effect": "fade", "speed": 1200, "fadeEffect": { "crossFade": true }}'>
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($instructors as $instructor):
                                $sp_id    = $instructor->ID;
                                $sp_name  = $instructor->post_title;
                                $sp_thumb = get_the_post_thumbnail_url($sp_id, 'medium_large');
                                $sp_excerpt   = get_the_content(null, false, $sp_id);
                            ?>
							<div class="swiper-slide">
								<div class="card-main-about-4">
									<div class="row">
										<div class="col-md-4">
											<div class="img img-ratio ratio:pt-[491_440] zoom-img">
												<?php echo get_image_post($sp_id, 'image'); ?>
											</div>
										</div>
										<div class="col-md-8">
											<div class="main-content">
												<h3 class="heading-3 title-heading"><?php echo esc_html($sp_name); ?>
												</h3>
												<div class="sub-title">
													<?php echo wp_kses_post($sp_excerpt); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="button-swiper">
					<div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="courseDetail-4">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/img/left-icon.svg'); ?>" alt="" />
					</div>
					<div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="courseDetail-4">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/img/left-icon.svg'); ?>" alt="" />
					</div>
				</div>
			</div>
			<?php endif; ?>

		</div>
	</div>
</section>