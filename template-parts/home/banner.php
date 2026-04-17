<?php
$banners = get_field('home_banner');
if ($banners):
?>
<section class="section-banner">
    <div class="swiper-dynamic-config" data-id-swiper="swiper-home" data-swiper-options='{"slidesPerView": 1, "loop": true, "autoplay": {"delay": 8000},"effect": "fade", "speed": 1800,"fadeEffect": { "crossFade": true } }'>
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($banners as $banner): 
                    $img = $banner['image'];
                    $heading = $banner['heading'];
                    $sub = $banner['sub_title'];
                    $btn1 = $banner['btn_1'];
                    $btn2 = $banner['btn_2'];
                ?>
                <div class="swiper-slide">
                    <div class="img img-parallax ratio:pt-[800_1920]" data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
                        <?php if($img): ?>
                            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                        <?php endif; ?>
                        <div class="content-banner">
                            <div class="main-content">
                                <div class="content-text">
                                    <?php if($heading): ?>
                                    <h2 class="Heading-banner" data-gsap-options='{"type": "split-chars"}'><?php echo esc_html($heading); ?></h2>
                                    <?php endif; ?>
                                    <?php if($sub): ?>
                                    <div class="sub-title" data-gsap-options='{"type": "fade-up"}'>
                                        <p><?php echo esc_html($sub); ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="content-button" data-gsap-options='{"type": "fade-up", "delay": 0.9, "duration":0.3}'>
                                    <?php if($btn1 && is_array($btn1)): ?>
                                    <a class="btn btn-primary" href="<?php echo esc_url($btn1['url']); ?>" target="<?php echo esc_attr($btn1['target'] ?: '_self'); ?>"><span><?php echo esc_html($btn1['title']); ?></span></a>
                                    <?php endif; ?>
                                    <?php if($btn2 && is_array($btn2)): ?>
                                    <a class="btn btn-white" href="<?php echo esc_url($btn2['url']); ?>" target="<?php echo esc_attr($btn2['target'] ?: '_self'); ?>"><span><?php echo esc_html($btn2['title']); ?></span></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="button-swiper">
                <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="swiper-home"><img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt=""/></div>
                <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="swiper-home"><img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt=""/></div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
