<?php
// Section 6: Các khóa học liên quan (cùng taxonomy loai_khoa_hoc)
// Lấy 4 khóa học mới nhất cùng loại, loại bỏ bài viết hiện tại
$current_id = get_the_ID();
$terms = get_the_terms($current_id, 'loai_khoa_hoc');
$related_query_args = array(
    'post_type'      => 'khoa_hoc',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'post__not_in'   => array($current_id),
    'orderby'        => 'date',
    'order'          => 'DESC',
);

// Ưu tiên lọc theo cùng taxonomy nếu có
if ($terms && !is_wp_error($terms)) {
    $term_ids = wp_list_pluck($terms, 'term_id');
    $related_query_args['tax_query'] = array(
        array(
            'taxonomy' => 'loai_khoa_hoc',
            'field'    => 'term_id',
            'terms'    => $term_ids,
        ),
    );
}

$related_query = new WP_Query($related_query_args);

if (!$related_query->have_posts()) {
    wp_reset_postdata();
    return;
}
?>
<section class="section-courseDetail-6">
    <div class="section-xl-py">
        <div class="container">
            <div class="main-content mb-base">
                <h2 class="heading-2">Chương trình đào tạo</h2>
                <div class="button-swiper flex-y-center gap-4">
                    <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="courseDetail-5">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/left-icon.svg'); ?>" alt="" />
                    </div>
                    <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="courseDetail-5">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/left-icon.svg'); ?>" alt="" />
                    </div>
                </div>
            </div>

            <div class="swiper-column-auto auto-3-column" data-id-swiper="courseDetail-5">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php while ($related_query->have_posts()): $related_query->the_post();
                            $rel_id        = get_the_ID();
                            $rel_thumb     = get_the_post_thumbnail_url($rel_id, 'large');
                            $rel_title     = get_the_title();
                            $rel_excerpt   = get_the_excerpt();
                            $rel_permalink = get_permalink();
                            $rel_date      = get_field('start_date', $rel_id);
                        ?>
                        <div class="swiper-slide">
                            <a class="group card-course" href="<?php echo esc_url($rel_permalink); ?>">
                                <div class="card-img">
                                    <div class="img img-ratio ratio:pt-[296_455] zoom-img">
                                        <?php if ($rel_thumb): ?>
                                            <img class="lozad" data-src="<?php echo esc_url($rel_thumb); ?>" alt="<?php echo esc_attr($rel_title); ?>" />
                                        <?php else: ?>
                                            <img class="lozad" data-src="https://picsum.photos/455/296?random=<?php echo $rel_id; ?>" alt="<?php echo esc_attr($rel_title); ?>" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-info">
                                    <?php if ($rel_date): ?>
                                        <div class="info-date"><span><?php echo esc_html($rel_date); ?></span></div>
                                    <?php endif; ?>
                                    <h3 class="info-title"><?php echo esc_html($rel_title); ?></h3>
                                    <?php if ($rel_excerpt): ?>
                                        <div class="info-content">
                                            <div><?php echo wp_kses_post($rel_excerpt); ?></div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
