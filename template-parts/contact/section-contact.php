<?php
$ct_eyebrow       = get_field('ct_eyebrow');
$ct_company_name  = get_field('ct_company_name');
$ct_contact_items = get_field('ct_contact_items');
$ct_map_url       = get_field('ct_map_url');
$ct_subtitle      = get_field('ct_subtitle');
$ct_form_shortcode = get_field('ct_form_shortcode');
?>
<section class="section-contact">
	<div class="section-xl-py">
		<div class="container">
			<div class="block-main row lg-spacing">

				<div class="col-lg-5">

					<?php if ($ct_eyebrow || $ct_company_name): ?>
					<div class="main-content">
						<div class="top-content">
							<?php if ($ct_eyebrow): ?>
							<strong><?php echo esc_html($ct_eyebrow); ?></strong>
							<?php endif; ?>
							<?php if ($ct_company_name): ?>
							<h1 class="heading-2 text-primary-1"><?php echo esc_html($ct_company_name); ?></h1>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>

					<?php if ($ct_contact_items): ?>
					<div class="main-list">
						<ul>
							<?php foreach ($ct_contact_items as $item):
                                $icon_class = $item['icon_class'];
                                $content    = $item['content'];
                            ?>
							<li>
								<?php if ($icon_class): ?>
								<div class="icon-contact"><i class="<?php echo esc_attr($icon_class); ?>"></i></div>
								<?php endif; ?>

								<?php if ($content): ?>
								<div class="content-contact">
									<div><?php echo wp_kses_post($content); ?></div>
								</div>
								<?php endif; ?>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>

					<?php if ($ct_map_url): ?>
					<div class="iframe-map" data-lenis-prevent>
						<div class="img img-ratio ratio:pt-[252_480] rounded-4">
							<?php if($ct_map_url): ?>
							<?php echo ($ct_map_url); ?>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>

				</div>

				<div class="col-lg-7">

					<?php if ($ct_subtitle): ?>
					<div class="body-3 text-center mb-base"><?php echo wp_kses_post($ct_subtitle); ?></div>
					<?php endif; ?>

					<?php if ($ct_form_shortcode): ?>
					<div class="main-form-contact">
						<?php echo do_shortcode($ct_form_shortcode); ?>
					</div>
					<?php endif; ?>

				</div>

			</div>
		</div>
	</div>
</section>