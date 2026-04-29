<?php
/**
 * Section 1: Chương trình đào tạo (tabs theo Loại khóa học)
 * ACF field: home_1_loai_kh (taxonomy: loai_khoa_hoc, multi_select, return: object)
 */
$title = get_field('home_1_title') ?: __('Chương trình đào tạo', 'canhcamtheme');
$terms = get_field('home_1_loai_kh'); // array of WP_Term objects

// Fallback: lấy tất cả loại khóa học nếu không có chọn
if (!$terms) {
    $terms = get_terms([ 'taxonomy' => 'loai_khoa_hoc', 'hide_empty' => true ]);
}

if ($terms && !is_wp_error($terms)):
    $terms = array_values($terms); // reset index
?>
<section class="section-home-1" data-gsap-layout>
	<div class="wrap-bg-home">
		<div class="container">
			<div class="gsap-tabs-wrapper"
				data-gsap-tabs-options="{'effect': 'fade-up', 'event': 'click', 'triggerScale': 1,'duration': 0.8}">
				<div class="block-top">
					<div class="box-left">
						<h2 class="heading-2 mb-4" data-gsap-options='{"type": "split-chars"}'>
							<?php echo esc_html($title); ?></h2>
						<div class="filter-dropdown" data-gsap-options='{"type": "fade-up"}'>
							<div class="filter-toggle"><span class="selected-text">
									<?php _e('Tất cả', 'canhcamtheme'); ?></span><i
									class="fa-regular fa-chevron-down"></i></div>
							<ul class="tab-triggers filter-menu">
								<li data-tab-trigger="0"><a class="nav-link" href="javascript:void(0)"><span>
											<?php _e('Tất cả', 'canhcamtheme'); ?>
										</span></a>
								</li>
								<?php foreach ($terms as $index => $term): ?>
								<li data-tab-trigger="<?php echo $index + 1; ?>"><a class="nav-link"
										href="javascript:void(0)"><span><?php echo esc_html($term->name); ?></span></a>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="box-right">
						<div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="home-1"><img
								src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt="" /></div>
						<div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="home-1"><img
								src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt="" /></div>
					</div>
				</div>

				<div class="block-bottom" data-gsap-options='{"type": "fade-up", "delay": 0.3, "duration": 0.8}'>
					<div class="tab-contents relative">
						<?php
						// Tab 0 – Tất cả khóa học
						$all_courses_query = new WP_Query([
							'post_type'      => 'khoa_hoc',
							'posts_per_page' => 9,
							'post_status'    => 'publish',
						]);
						?>
						<div class="tab-pane w-full" data-tab-content="0">
							<div class="swiper-dynamic-config" data-id-swiper="home-1"
								data-swiper-options='{"slidesPerView": 1, "spaceBetween":"getVw(15, 32)", "res": {"md": 2 , "lg": 3}}'>
								<div class="swiper">
									<div class="swiper-wrapper h-auto">
										<?php while ($all_courses_query->have_posts()): $all_courses_query->the_post();
											$course_id  = get_the_ID();
											$start_date = get_field('start_date', $course_id) ?: __('Sắp khai giảng', 'canhcamtheme');
										?>
										<div class="swiper-slide">
											<a class="group card-course" href="<?php the_permalink(); ?>">
												<div class="card-img">
													<div class="img img-ratio ratio:pt-[296_455] zoom-img">
														<?php echo get_image_post($course_id, 'image'); ?>
													</div>
												</div>
												<div class="card-info">
													<div class="info-date">
														<span><?php echo esc_html($start_date); ?></span>
													</div>
													<h3 class="info-title"><?php the_title(); ?></h3>
													<div class="info-content">
														<p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
													</div>
												</div>
											</a>
										</div>
										<?php endwhile; wp_reset_postdata(); ?>
									</div>
								</div>
							</div>
						</div>
						<?php foreach ($terms as $index => $term):
                            $courses_query = new WP_Query([
                                'post_type'      => 'khoa_hoc',
                                'posts_per_page' => 9,
                                'post_status'    => 'publish',
                                'tax_query'      => [[
                                    'taxonomy' => 'loai_khoa_hoc',
                                    'field'    => 'term_id',
                                    'terms'    => $term->term_id,
                                ]],
                            ]);
                        ?>
						<div class="tab-pane w-full" data-tab-content="<?php echo $index + 1; ?>">
							<div class="swiper-dynamic-config" data-id-swiper="home-1"
								data-swiper-options='{"slidesPerView": 1, "spaceBetween":"getVw(15, 32)", "res": {"md": 2 , "lg": 3}}'>
								<div class="swiper">
									<div class="swiper-wrapper h-auto">
										<?php while ($courses_query->have_posts()): $courses_query->the_post();
                                            $course_id  = get_the_ID();
                                            $thumb      = get_the_post_thumbnail_url($course_id, 'large') ?: 'https://picsum.photos/600/400';
                                            $start_date = get_field('start_date', $course_id) ?: __('Sắp khai giảng', 'canhcamtheme');
                                        ?>
										<div class="swiper-slide">
											<a class="group card-course" href="<?php the_permalink(); ?>">
												<div class="card-img">
													<div class="img img-ratio ratio:pt-[296_455] zoom-img">
														<?php echo get_image_post($course_id, 'image'); ?>
													</div>
												</div>
												<div class="card-info">
													<div class="info-date">
														<span><?php echo esc_html($start_date); ?></span>
													</div>
													<h3 class="info-title"><?php the_title(); ?></h3>
													<div class="info-content">
														<p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
													</div>
												</div>
											</a>
										</div>
										<?php endwhile; wp_reset_postdata(); ?>
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
</section>
<?php endif; ?>