<?php
/*
 * Label: Info Cards
 * Name: info_cards
 * Description: Displays pictures and content side by side in an organized two column layout,
 * each cell consisting of one picture and a variable amount of text content.
 */
?>
<?php list($options) = get_sub_field('options'); ?>

<section class="layout pb-3">
    <div class="card <?php echo kmdg_get_background($options);?>">
        <?php if(get_sub_field('section_title')): ?>
            <h4 class="card-header <?php echo kmdg_get_background($options, 'title_bgcolor');?>">
                <?php echo get_sub_field('section_title')?>
            </h4>
        <?php endif; ?>

        <div class="card-block">
            <?php if (have_rows('content')): ?>
                <?php while (have_rows('content')): the_row(); ?>
                    <div class="row">
                        <?php if(have_rows('left_column')): ?>
                            <?php while(have_rows('left_column')): the_row(); ?>
                                <div class="col-md-6 col-sm-12 mb-4">
                                    <div class="media">
                                        <?php if ($options['use_smart_crop']): ?>
                                            <img class="d-flex mr-3 object-fit-cover" src="<?php echo wp_get_attachment_image_src(get_sub_field('image'))[0]; ?>" alt="<?php the_sub_field('name');?>" style="width: <?php echo $options['image_width'];?>px; height: <?php echo $options['image_height'];?>px;">
                                        <?php else: ?>
                                            <img class="d-flex mr-3" src="<?php echo wp_get_attachment_image_src(get_sub_field('image'))[0]; ?>" alt="<?php the_sub_field('name');?>">
                                        <?php endif; ?>
                                        <div class="media-body">
                                            <span class="smaller">
                                                <?php get_template_part('parts/infocard', 'text'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>

                        <?php if(have_rows('right_column')): ?>
                            <?php while(have_rows('right_column')): the_row(); ?>
                                <div class="col-md-6 col-sm-12 mb-4">
                                    <div class="media">
                                        <?php if ($options['use_smart_crop']): ?>
                                            <img class="d-flex mr-3 object-fit-cover" src="<?php echo wp_get_attachment_image_src(get_sub_field('image'))[0]; ?>" alt="<?php the_sub_field('name');?>" style="width: <?php echo $options['image_width'];?>px; height: <?php echo $options['image_height'];?>px;">
                                        <?php else: ?>
                                            <img class="d-flex mr-3" src="<?php echo wp_get_attachment_image_src(get_sub_field('image'))[0]; ?>" alt="<?php the_sub_field('name');?>">
                                        <?php endif; ?>
                                        <div class="media-body">
                                            <span class="smaller">
                                                <?php get_template_part('parts/infocard', 'text'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>