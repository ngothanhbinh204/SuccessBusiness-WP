<?php
$title = get_field('home_5_title') ?: __('Câu chuyện thành công', 'canhcamtheme');
$testimonials = get_field('home_5_testimonials');
$partners = get_field('home_5_partners');
?>
<section class="section-home-5">
    <div class="section-lg-py">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="main-content-left">
                        <h2 class="heading-2"><?php echo esc_html($title); ?></h2>
                        <div class="button-swiper">
                            <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="home-5"><img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt=""/></div>
                            <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="home-5"><img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt=""/></div>
                        </div>
                    </div>
                </div>
                <?php if ($testimonials): ?>
                <div class="col-lg-9">
                    <div class="swiper-column-auto auto-1-column" data-id-swiper="home-5" data-swiper-options='{"effect": "fade", "speed": 1200,"fadeEffect": { "crossFade": true } }'>
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($testimonials as $ts): ?>
                                <div class="swiper-slide">
                                    <div class="box-content">
                                        <div class="item-icon"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-home.png" alt=""/></div>
                                        <div class="item-content">
                                            <div class="main-content">
                                                <h3 class="title-heading heading-3 mb-5"><?php echo esc_html($ts['course_name']); ?></h3>
                                                <div class="sub-title">
                                                    <?php echo wp_kses_post($ts['content']); ?>
                                                </div>
                                            </div>
                                            <div class="main-info">
                                                <div class="info-avatar">
                                                    <div class="img img-ratio ratio:pt-[1_1]">
                                                        <?php if ($ts['avatar']): ?>
                                                        <img class="lozad" data-src="<?php echo esc_url($ts['avatar']['url']); ?>" alt="<?php echo esc_attr($ts['author_name']); ?>"/>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="info-name">
                                                    <strong><?php echo esc_html($ts['author_name']); ?></strong>
                                                    <span><?php echo esc_html($ts['author_pos']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <?php if ($partners): ?>
    <div class="wrap-padding">
        <div class="embla" data-id-embla="" data-embla-options='{"align": "start", "loop": true, "duration": 400, "autoScroll": true, "speed": 1.5,"stopOnHover": false}'>
            <div class="embla__viewport">
                <div class="embla__container">
                    <?php foreach ($partners as $p): ?>
                    <div class="embla__slide">
                        <div class="img img-parallax ratio:pt-[86_178]">
                            <img src="<?php echo esc_url($p['logo']['url']); ?>" alt="<?php echo esc_attr($p['logo']['alt']); ?>"/>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
