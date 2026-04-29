<?php
/**
 * Section 6: Bài viết theo Danh mục (tabs theo category WordPress)
 * ACF field: home_6_categories (taxonomy: category, multi_select, return: object)
 */
$title = get_field('home_6_title') ?: __('Tin tức & Kiến thức', 'canhcamtheme');
$cats  = get_field('home_6_categories'); // array of WP_Term objects

// Fallback: lấy tất cả category nếu không có chọn
if (!$cats) {
    $cats = get_terms([ 'taxonomy' => 'category', 'hide_empty' => true ]);
}

if ($cats && !is_wp_error($cats)):
    $cats = array_values($cats); // reset index
?>
<section class="section-home-6">
	<div class="section-xl-py">
		<div class="container">
			<div class="gsap-tabs-wrapper"
				data-gsap-tabs-options="{'effect': 'fade-up', 'event': 'click', 'triggerScale': 1,'duration': 0.8}">
				<div class="block-top">
					<div class="box-left">
						<h2 class="heading-2 mb-4"><?php echo esc_html($title); ?></h2>
						<div class="filter-dropdown">
							<div class="filter-toggle"><span class="selected-text">
									<?php _e('Tất cả', 'canhcamtheme'); ?>
								</span><i class="fa-regular fa-chevron-down"></i></div>
							<ul class="tab-triggers filter-menu">
								<li data-tab-trigger="0"><a class="nav-link" href="javascript:void(0)"><span>
											<?php _e('Tất cả', 'canhcamtheme'); ?>
										</span></a>
								</li>
								<?php foreach ($cats as $index => $cat): ?>
								<li data-tab-trigger="<?php echo $index + 1; ?>"><a class="nav-link"
										href="javascript:void(0)"><span><?php echo esc_html($cat->name); ?></span></a>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="box-right">
						<div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="home-6"><img
								src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt="" /></div>
						<div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="home-6"><img
								src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt="" /></div>
					</div>
				</div>

				<div class="block-bottom">
					<div class="tab-contents relative">
						<?php
						// Tab 0 – Tất cả bài viết
						$all_posts_query = new WP_Query([
							'post_type'      => 'post',
							'posts_per_page' => 9,
							'post_status'    => 'publish',
						]);
						?>
						<div class="tab-pane w-full" data-tab-content="0">
							<div class="swiper-dynamic-config" data-id-swiper="home-6"
								data-swiper-options='{"slidesPerView": 1, "spaceBetween":"getVw(15, 32)", "res": {"md": 2 , "lg": 3}}'>
								<div class="swiper">
									<div class="swiper-wrapper">
										<?php while ($all_posts_query->have_posts()): $all_posts_query->the_post();
											$post_id = get_the_ID();
											$date    = get_the_date('d/m/Y');
										?>
										<div class="swiper-slide">
											<a class="group card-new" href="<?php the_permalink(); ?>">
												<div class="card-img">
													<div class="img img-ratio ratio:pt-[296_455] zoom-img">
														<?php echo get_image_post($post_id, 'image'); ?>
													</div>
												</div>
												<div class="card-info">
													<div class="info-date">
														<span><?php echo esc_html($date); ?></span>
													</div>
													<h3 class="info-title"><?php the_title(); ?></h3>
												</div>
											</a>
										</div>
										<?php endwhile; wp_reset_postdata(); ?>
									</div>
								</div>
							</div>
						</div>
						<?php foreach ($cats as $index => $cat):
                            $posts_query = new WP_Query([
                                'post_type'      => 'post',
                                'posts_per_page' => 9,
                                'post_status'    => 'publish',
                                'cat'            => $cat->term_id,
                            ]);
                        ?>
						<div class="tab-pane w-full" data-tab-content="<?php echo $index + 1; ?>">
							<div class="swiper-dynamic-config" data-id-swiper="home-6"
								data-swiper-options='{"slidesPerView": 1, "spaceBetween":"getVw(15, 32)", "res": {"md": 2 , "lg": 3}}'>
								<div class="swiper">
									<div class="swiper-wrapper">
										<?php while ($posts_query->have_posts()): $posts_query->the_post();
                                            $post_id = get_the_ID();
                                            $thumb   = get_the_post_thumbnail_url($post_id, 'large') ?: 'https://picsum.photos/600/400';
                                            $date    = get_the_date('d/m/Y');
                                        ?>
										<div class="swiper-slide">
											<a class="group card-new" href="<?php the_permalink(); ?>">
												<div class="card-img">
													<div class="img img-ratio ratio:pt-[296_455] zoom-img">

														<?php echo get_image_post($post_id, 'image'); ?>
													</div>
												</div>
												<div class="card-info">
													<div class="info-date">
														<span><?php echo esc_html($date); ?></span><strong><?php echo esc_html($cat->name); ?></strong>
													</div>
													<h3 class="info-title"><?php the_title(); ?></h3>
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