<?php

$paged        = max(1, get_query_var('paged'));
$current_loai = '';

if (is_tax('loai_khoa_hoc')) {
    $current_term = get_queried_object();
    if ($current_term) {
        $current_loai = $current_term->slug;
    }
}

$all_terms = get_terms(array(
    'taxonomy'   => 'loai_khoa_hoc',
    'hide_empty' => false,
));

$query_args = array(
    'post_type'      => 'khoa_hoc',
    // 'posts_per_page' => 1,
    'paged'          => $paged,
    'post_status'    => 'publish',
);

if ($current_loai) {
    $query_args['tax_query'] = array(
        array(
            'taxonomy' => 'loai_khoa_hoc',
            'field'    => 'slug',
            'terms'    => $current_loai,
        ),
    );
}

$the_query = new WP_Query($query_args);
?>
<section class="section-courseList">
	<div class="wrap-padding">
		<div class="container">
			<div class="block-top">
				<div class="box-left">
					<h2 class="heading-2 mb-4">Chương trình đào tạo</h2>

					<?php if (!empty($all_terms) && !is_wp_error($all_terms)): ?>
					<div class="filter-dropdown">
						<div class="filter-toggle">
							<?php
                            $selected_label = 'Tất cả';
                            if ($current_loai) {
                                foreach ($all_terms as $term) {
                                    if ($term->slug === $current_loai) {
                                        $selected_label = $term->name;
                                        break;
                                    }
                                }
                            }
                            ?>
							<span class="selected-text"><?php echo esc_html($selected_label); ?></span>
							<i class="fa-regular fa-chevron-down"></i>
						</div>
						<ul class="tab-triggers filter-menu">
							<li class="<?php echo !$current_loai ? 'active' : ''; ?>">
								<a class="nav-link"
									href="<?php echo esc_url(get_post_type_archive_link('khoa_hoc')); ?>">
									<span>Tất cả</span>
								</a>
							</li>
							<?php foreach ($all_terms as $term): ?>
							<li class="<?php echo ($current_loai === $term->slug) ? 'active' : ''; ?>">
								<a class="nav-link" href="<?php echo esc_url(get_term_link($term)); ?>">
									<span><?php echo esc_html($term->name); ?></span>
								</a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="block-bottom">
				<?php if ($the_query->have_posts()): ?>
				<div class="box-grid">
					<?php while ($the_query->have_posts()): $the_query->the_post();
                        $post_id    = get_the_ID();
                        $thumb_url  = get_the_post_thumbnail_url($post_id, 'large');
                        $start_date = get_field('start_date', $post_id);
                        $title      = get_the_title();
                        $excerpt    = get_the_excerpt();
                        $permalink  = get_permalink();
                    ?>
					<a class="group card-course" href="<?php echo esc_url($permalink); ?>">
						<div class="card-img">
							<div class="img img-ratio ratio:pt-[296_455] zoom-img">
								<?php if ($thumb_url): ?>
								<img class="lozad" data-src="<?php echo esc_url($thumb_url); ?>"
									alt="<?php echo esc_attr($title); ?>" />
								<?php else: ?>
								<img class="lozad"
									data-src="https://picsum.photos/455/296?random=<?php echo $post_id; ?>"
									alt="<?php echo esc_attr($title); ?>" />
								<?php endif; ?>
							</div>
						</div>
						<div class="card-info">
							<?php if ($start_date): ?>
							<div class="info-date"><span><?php echo esc_html($start_date); ?></span></div>
							<?php endif; ?>
							<h3 class="info-title"><?php echo esc_html($title); ?></h3>
							<?php if ($excerpt): ?>
							<div class="info-content">
								<div><?php echo wp_kses_post($excerpt); ?></div>
							</div>
							<?php endif; ?>
						</div>
					</a>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>

				<?php
                if ($the_query->max_num_pages > 1):
                    $pages = paginate_links(array(
                        'base'      => esc_url_raw(str_replace(999999999, '%#%', get_pagenum_link(999999999, false))),
                        'format'    => '',
                        'current'   => $paged,
                        'total'     => $the_query->max_num_pages,
                        'prev_next' => false,
                        'type'      => 'array',
                        'before_page_number' => '<span>',
                        'after_page_number'  => '</span>',
                    ));
                ?>
				<div class="block-pagination">
					<div class="navigation flex gap-3 body-3">
						<?php foreach ($pages as $page_link):
                            if (strpos($page_link, 'current') !== false) {
                                echo '<span class="btn btn-pagination active">' . wp_kses_post($page_link) . '</span>';
                            } else {
                                echo str_replace('<a ', '<a class="btn btn-pagination" ', $page_link);
                            }
                        endforeach; ?>
					</div>
				</div>
				<?php endif; ?>

				<?php else: ?>
				<p class="text-center">
					<?php _e('Không tìm thấy khóa học nào.', 'canhcamtheme'); ?>
				</p>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>