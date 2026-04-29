<?php
$title              = get_the_title();
$subtitle           = get_field('kh1_subtitle');
$description        = get_field('kh1_description');
$hero_image         = get_field('kh1_hero_image');
extract( canhcam_get_course_cta() );
?>
<section class="section-courseDetail-1">
	<div class="container">
		<div class="wrap-padding">
			<div class="row">
				<div class="col-lg-6 block-left">
					<h1 class="title-heading"><?php echo esc_html($title); ?></h1>

					<?php if ($subtitle): ?>
					<span class="sub-title heading-2"><?php echo esc_html($subtitle); ?></span>
					<?php endif; ?>

					<?php if ($description): ?>
					<div class="desc-content prose">
						<div><?php echo wp_kses_post($description); ?></div>
					</div>
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

				<div class="col-lg-6 block-right">
					<div class="img img-ratio ratio:pt-[1_1] zoom-img">
						<?php if ($hero_image): ?>
						<img class="lozad" data-src="<?php echo esc_url($hero_image['url']); ?>"
							alt="<?php echo esc_attr($hero_image['alt']); ?>" />
						<?php else:
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            if ($thumb): ?>
						<img class="lozad" data-src="<?php echo esc_url($thumb); ?>"
							alt="<?php echo esc_attr($title); ?>" />
						<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>