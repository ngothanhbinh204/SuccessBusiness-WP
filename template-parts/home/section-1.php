<?php
$title = get_field('home_1_title') ?: 'Chương trình đào tạo';
$tabs = get_field('home_1_tabs');
if ($tabs):
?>
<section class="section-home-1" data-gsap-layout>
    <div class="wrap-bg-home">
        <div class="container">
            <div class="gsap-tabs-wrapper" data-gsap-tabs-options="{'effect': 'fade-up', 'event': 'click', 'triggerScale': 1,'duration': 0.8}">
                <div class="block-top">
                    <div class="box-left">
                        <h2 class="heading-2 mb-4" data-gsap-options='{"type": "split-chars"}'><?php echo esc_html($title); ?></h2>
                        <div class="filter-dropdown" data-gsap-options='{"type": "fade-up"}'>
                            <div class="filter-toggle"><span class="selected-text"><?php echo esc_html($tabs[0]['tab_title']); ?></span><i class="fa-regular fa-chevron-down"></i></div>
                            <ul class="tab-triggers filter-menu">
                                <?php foreach ($tabs as $index => $tab): ?>
                                <li data-tab-trigger="<?php echo $index; ?>"><a class="nav-link" href="javascript:void(0)"><span><?php echo esc_html($tab['tab_title']); ?></span></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="box-right">
                        <div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="home-1"><img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt=""/></div>
                        <div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="home-1"><img src="<?php echo get_template_directory_uri(); ?>/img/left-icon.svg" alt=""/></div>
                    </div>
                </div>
                
                <div class="block-bottom" data-gsap-options='{"type": "fade-up", "delay": 0.3, "duration": 0.8}'>
                    <div class="tab-contents relative">
                        <?php foreach ($tabs as $index => $tab): 
                            $courses = $tab['courses'];
                        ?>
                        <div class="tab-pane w-full" data-tab-content="<?php echo $index; ?>">
                            <div class="swiper-dynamic-config" data-id-swiper="home-1" data-swiper-options='{"slidesPerView": 1, "spaceBetween":"getVw(15, 32)", "res": {"md": 2 , "lg": 3}}'>
                                <div class="swiper">
                                    <div class="swiper-wrapper h-auto">
                                        <?php if ($courses): foreach ($courses as $course): 
                                            // Gọi Relationship data
                                            $course_id = $course->ID;
                                            $thumb = get_the_post_thumbnail_url($course_id, 'large') ?: 'https://picsum.photos/600/400';
                                            $start_date = get_field('start_date', $course_id) ?: 'Sắp khai giảng';
                                        ?>
                                        <div class="swiper-slide">
                                            <a class="group card-course" href="<?php echo get_permalink($course_id); ?>">
                                                <div class="card-img">
                                                    <div class="img img-ratio ratio:pt-[296_455] zoom-img">
                                                        <img class="lozad" data-src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($course->post_title); ?>"/>
                                                    </div>
                                                </div>
                                                <div class="card-info">
                                                    <div class="info-date"><span><?php echo esc_html($start_date); ?></span></div>
                                                    <h3 class="info-title"><?php echo esc_html($course->post_title); ?></h3>
                                                    <div class="info-content">
                                                        <p><?php echo wp_trim_words(get_the_excerpt($course_id), 20); ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php endforeach; endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
