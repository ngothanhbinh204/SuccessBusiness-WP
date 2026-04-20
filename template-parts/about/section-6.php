<?php
$title = get_field('ab6_title');
$subtitle = get_field('ab6_subtitle');
$desc = get_field('ab6_desc');

$items_top = get_field('ab6_items_top');
$items_mid = get_field('ab6_items_middle');
$items_bot = get_field('ab6_items_bottom');
?>
<section class="section-about-6">
    <div class="section-xl-py">
        <div class="container">
            <div class="block-content">
                <h2 class="heading-2 text-center title-heading"><?php echo esc_html($title); ?></h2>
                <span class="sub-title body-1 text-center"><?php echo esc_html($subtitle); ?></span>
                
                <div class="box-flex">
                    <?php if ($items_top): ?>
                    <div class="item-top">
                        <?php foreach ($items_top as $it): ?>
                        <div class="item">
                            <div class="item-logo">
                                <div class="img img-ratio ratio:pt-[53_160]">
                                    <?php if ($it['logo']): ?>
                                    <img class="lozad" data-src="<?php echo esc_url($it['logo']['url']); ?>" alt="<?php echo esc_attr($it['logo']['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                            </div>
                            <span class="item-content"><?php echo esc_html($it['text']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($items_mid): ?>
                    <div class="item-middle">
                        <?php foreach ($items_mid as $it): ?>
                        <div class="main-item">
                            <div class="item">
                                <div class="item-logo">
                                    <div class="img img-ratio ratio:pt-[53_160]">
                                        <?php if ($it['logo']): ?>
                                        <img class="lozad" data-src="<?php echo esc_url($it['logo']['url']); ?>" alt="<?php echo esc_attr($it['logo']['alt']); ?>" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <span class="item-content"><?php echo esc_html($it['text']); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($items_bot): ?>
                    <div class="item-bottom">
                        <?php foreach ($items_bot as $it): ?>
                        <div class="item">
                            <div class="item-logo">
                                <div class="img img-ratio ratio:pt-[53_160]">
                                    <?php if ($it['logo']): ?>
                                    <img class="lozad" data-src="<?php echo esc_url($it['logo']['url']); ?>" alt="<?php echo esc_attr($it['logo']['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                            </div>
                            <span class="item-content"><?php echo esc_html($it['text']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <?php if ($desc): ?>
                <div class="box-desc prose text-center">
                    <?php echo wp_kses_post($desc); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
