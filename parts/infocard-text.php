<?php
/**
 * 
 */
?>
<?php if(have_rows('info')): ?>
    <?php while(have_rows('info')): the_row(); ?>
        <?php if(get_sub_field('name')): ?>
            <h4 class="mt-0"><?php the_sub_field('name'); ?></h4>
        <?php endif; ?>

        <?php if(get_sub_field('title')): ?>
            <div class="font-italic">
                <?php the_sub_field('title'); ?>
            </div>
        <?php endif; ?>

        <?php if(get_sub_field('department')): ?>
            <div class="info-department">
                <?php the_sub_field('department'); ?>
            </div>
        <?php endif; ?>

        <?php if(get_sub_field('email')): ?>
            <div class="info-email">
                <a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a>
            </div>
        <?php endif; ?>

        <?php if(get_sub_field('phone')): ?>
            <div class="info-phone">
                <a href="tel:<?php the_sub_field('phone'); ?>"><?php the_sub_field('phone'); ?></a>
            </div>
        <?php endif; ?>

        <?php if(get_sub_field('location')): ?>
            <div class="info-location">
                <address><?php the_sub_field('location'); ?></address>
            </div>
        <?php endif; ?>

        <?php if(get_sub_field('misc')): ?>
            <div class="info-misc">
                <?php the_sub_field('misc'); ?>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>