<?php
/**
 * Template Name: Trang Chủ
 */
get_header();
?>
<main>
    <h1 class="hidden"><?php the_title(); ?></h1>
    <?php get_template_part('template-parts/home/banner'); ?>
    <?php get_template_part('template-parts/home/section-1'); ?>
    <?php get_template_part('template-parts/home/section-2'); ?>
    <?php get_template_part('template-parts/home/section-3'); ?>
    <?php get_template_part('template-parts/home/section-4'); ?>
    <?php get_template_part('template-parts/home/section-5'); ?>
    <?php get_template_part('template-parts/home/section-6'); ?>
    <?php get_template_part('template-parts/home/section-7'); ?>
    <?php get_template_part('template-parts/home/section-8'); ?>
</main>
<?php
get_footer();
