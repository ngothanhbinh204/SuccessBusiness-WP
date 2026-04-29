<?php

$post_id    = get_the_ID();
$title      = get_the_title();
$post_date  = get_the_date('d/m/Y', $post_id);
$categories = get_the_category($post_id);
$cat_name   = !empty($categories) ? $categories[0]->name : '';
?>
<section class="global-breadcrumb">
	<div class="container">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	</div>
</section>

<section class="section-newsDetail">
	<div class="section-xl-py">
		<div class="container">
			<div class="main-newsDetail">
				<h1 class="heading-2 mb-5 title-heading"><?php echo esc_html($title); ?></h1>

				<div class="category">
					<div class="main-category">
						<?php if ($cat_name): ?>
						<span><?php echo esc_html($cat_name); ?></span>
						<?php endif; ?>
						<strong>
							<i class="fa-solid fa-calendar-day"></i>
							<p><?php echo esc_html($post_date); ?></p>
						</strong>
					</div>
				</div>

				<div class="main-post">
					<div class="prose">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>