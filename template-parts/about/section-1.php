<?php
$title = get_field('ab1_title');
$content = get_field('ab1_content');
$gallery = get_field('ab1_gallery');
?>
<section class="section-about-1">
    <div class="wrap-padding">
        <div class="container">
            <div class="block-flex">
                <div class="box-left">
                    <h1 class="heading-2 title-heading"><?php echo esc_html($title); ?></h1>
                </div>
                <div class="box-right">
                    <div class="prose">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php if ($gallery): ?>
    <div class="warp-embla">
        <div class="block-embla">
            <div class="embla" data-embla-options='{"align":"start","loop":true,"duration":1,"speed":5,"autoScroll":true,"stopOnHover":true}'>
                <div class="embla__viewport">
                    <div class="embla__container">
                        <?php foreach ($gallery as $img): ?>
                        <div class="embla__slide">
                            <div class="item-img">
                                <div class="img img-ratio ratio:pt-[400_600] zoom-img">
                                    <img class="lozad" data-src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
