<?php
$faq_heading     = get_field('faq_heading');
$faq_icon        = get_field('faq_icon');
$faq_filter_tabs = get_field('faq_filter_tabs');
$faq_items       = get_field('faq_items');
?>
<section class="section-faq">
    <div class="section-xl-py">
        <div class="container">

            <div class="block-btn">
                <?php if ($faq_heading): ?>
                    <h1 class="heading-2 text-center"><?php echo esc_html($faq_heading); ?></h1>
                <?php endif; ?>

                <?php if ($faq_filter_tabs): ?>
                <div class="filter-dropdown">
                    <div class="filter-toggle">
                        <span class="selected-text"><?php echo esc_html($faq_filter_tabs[0]['tab_label']); ?></span>
                        <i class="fa-regular fa-chevron-down"></i>
                    </div>
                    <ul class="tabslet-tab filter-menu">
                        <li><a href="javascript:void(0)"><span>Tất cả</span></a></li>
                        <?php foreach ($faq_filter_tabs as $tab):
                            $tab_label = $tab['tab_label'];
                        ?>
                            <?php if ($tab_label): ?>
                            <li><a href="javascript:void(0)"><span><?php echo esc_html($tab_label); ?></span></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>

            <?php if ($faq_items): ?>
            <div class="block-faq">
                <ul class="main-content">
                    <?php foreach ($faq_items as $index => $item):
                        $question     = $item['question'];
                        $answer       = $item['answer'];
                        $tab_category = $item['tab_category'];
                        $is_first     = ($index === 0);

                        // Icon: dùng field ACF nếu có, fallback về file tĩnh trong theme
                        if ($faq_icon) {
                            $icon_url = esc_url($faq_icon['url']);
                            $icon_alt = esc_attr($faq_icon['alt']);
                        } else {
                            $icon_url = esc_url(get_template_directory_uri() . '/img/icon-faq.svg');
                            $icon_alt = '';
                        }
                    ?>
                    <li<?php if ($tab_category): ?> data-category="<?php echo esc_attr($tab_category); ?>"<?php endif; ?>>
                        <div class="wrap-item-toggle<?php echo $is_first ? ' auto-active-first' : ''; ?>">
                            <div class="item-toggle">
                                <div class="title">
                                    <?php if ($question): ?>
                                        <h3 class="heading-3"><?php echo esc_html($question); ?></h3>
                                    <?php endif; ?>
                                    <div class="icon-faq">
                                        <div class="img img-parallax ratio:pt-[1_1]">
                                            <img src="<?php echo $icon_url; ?>" alt="<?php echo $icon_alt; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <?php if ($answer): ?>
                                <div class="content">
                                    <div><?php echo wp_kses_post($answer); ?></div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>
