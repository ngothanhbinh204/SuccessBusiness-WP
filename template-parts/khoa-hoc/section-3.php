<?php
$heading            = get_field('kh3_heading');
$outcomes           = get_field('course_outcomes');
$image              = get_field('kh3_image');
extract( canhcam_get_course_cta() );

if (!$outcomes && !$image) return;
?>
<section class="section-courseDetail-3">
    <div class="wrap-padding" data-stick-layout>
        <div class="container">
            <div class="block-main row">
                <div class="box-left col-lg-6">
                    <div class="main-item">
                        <?php if ($heading): ?>
                            <h2 class="heading-2 mb-b"><?php echo esc_html($heading); ?></h2>
                        <?php endif; ?>

                        <?php if ($outcomes): ?>
                        <ul>
                            <?php foreach ($outcomes as $item):
                                $text = $item['title'];
                            ?>
                            <?php if ($text): ?>
                            <li>
                                <div class="item-check"><i class="fa-regular fa-check"></i></div>
                                <div class="item-content"><strong><?php echo esc_html($text); ?></strong></div>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if ($show_register || $brochure_file): ?>
                        <div class="button-content">
                            <?php if ($show_register): ?>
                                <a class="btn btn-white" href="<?php echo esc_url($register_url); ?>" target="<?php echo esc_attr($register_target); ?>">
                                    <span><?php echo esc_html($register_label); ?></span>
                                </a>
                            <?php endif; ?>
                            <?php if ($brochure_file): ?>
                                <a class="btn btn-primary" href="#popup-brochure" data-toggle="popup-brochure">
                                    <span><?php echo esc_html($brochure_btn_title); ?></span>
                                    <i class="fa-solid fa-download"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($image): ?>
                <div class="box-right col-lg-6">
                    <div class="img img-parallax ratio:pt-[900_960]"
                         data-stick-options='{"position": "right", "stickAbove": 1024}'
                         data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
