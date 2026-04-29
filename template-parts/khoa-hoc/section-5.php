<?php
$faq_heading = 'FAQ';
$faqs        = get_field('course_faqs');
$faq_icon_url = esc_url(get_template_directory_uri() . '/img/icon-FAQ.svg');

if (!$faqs) return;
?>
<section class="section-courseDetail-5">
	<div class="section-xl-pb">
		<div class="container">
			<h2 class="heading-2 mb-base text-center"><?php echo esc_html($faq_heading); ?></h2>

			<ul class="main-content">
				<?php foreach ($faqs as $index => $item):
                    $question = $item['question'];
                    $answer   = $item['answer'];
                    $is_first = ($index === 0);
                ?>
				<li>
					<div class="wrap-item-toggle<?php echo $is_first ? ' auto-active-first' : ''; ?>">
						<div class="item-toggle">
							<div class="title">
								<?php if ($question): ?>
								<h3 class="heading-3"><?php echo esc_html($question); ?></h3>
								<?php endif; ?>
								<div class="icon-faq">
									<div class="img img-parallax ratio:pt-[1_1]">
										<img src="<?php echo $faq_icon_url; ?>" alt="" />
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
	</div>
</section>