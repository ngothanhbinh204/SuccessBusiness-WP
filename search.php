<?php
/**
 * Search Results Template
 * Tìm kiếm trong post (bài viết) và khoa_hoc (khóa học)
 */
get_header();

$search_query = get_search_query();
$paged        = max(1, get_query_var('paged'));

// Query tìm kiếm trong cả post và khoa_hoc
$search_args = array(
    'post_type'      => array('post', 'khoa_hoc'),
    's'              => $search_query,
    'posts_per_page' => -1,
    'paged'          => $paged,
    'post_status'    => 'publish',
);

$search_results = new WP_Query($search_args);
$total_results  = $search_results->found_posts;
?>

<main>
	<section class="global-breadcrumb">
		<div class="container">
			<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
		</div>
	</section>

	<section class="section-search-results section-courseList ">
		<div class="section-xl-py wrap-padding">
			<div class="container">
				<div class="block-top mb-8">
					<h1 class="heading-2 mb-4">
						<?php _e('Kết quả tìm kiếm', 'canhcamtheme'); ?>
					</h1>
					<div class="search-query text-lg">
						<?php _e('Tìm kiếm cho từ khóa', 'canhcamtheme'); ?>:
						"<strong><?php echo esc_html($search_query); ?></strong>"
						<span class="text-gray-600">(<?php echo $total_results; ?>
							<?php _e('kết quả', 'canhcamtheme'); ?>)</span>
					</div>
				</div>

				<div class="block-bottom">
					<?php if ($search_results->have_posts()): ?>
					<div class="block-grid">
						<?php while ($search_results->have_posts()): $search_results->the_post();
                        $post_id   = get_the_ID();
                        $post_type = get_post_type();
                        $thumb_url = get_the_post_thumbnail_url($post_id, 'large');
                        $title     = get_the_title();
                        $permalink = get_permalink();

                        // Hiển thị card theo post type
                        if ($post_type === 'khoa_hoc'):
                            // Card khóa học
                            $start_date = get_field('start_date', $post_id);
                            $excerpt    = get_the_excerpt();
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
						<?php
                        else:
                            // Card bài viết
                            $post_date  = get_the_date('d/m/Y', $post_id);
                            $categories = get_the_category($post_id);
                            $cat_name   = !empty($categories) ? $categories[0]->name : '';
                    ?>
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
									<span><?php echo esc_html($post_date); ?></span>
									<?php if ($cat_name): ?>
									<strong><?php echo esc_html($cat_name); ?></strong>
									<?php endif; ?>
								</div>
								<h3 class="info-title"><?php echo esc_html($title); ?></h3>
							</div>
						</a>
						<?php
                        endif;
                    endwhile;
                    wp_reset_postdata();
                    ?>
					</div>
				</div>

				<?php else: ?>
				<div class="no-results text-center py-12">
					<p class="text-xl mb-4"><?php _e('Không tìm thấy kết quả nào cho từ khóa', 'canhcamtheme'); ?>
						"<strong><?php echo esc_html($search_query); ?></strong>"</p>
					<p class="text-gray-600"><?php _e('Vui lòng thử lại với từ khóa khác.', 'canhcamtheme'); ?></p>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
?>