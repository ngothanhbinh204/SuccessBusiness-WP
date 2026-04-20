<?php
$items = get_field('ab2_items');
$image = get_field('ab2_image');
?>
<section class="section-about-2">
    <div class="wrap-about-2" data-stick-layout>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 block-left">
                    <?php if ($items): 
                        foreach ($items as $index => $item):
                            $class = ($index === 0) ? 'item-top' : 'item-bottom';
                    ?>
                    <div class="box-item <?php echo $class; ?>">
                        <div class="main-content">
                            <div class="item-icon">
                                <div class="icon-img">
                                    <div class="img img-ratio ratio:pt-[1_1] zoom-img">
                                        <?php if ($item['icon']): ?>
                                        <img class="lozad" data-src="<?php echo esc_url($item['icon']['url']); ?>" alt="<?php echo esc_attr($item['icon']['alt']); ?>" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="item-content">
                                <h2 class="heading-title heading-2"><?php echo esc_html($item['title']); ?></h2>
                                <div class="sub-title">
                                    <?php echo wp_kses_post($item['content']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
                <div class="col-lg-6 block-right">
                    <div class="img img-parallax overflow-hidden ratio:pt-[1_2] lg:ratio:pt-[1_1]" data-stick-options='{"positionAbove": "right", "stickAbove": 1024}' data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
                        <?php if ($image): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
