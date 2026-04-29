<?php
/**
 * Single post template: Chi tiết bài viết
 * Tương ứng: UI/newsDetail.html
 */
get_header();
?>

<main>
	<div class="section-newsDetail">
		<?php
	while (have_posts()) :
		the_post();
		get_template_part('template-parts/news/section-content');
	endwhile;
	?>
		<?php get_template_part('template-parts/news/section-related-post'); ?>
	</div>
</main>

<?php
get_footer();
?>