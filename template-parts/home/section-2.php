<?php
$title = get_field('home_2_title') ?: __('Chương trình đào tạo', 'canhcamtheme');
$banner = get_field('home_2_banner');
$content = get_field('home_2_content');
$counters = get_field('home_2_counters');
$btn = get_field('home_2_btn');
$image = get_field('home_2_image');
?>
<section class="section-home-2" data-bg-options='{"src": "<?php echo get_image_attrachment($banner, 'url') ?>"}'>
    <div class="container">
        <div class="warp-home-2" data-stick-layout>
            <div class="block-left" data-gsap-options='{"type": "fade-right", "delay": 0.3, "duration": 0.8}'>
                <div class="box-content">
                    <div class="item-top">
                        <h2 class="title-heading heading-2 mb-6" data-gsap-options='{"type": "split-chars", "stagger": 0.1, "duration": 0.5, "ease": "back.out(1.7)"}'>
                            <?php echo esc_html($title); ?>
                        </h2>
                        <div class="item-top-content" data-lenis-prevent>
                            <div class="scroll-item prose">
                                <?php echo wp_kses_post($content); ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($counters): ?>
                    <div class="item-center">
                        <ul>
                            <?php foreach ($counters as $c): ?>
                            <li>
                                <div class="sub-item-top">
                                    <div class="number" data-countup-options='{"number": <?php echo intval($c['number']); ?>, "duration": 3 ,"groupSize": 3 ,"padZero": true}'></div><span>+</span>
                                </div>
                                <div class="sub-item-bottom">
                                    <p><?php echo esc_html($c['label']); ?></p>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($btn && is_array($btn)): ?>
                    <div class="item-bottom" data-gsap-options='{"type": "fade-up", "delay": 0.1, "duration": 0.8}'>
                        <a class="btn btn-white" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target'] ?: '_self'); ?>"><span><?php echo esc_html($btn['title']); ?></span></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if ($image): ?>
            <div class="block-right" data-stick-options='{"stickAbove": 1100, "position": "bottom"}' data-gsap-options='{"type": "fade-left"}'>
                <div class="img img-parallax ratio:pt-[736_681]" data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
