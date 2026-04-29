<?php
$HomePageId = get_option('page_on_front');
$title = get_field('home_8_title', $HomePageId) ?: __('Hợp tác cùng <strong>SUCCESS BUSINESS</strong>', 'canhcamtheme');
$subtitle = get_field('home_8_subtitle', $HomePageId);
$image = get_field('home_8_image', $HomePageId);
$form_shortcode = get_field('home_8_form_shortcode', $HomePageId); // [contact-form-7 id="..."]
?>
<section class="section-home-8" data-stick-layout>
	<div class="container">
		<div class="row">
			<div class="col-xl-8">
				<div class="img img-parallax ratio:pt-[800_1140] h-full"
					data-stick-options='{"position": "both", "positionAbove": "left", "breakpoint": 1024}'
					data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
					<?php if ($image): ?>
					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					<?php else: ?>
					<img src="https://picsum.photos/1920/1080?random=779" alt="" />
					<?php endif; ?>
				</div>
			</div>
			<div class="col-xl-4">
				<div class="main-content">
					<h2 class="heading-2 title-heading"><?php echo wp_kses_post($title); ?></h2>
					<?php if ($subtitle): ?>
					<div class="sub-title">
						<?php echo wp_kses_post($subtitle); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="form-contact">
					<?php 
                    if ($form_shortcode) {
                        echo do_shortcode($form_shortcode);
                    } else {
                        // Fallback static form
                        echo '<p>' . __('Vui lòng chọn shortcode Contact Form 7 trong ACF Admin', 'canhcamtheme') . '</p>';
                    }
                    ?>
				</div>
			</div>
		</div>
	</div>
</section>