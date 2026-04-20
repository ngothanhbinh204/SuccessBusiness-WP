<?php
// Banner parallax + breadcrumb – dùng ảnh nền từ ACF hoặc fallback thumbnail bài viết
$banner_img = get_field('kh_banner_img');
if (!$banner_img) {
    // Fallback: dùng featured image của post
    $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
}
?>
<section class="section-banner">
    <div class="warp-banner">
        <div class="img img-parallax ratio:pt-[960_1920]" data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
            <?php if ($banner_img): ?>
                <img src="<?php echo esc_url($banner_img['url']); ?>" alt="<?php echo esc_attr($banner_img['alt']); ?>" />
            <?php elseif (!empty($thumb_url)): ?>
                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
            <?php else: ?>
                <img src="https://picsum.photos/1920/1080?random=80" alt="" />
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="global-breadcrumb">
    <div class="container">
        <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        </nav>
    </div>
</section>
