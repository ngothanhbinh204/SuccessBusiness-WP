<?php

$banner_img = null;

if (is_home() && !is_front_page()) {
	$posts_page_id = get_option('page_for_posts');
	if ($posts_page_id) {
		$banner_img = get_field('banner_taxonomy_khoahoc', $posts_page_id);
	}
} elseif (is_category() || is_tax()) {
	$term = get_queried_object();
	if ($term) {
		$banner_img = get_field('banner_taxonomy_khoahoc', $term);
	}
}
?>
<section class="section-banner">
	<div class="warp-banner">
		<div class="img img-parallax ratio:pt-[960_1920]"
			data-gsap-options='{"type": "img-parallax-percent", "yPercent": 20, "extra": 5}'>
			<?php if ($banner_img): ?>
			<?php if (is_array($banner_img)): ?>
			<img src="<?php echo esc_url($banner_img['url']); ?>" alt="<?php echo esc_attr($banner_img['alt']); ?>" />
			<?php else: ?>
			<img src="<?php echo esc_url($banner_img); ?>" alt="" />
			<?php endif; ?>
			<?php else: ?>
			<img src="https://picsum.photos/1920/1080?random=432" alt="" />
			<?php endif; ?>
		</div>
	</div>
</section>