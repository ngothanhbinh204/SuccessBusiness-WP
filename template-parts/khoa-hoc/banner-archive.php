<?php
$banner_img   = null;
$banner_title = get_field('course_archive_banner_title', 'option') ?: 'Chương trình đào tạo';

if (is_tax('loai_khoa_hoc') || is_category()) {
	$term = get_queried_object();
	
	if ($term) {
		$term_banner = get_field('banner_taxonomy_khoahoc', $term);
		if ($term_banner) {
			$banner_img = $term_banner;
		}
	}
}

if (!$banner_img) {
	$banner_img = get_field('course_archive_banner_img', 'option');
}
?>
<section class="section-bannerNormal">
	<div class="warp-bannerNormal">
		<div class="img img-parallax ratio:pt-[960_1920]"
			data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
			<?php if ($banner_img): ?>
			<img src="<?php echo esc_url($banner_img['url']); ?>" alt="<?php echo esc_attr($banner_img['alt']); ?>" />
			<?php else: ?>
			<img src="https://picsum.photos/1920/1080?random=859" alt="" />
			<?php endif; ?>
		</div>
		<div class="content-banner">
			<div class="container">
				<h2 class="title-heading"><?php echo esc_html($banner_title); ?></h2>
				<div class="global-breadcrumb">
					<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	</div>
</section>