<?php
$events = get_field('home_4_events');
if ($events):
?>
<section class="section-home-4">
    <div class="section-py">
        <div class="container">
            <div class="block-swiper relative">
                <div class="swiper-column-auto auto-1-column" data-id-swiper="home-4" data-swiper-options='{"effect": "fade", "speed": 1200,"fadeEffect": { "crossFade": true } }'>
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($events as $ev): 
                                $left_title = $ev['left_title'];
                                $left_sub = $ev['left_subtitle'];
                                $btn = $ev['btn'];
                                $img = $ev['image'];
                                $right_title = $ev['right_title'];
                                $right_sub = $ev['right_subtitle'];
                                $time = $ev['time'];
                            ?>
                            <div class="swiper-slide">
                                <div class="box-grid">
                                    <div class="item-left item-padding">
                                        <div class="item-left-icon"><i class="fa-solid fa-calendar-star"></i></div>
                                        <h2 class="item-left-title"><?php echo esc_html($left_title); ?></h2>
                                        <div class="item-left-sub-title">
                                            <p><?php echo esc_html($left_sub); ?></p>
                                        </div>
                                        <?php if ($btn && is_array($btn)): ?>
                                        <a class="btn btn-white" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target'] ?: '_self'); ?>"><span><?php echo esc_html($btn['title']); ?></span></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="item-center">
                                        <div class="img img-parallax ratio:pt-[450_700] h-full" data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
                                            <?php if($img): ?>
                                            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="item-right item-padding">
                                        <div class="main-content">
                                            <span class="item-right-title"><?php echo esc_html($right_title); ?></span>
                                            <div class="item-right-sub-title"><strong><?php echo esc_html($right_sub); ?></strong></div>
                                        </div>
                                        <div class="item-time-event"><span>Thời gian diễn ra:</span><strong><?php echo esc_html($time); ?></strong></div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="button-swiper">
                    <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="home-4"><img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt=""/></div>
                    <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="home-4"><img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt=""/></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
