<?php
/**
 * Section 7: Truyền thông – chọn bài viết tùy ý qua relationship field
 * ACF field: home_7_news (relationship: post, return: object)
 */
$title = get_field('home_7_title') ?: 'Truyền Thông Nói Gì<br>về Success Business School';
$news  = get_field('home_7_news'); // array of WP_Post objects
if ($news):
?>
<section class="section-home-7">
    <div class="section-xl-pb">
        <div class="container">
            <div class="block-content">
                <div class="title-heading">
                    <h2 class="heading-2"><?php echo wp_kses_post($title); ?></h2>
                </div>
                <div class="button-swiper">
                    <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="home-7"><img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt=""/></div>
                    <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="home-7"><img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt=""/></div>
                </div>
            </div>
            <div class="block-swiper">
                <div class="swiper-column-auto auto-3-column" data-id-swiper="home-7" data-swiper-options='{"speed": 1200 }'>
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($news as $post_item):
                                $item_id    = $post_item->ID;
                                $item_title = $post_item->post_title;
                                $link       = get_permalink($item_id);
                                $img_url    = get_the_post_thumbnail_url($item_id, 'large') ?: 'https://picsum.photos/440/276';
                                $img_alt    = $item_title;
                            ?>
                            <div class="swiper-slide">
                                <a class="card-school group" href="<?php echo esc_url($link); ?>" target="_blank">
                                    <div class="card-img">
                                        <div class="img img-parallax ratio:pt-[276_440]" data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
                                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" />
                                        </div>
                                    </div>
                                    <div class="card-title">
                                        <h3 class="title-heading heading-3"><?php echo esc_html($item_title); ?></h3>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
