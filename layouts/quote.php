<?php
/*
 * Label: Quote
 * Name: quote
 * Description: Displays a blockquote formatted section
 */
?>

<?php list($options) = get_sub_field('options'); ?>

<section class="layout py-3">
    <?php if(have_rows('content')): ?>
        <?php while(have_rows('content')): the_row(); ?>
            <blockquote class="blockquote blockquote-quotation">
                <p class="mb-0"><?php the_sub_field('text'); ?></p>
                <footer class="blockquote-footer"><?php the_sub_field('name'); ?> <cite title="Source Title">&#8212; <?php the_sub_field('position'); ?></cite></footer>
            </blockquote>
        <?php endwhile; ?>
    <?php endif; ?>
</section>
