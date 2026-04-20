<?php
$ct_breadcrumb_title = get_field('ct_breadcrumb_title') ?: get_the_title();
?>
<section class="global-breadcrumb">
    <div class="container">
        <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        </nav>
    </div>
</section>
