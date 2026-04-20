<?php
// Section 2: Khóa học dành cho ai – check list + gallery swiper
$heading            = get_field('kh2_heading');
$subtitle           = get_field('kh2_subtitle');
$audiences          = get_field('target_audiences');
$gallery            = get_field('kh2_gallery');
// Shared CTA – dùng chung toàn trang (xem hàm canhcam_get_course_cta() trong function-custom.php)
extract( canhcam_get_course_cta() );
// $show_register, $register_url, $register_label, $register_target, $brochure_file, $brochure_btn_title

if (!$heading && !$audiences && !$gallery) return;
?>
<section class="section-courseDetail-2">
	<div class="section-xl-py">
		<div class="container">
			<div class="block-top row">
				<div class="col-lg-6 box-left">
					<?php if ($heading): ?>
					<h2 class="heading-2"><?php echo esc_html($heading); ?></h2>
					<?php endif; ?>

					<?php if ($subtitle): ?>
					<span class="sub-title"><?php echo esc_html($subtitle); ?></span>
					<?php endif; ?>

					<?php if ($show_register || $brochure_file): ?>
					<div class="button-content">
						<?php if ($show_register): ?>
						<a class="btn btn-white" href="<?php echo esc_url($register_url); ?>"
							target="<?php echo esc_attr($register_target); ?>">
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

				<?php if ($audiences): ?>
				<div class="col-lg-6 box-right">
					<ul>
						<?php foreach ($audiences as $item):
                            $desc = $item['description'];
                        ?>
						<?php if ($desc): ?>
						<li>
							<div class="item-check"><i class="fa-regular fa-check"></i></div>
							<div class="item-content"><strong><?php echo esc_html($desc); ?></strong></div>
						</li>
						<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>

			<?php if ($gallery): ?>
			<div class="block-bottom">
				<div class="swiper-column-auto auto-1-column" data-id-swiper="courseDetail-2"
					data-swiper-options='{"effect": "fade", "speed": 1200, "fadeEffect": { "crossFade": true }}'>
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($gallery as $img): ?>
							<div class="swiper-slide">
								<div class="img img-ratio ratio:pt-[668_1400] rounded-6 zoom-img">
									<img class="lozad" data-src="<?php echo esc_url($img['url']); ?>"
										alt="<?php echo esc_attr($img['alt']); ?>" />
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="button-swiper">
					<div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="courseDetail-2">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/img/left-icon.svg'); ?>" alt="" />
					</div>
					<div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="courseDetail-2">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/img/left-icon.svg'); ?>" alt="" />
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>