<?php

$current_post_id = get_the_ID();

$categories = get_the_category($current_post_id);

if (empty($categories)) {
    return;
}

$category_id = $categories[0]->term_id;

$posts_related_query = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'cat'            => $category_id,
    'post__not_in'   => array($current_post_id),
    'orderby'        => 'date',
    'order'          => 'DESC',
));

if (!$posts_related_query->have_posts()) {
    return;
}
?>
<div class="block-swiper mt-base">
	<div class="container">
		<div class="main-content mb-base">
			<h2 class="heading-2">
				<?php esc_html_e('Tin tức liên quan', 'canhcamtheme'); ?>
			</h2>
		</div>
		<div class="swiper-column-auto auto-3-column relative" data-id-swiper="newsDetail">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php while ($posts_related_query->have_posts()): $posts_related_query->the_post();
                        $post_id       = get_the_ID();
                        $thumb_url     = get_the_post_thumbnail_url($post_id, 'large');
                        $post_date     = get_the_date('d/m/Y', $post_id);
                        $post_cats     = get_the_category($post_id);
                        $cat_name      = !empty($post_cats) ? $post_cats[0]->name : '';
                        $title         = get_the_title();
                        $permalink     = get_permalink();
                    ?>
					<div class="swiper-slide">
						<a class="group card-new" href="<?php echo esc_url($permalink); ?>">
							<div class="card-img">
								<div class="img img-ratio ratio:pt-[296_455] zoom-img">
									<?php if ($thumb_url): ?>
									<img class="lozad" data-src="<?php echo esc_url($thumb_url); ?>"
										alt="<?php echo esc_attr($title); ?>" />
									<?php else: ?>
									<img class="lozad"
										data-src="https://picsum.photos/1920/1080?random=<?php echo $post_id; ?>"
										alt="<?php echo esc_attr($title); ?>" />
									<?php endif; ?>
								</div>
							</div>
							<div class="card-info">
								<div class="info-date">
									<?php if ($post_date): ?>
									<span><?php echo esc_html($post_date); ?></span>
									<?php endif; ?>
									<?php if ($cat_name): ?>
									<strong><?php echo esc_html($cat_name); ?></strong>
									<?php endif; ?>
								</div>
								<h3 class="info-title"><?php echo esc_html($title); ?></h3>
							</div>
						</a>
					</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<div class="button-swiper">
				<div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="newsDetail">
					<img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt="Previous" />
				</div>
				<div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="newsDetail">
					<img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt="Next" />
				</div>
			</div>
		</div>
	</div>
</div>