<?php
$faq_banner_img = get_field('faq_banner_img');
?>
<section class="section-banner">
    <div class="warp-banner">
        <div class="img img-parallax ratio:pt-[960_1920]" data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
            <?php if ($faq_banner_img): ?>
                <img src="<?php echo esc_url($faq_banner_img['url']); ?>" alt="<?php echo esc_attr($faq_banner_img['alt']); ?>" />
            <?php else: ?>
                <img src="https://picsum.photos/1920/1080?random=788" alt="" />
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
