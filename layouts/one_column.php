<?php
/*
 * @package WordPress
 * @subpackage kmdg
 *
 * Label: One Column
 * Name: one_column
 * Description: Displays a single content area (similar to standard wordpress)
 */
?>

<?php list($options) = get_sub_field('options'); 

// print_r($options);

// print_r(kmdg_get_background($options));
// print_r(kmdg_get_background($options, 'title_bgcolor'));
?>

<section class="pb-3">
    <?php if(have_rows('content')): ?>
        <?php while(have_rows('content')): the_row(); ?>

            <?php if (kmdg_is_layout_formatted($options)): ?>
                <div class="card <?php echo kmdg_get_background($options);?>">
                    <?php if (get_sub_field('title')): ?>
                        <h4 class="card-header <?php echo kmdg_get_background($options, 'title_bgcolor');?>">
                            <?php echo get_sub_field('title')?>
                        </h4>
                    <?php endif; ?>
                    <div class="card-block">
                        <?php if(get_sub_field('text')): ?>
                            <div class="content">
                                <?php the_sub_field('text'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
            <?php else: ?>
                <?php if(get_sub_field('title') || $options['force_titlebar']): ?>
                    <<?php echo $options['title_tag']; ?> class="title" style="color: <?php echo $options['title_color']; ?>; text-align: <?php echo $options['title_alignment']; ?>;background-color: <?php echo $options['title_bgcolor']; ?>;">
                        <?php echo get_sub_field('title') ? get_sub_field('title') : '&nbsp;'; ?>
                    </<?php echo $options['title_tag']; ?>>
                <?php endif; ?>
                <?php if(get_sub_field('text')): ?>
                    <div class="content">
                        <?php the_sub_field('text'); ?>
                    </div>
                <?php endif; ?>
                
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</section>
