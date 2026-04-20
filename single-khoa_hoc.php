<?php
/**
 * Single template: Khóa Học (khoa_hoc CPT)
 * Tương ứng: UI/courseDetail.html
 */
get_header();
?>

<main>
	<?php get_template_part('template-parts/khoa-hoc/banner-single'); ?>
	<?php get_template_part('template-parts/khoa-hoc/section-1'); ?>
	<?php get_template_part('template-parts/khoa-hoc/section-2'); ?>
	<?php get_template_part('template-parts/khoa-hoc/section-3'); ?>
	<?php get_template_part('template-parts/khoa-hoc/section-4'); ?>
	<?php get_template_part('template-parts/khoa-hoc/section-5'); ?>
	<?php get_template_part('template-parts/home/section-8'); ?>
	<?php get_template_part('template-parts/khoa-hoc/section-6'); ?>
	<?php get_template_part('template-parts/khoa-hoc/popup-brochure'); ?>
</main>

<?php
get_footer();
?>