<?php
$title = get_field('ab3_title');
$items = get_field('ab3_items');
$img_circle = get_field('ab3_img_circle');
?>
<section class="section-about-3">
    <div class="warp-padding">
        <div class="container">
            <h2 class="title-heading heading-2 mb-base"><?php echo esc_html($title); ?></h2>
            <?php if ($items): ?>
            <ul class="block-grid">
                <?php foreach ($items as $index => $item): 
                    $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                ?>
                <li class="box-item">
                    <div class="title-grid"><strong><?php echo $num; ?></strong><span><?php echo esc_html($item['title']); ?></span></div>
                    <div class="sub-title-grid">
                        <p><?php echo esc_html($item['subtitle']); ?></p>
                    </div>
                    <div class="scroll-grid" data-lenis-prevent>
                        <ul>
                            <?php if ($item['list']): foreach ($item['list'] as $li): ?>
                            <li>
                                <p><?php echo esc_html($li['text']); ?></p>
                            </li>
                            <?php endforeach; endif; ?>
                        </ul>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if ($img_circle): ?>
    <div class="section-xl-pb">
        <div class="content-circle">
            <div class="block-img">
                <div class="img img-ratio ratio:pt-[1_1]">
                    <img class="lozad" data-src="<?php echo esc_url($img_circle['url']); ?>" alt="<?php echo esc_attr($img_circle['alt']); ?>" />
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
