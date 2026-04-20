<?php
$title = get_field('ab4_title');
$speakers = get_field('ab4_speakers');
$btn = get_field('ab4_btn');
?>
<section class="section-about-4" data-gsap-layout>
    <div class="section-xl-py">
        <div class="container">
            <?php if ($title): ?>
            <h2 class="heading-2 mb-base"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            
            <?php if ($speakers && count($speakers) > 0): 
                $first_speaker = $speakers[0];
                $first_id = $first_speaker->ID;
                $first_thumb = get_the_post_thumbnail_url($first_id, 'large');
                $first_pos = get_field('chuc_vu', $first_id) ?: 'Chuyên gia đào tạo'; // Thay field tương ứng của giang_vien
            ?>
            <div class="card-main-about-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="img img-ratio ratio:pt-[491_440] zoom-img">
                            <img class="lozad" data-src="<?php echo esc_url($first_thumb); ?>" alt="<?php echo esc_attr($first_speaker->post_title); ?>" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="main-content">
                            <h3 class="heading-3 title-heading"><?php echo esc_html($first_speaker->post_title); ?></h3>
                            <ul class="sub-title">
                                <li>
                                    <p><?php echo esc_html($first_pos); ?></p>
                                </li>
                                <?php 
                                // Nếu giảng viên có nhiều chức vụ hoặc mô tả ngắn, có thể lấy từ excerpt hoặc ACF
                                $excerpt = get_the_excerpt($first_id);
                                if ($excerpt) {
                                    echo '<li><p>' . esc_html($excerpt) . '</p></li>';
                                }
                                ?>
                            </ul>
                            <div class="mt-4">
                                <a class="btn btn-primary" href="<?php echo get_permalink($first_id); ?>"><span>Xem chi tiết</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if (count($speakers) > 1): ?>
            <div class="block-grid">
                <?php for ($i = 1; $i < count($speakers); $i++): 
                    $sp = $speakers[$i];
                    $sp_id = $sp->ID;
                    $thumb = get_the_post_thumbnail_url($sp_id, 'medium');
                    $pos = get_field('chuc_vu', $sp_id) ?: 'Chuyên gia';
                ?>
                <a class="card-author group" href="<?php echo get_permalink($sp_id); ?>" data-gsap-options='{"type": "img-parallax", "move":5}'>
                    <div class="card-img">
                        <div class="img img-ratio ratio:pt-[440_490] zoom-img">
                            <img class="lozad" data-src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($sp->post_title); ?>" />
                        </div>
                    </div>
                    <div class="card-info">
                        <div class="info-content">
                            <h3 class="info-name heading-3"><?php echo esc_html($sp->post_title); ?></h3>
                            <div class="sub-info">
                                <p><?php echo esc_html($pos); ?></p>
                            </div>
                        </div>
                        <div class="btn-info"><span>Xem chi tiết</span></div>
                    </div>
                </a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            
            <?php if ($btn && is_array($btn)): ?>
            <div class="block-btn flex-center mt-base">
                <a class="btn btn-white" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target'] ?: '_self'); ?>"><span><?php echo esc_html($btn['title']); ?></span></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
