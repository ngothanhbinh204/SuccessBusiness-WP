<?php

$paged           = max(1, get_query_var('paged'));
$current_cat     = '';
$page_title      = 'Hỗ trợ khách hàng';
$posts_page_url  = get_permalink(get_option('page_for_posts'));

if (is_home() && !is_front_page()) {
    $posts_page_id = get_option('page_for_posts');
    if ($posts_page_id) {
        $page_title = get_the_title($posts_page_id);
    }
}

if (is_category()) {
    $current_term = get_queried_object();
    if ($current_term) {
        $current_cat  = $current_term->slug;
        $page_title   = $current_term->name;
    }
}

$all_categories = get_categories(array(
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
));

$query_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'post_status'    => 'publish',
);

if ($current_cat) {
    $query_args['category_name'] = $current_cat;
}

$the_query = new WP_Query($query_args);
?>
<section class="global-breadcrumb">
	<div class="container">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
</section>

<section class="section-section-newsList">
	<div class="section-xl-py">
		<div class="container">
			<div class="block-btn">
				<h1 class="heading-2"><?php echo esc_html($page_title); ?></h1>

				<?php if (!empty($all_categories) && !is_wp_error($all_categories)): ?>
				<div class="filter-dropdown">
					<div class="filter-toggle">
						<?php
                        $selected_label = 'Tất cả';
                        if ($current_cat) {
                            foreach ($all_categories as $cat) {
                                if ($cat->slug === $current_cat) {
                                    $selected_label = $cat->name;
                                    break;
                                }
                            }
                        }
                        ?>
						<span class="selected-text"><?php echo esc_html($selected_label); ?></span>
						<i class="fa-regular fa-chevron-down"></i>
					</div>
					<ul class="tabslet-tab filter-menu">
						<li class="<?php echo !$current_cat ? 'active' : ''; ?>">
							<a href="<?php echo esc_url($posts_page_url ? $posts_page_url : home_url('/')); ?>">
								<span>Tất cả</span>
							</a>
						</li>
						<?php foreach ($all_categories as $cat): ?>
						<li class="<?php echo ($current_cat === $cat->slug) ? 'active' : ''; ?>">
							<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
								<span><?php echo esc_html($cat->name); ?></span>
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>

			<?php if ($the_query->have_posts()): ?>
			<div class="block-grid">
				<?php while ($the_query->have_posts()): $the_query->the_post();
                    $post_id    = get_the_ID();
                    $thumb_url  = get_the_post_thumbnail_url($post_id, 'large');
                    $post_date  = get_the_date('d/m/Y', $post_id);
                    $categories = get_the_category($post_id);
                    $cat_name   = !empty($categories) ? $categories[0]->name : '';
                    $title      = get_the_title();
                    $permalink  = get_permalink();
                ?>
				<a class="group card-new" href="<?php echo esc_url($permalink); ?>">
					<div class="card-img">
						<div class="img img-ratio ratio:pt-[296_455] zoom-img">
							<?php if ($thumb_url): ?>
							<img class="lozad" data-src="<?php echo esc_url($thumb_url); ?>"
								alt="<?php echo esc_attr($title); ?>" />
							<?php else: ?>
							<img class="lozad" data-src="https://picsum.photos/1920/1080?random=<?php echo $post_id; ?>"
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
				<?php _e('Chưa có bài viết nào.', 'canhcamtheme'); ?>
			</p>
			<?php endif; ?>

		</div>
	</div>
</section>