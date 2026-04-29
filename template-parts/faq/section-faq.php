<?php
$faq_heading     = get_field('faq_heading');
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
						<span class="selected-text">Tất cả</span>
						<i class="fa-regular fa-chevron-down"></i>
					</div>
					<ul class="tabslet-tab filter-menu">
						<li class="active">
							<a href="javascript:void(0)" data-category="all">
								<span>Tất cả</span>
							</a>
						</li>
						<?php foreach ($faq_filter_tabs as $tab):
                            $tab_label    = $tab['tab_label'];
                            $tab_slug     = sanitize_title($tab_label);
                        ?>
						<?php if ($tab_label): ?>
						<li>
							<a href="javascript:void(0)" data-category="<?php echo esc_attr($tab_slug); ?>">
								<span><?php echo esc_html($tab_label); ?></span>
							</a>
						</li>
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
                        
                        $category_slug = $tab_category ? sanitize_title($tab_category) : '';
                    ?>
					<li class="faq-item"<?php if ($category_slug): ?> data-category="<?php echo esc_attr($category_slug); ?>"<?php endif; ?>>
						<div class="wrap-item-toggle<?php echo $is_first ? ' auto-active-first' : ''; ?>">
							<div class="item-toggle">
								<div class="title">
									<?php if ($question): ?>
									<h3 class="heading-3"><?php echo esc_html($question); ?></h3>
									<?php endif; ?>
									<div class="icon-faq">
										<div class="img img-parallax ratio:pt-[1_1]">
											<img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-FAQ.svg'); ?>"
												alt="" />
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