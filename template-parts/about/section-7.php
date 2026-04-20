<?php
$title = get_field('ab7_title');
$subtitle = get_field('ab7_subtitle');
$items = get_field('ab7_items');
?>
<section class="section-about-7">
    <div class="section-xl-py">
        <div class="container">
            <div class="block-content">
                <h2 class="heading-2 text-center title-heading"><?php echo esc_html($title); ?></h2>
                <span class="sub-title body-1"><?php echo esc_html($subtitle); ?></span>
                
                <?php if ($items): ?>
                <div class="box-grid">
                    <?php foreach ($items as $item): ?>
                    <div class="item-grid">
                        <div class="item-grid-icon">
                            <div class="img img-ratio ratio:pt-[1_1]">
                                <?php if ($item['icon']): ?>
                                <img class="lozad" data-src="<?php echo esc_url($item['icon']['url']); ?>" alt="<?php echo esc_attr($item['icon']['alt']); ?>" />
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="item-grid-title">
                            <h3 class="heading-3 uppercase"><?php echo esc_html($item['title']); ?></h3>
                        </div>
                        <div class="item-grid-desc">
                            <div class="item-grid-scroll prose" data-lenis-prevent>
                                <?php echo wp_kses_post($item['desc']); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
