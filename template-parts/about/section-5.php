<?php
$title = get_field('ab5_title');
$bg = get_field('ab5_bg');
$items = get_field('ab5_items');
$bg_url = $bg ? $bg['url'] : get_template_directory_uri() . '/img/banner.jpg';
?>
<section class="section-about-5" data-bg-options='{"src":"<?php echo esc_url($bg_url); ?>"}'>
    <div class="wrap-padding">
        <div class="container">
            <h2 class="heading-2 mb-base"><?php echo esc_html($title); ?></h2>
            <?php if ($items): ?>
            <div class="block-grid">
                <?php foreach ($items as $index => $item): 
                    $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                ?>
                <div class="item-grid" data-height-options='{"source": "child", "var": "--height-desc"}'>
                    <div class="child">
                        <div class="item-grid-number"><strong><?php echo $num; ?></strong></div>
                        <div class="item-grid-main">
                            <div class="item-grid-desc" data-height-child>
                                <div class="item-grid-title"><span><?php echo esc_html($item['title']); ?></span></div>
                                <div class="item-grid-desc-inner">
                                    <?php echo wp_kses_post($item['desc']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
