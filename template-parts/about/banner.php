<?php
$banner_img = get_field('ab_banner_img');
$banner_title = get_field('ab_banner_title') ?: get_the_title();
?>
<section class="section-bannerNormal">
    <div class="warp-bannerNormal">
        <div class="img img-parallax ratio:pt-[960_1920]" data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
            <?php if ($banner_img): ?>
                <img src="<?php echo esc_url($banner_img['url']); ?>" alt="<?php echo esc_attr($banner_img['alt']); ?>" />
            <?php else: ?>
                <img src="https://picsum.photos/1920/1080?random=976" alt="" />
            <?php endif; ?>
        </div>
        <div class="content-banner">
            <div class="container">
                <h2 class="title-heading"><?php echo esc_html($banner_title); ?></h2>
                <div class="global-breadcrumb">
                    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
