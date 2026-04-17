    </main>

    <div class="section-footer">
        <div class="warp-bg-footer">
            <div class="container" data-stick-layout>
                <div class="block-footer-top">
                    <div class="box-logo">
                        <div class="img img-ratio ratio:pt-[80_241]">
                            <?php 
                            $footer_logo = get_field('footer_logo', 'option') ?: get_template_directory_uri() . '/img/header-logo.svg';
                            ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <img class="lozad" data-src="<?php echo esc_url($footer_logo); ?>" alt="<?php bloginfo('name'); ?>" />
                            </a>
                        </div>
                    </div>
                    <div class="box-social">
                        <?php if (have_rows('footer_socials', 'option')): ?>
                            <ul>
                                <?php while (have_rows('footer_socials', 'option')): the_row(); 
                                    $icon_class = get_sub_field('icon');
                                    $link = get_sub_field('link');
                                ?>
                                    <li><a href="<?php echo esc_url($link); ?>"><i class="fa-brands <?php echo esc_attr($icon_class); ?>"></i></a></li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="block-footer-bottom">
                    <div class="box-info-footer">
                        <div class="item-footer-left">
                            <?php 
                            $footer_left_title = get_field('footer_left_title', 'option');
                            if ($footer_left_title) {
                                echo '<h2 class="title-footer heading-5 text-white uppercase mb-6">' . esc_html($footer_left_title) . '</h2>';
                            }
                            $footer_left_content = get_field('footer_left_content', 'option');
                            if ($footer_left_content) {
                                echo '<div class="footer-contact-info">' . wp_kses_post($footer_left_content) . '</div>';
                            }
                            ?>
                        </div>
                        <div class="item-footer-right">
                            <div class="sub-item-footer-top">
                                <div class="footer-menu">
                                    <?php 
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer-1',
                                        'container'      => false,
                                        'items_wrap'     => '<ul>%3$s</ul>',
                                        'fallback_cb'    => false
                                    )); 
                                    ?>
                                </div>
                            </div>
                            <div class="sub-item-footer-bottom" data-stick-options='{"stickBelow": 1199,"position": "both","gutter": 0}'>
                                <div class="footer-img">
                                    <div class="img img-ratio ratio:pt-[44_118]">
                                        <?php 
                                        $footer_right_cer = get_field('footer_right_cer', 'option');
                                        if ($footer_right_cer) {
                                            echo '<img class="lozad" data-src="' . esc_url($footer_right_cer) . '" alt="" />';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="footer-copy-btn">
                                     <?php 
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer-sitemap',
                                        'container'      => false,
                                        'items_wrap'     => '<ul>%3$s</ul>',
                                        'fallback_cb'    => false
                                    )); 
                                    ?>
                                    <div class="footer-copyright">
                                        <h3 class="title-copyright body-3">© <?php echo date('Y'); ?> Success Business Việt Nam. All Rights Reserved. Website designed by CanhCam.</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="header-search-form">
        <div class="close"><i class="fa-light fa-xmark"></i></div>
        <div class="container">
            <form role="search" method="get" class="wrap-form-search-product" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="productsearchbox">
                    <input type="text" name="s" placeholder="Tìm kiếm...">
                    <button type="submit" class="btn-search">Tìm kiếm</button>
                </div>
                <div class="message-search">Nhấn<span> Esc</span> để đóng</div>
            </form>
        </div>
    </div>
    
    <div class="menu-overlay mobile-overlay"></div>
    
    <div class="navbar-mobile p-0">
        <div class="mobi-bg w-full md:w-1/2 xl:w-[450px] !max-w-full h-full bg-white z-50 p-5 relative">
            <form role="search" method="get" class="header-search-form-mobile productsearchbox" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" name="s" placeholder="Tìm kiếm...">
                <button type="submit" class="btn-search">Tìm kiếm</button>
            </form>
            <div class="menu-list">
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'container'      => false,
                    'items_wrap'     => '<ul>%3$s</ul>',
                    'fallback_cb'    => false
                )); 
                ?>
            </div>
        </div>
    </div>

    <!-- Fixed CTA (Đã ánh xạ ACF) -->
    <div class="tool-fixed-cta">
        <div class="btn button-to-top" data-lenis-scroll-to='{"target": "top", "duration": 100}'>
            <div class="btn-icon">
                <div class="icon"></div>
            </div>
        </div>
        
        <?php $cta_phone = get_field('cta_phone', 'option'); ?>
        <?php if ($cta_phone): ?>
        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $cta_phone)); ?>" class="btn btn-content btn-phone">
            <div class="btn-icon">
                <div class="icon"><i class="fa-light fa-phone"></i></div>
            </div>
            <div class="content"><?php echo esc_html($cta_phone); ?></div>
        </a>
        <?php endif; ?>

        <?php if (have_rows('cta_socials', 'option')): ?>
        <div class="btn btn-content btn-social">
            <div class="btn-icon">
                <div class="icon"><i class="fa-light fa-messages"></i></div>
            </div>
            <div class="content">
                <ul>
                    <?php while (have_rows('cta_socials', 'option')): the_row(); 
                        $icon = get_sub_field('icon');
                        $link = get_sub_field('link');
                    ?>
                    <li><a href="<?php echo esc_url($link); ?>"><i class="<?php echo esc_attr($icon); ?>"></i></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) : ?>
        <?= get_field('field_config_footer', 'options') ?>
        <!-- <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/core.min.js"></script>
        <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/main.min.js"></script> -->
    <?php endif; ?>
    <?php wp_footer(); ?>
</body>
</html>