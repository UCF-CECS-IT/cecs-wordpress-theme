<?php
/*
 * Label: Three Column
 * Name: three_column
 * Description: Displays a three content areas side by side, each taking up 33% of the available space
 */
?>
<?php list($options) = get_sub_field('options'); ?>

<?php if(have_rows('content')): ?>
    <?php while(have_rows('content')): the_row(); ?>
        <?php if (kmdg_is_layout_formatted($options)): ?>
            <section class="layout three-col pb-3">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <?php if(have_rows('left_column')): ?>
                            <?php while(have_rows('left_column')): the_row(); ?>
                                <div class="card <?php echo kmdg_get_background($options);?> mb-2">
                                    <?php if(get_sub_field('title') || $options['force_titlebar']): ?>
                                        <h4 class="card-header <?php echo kmdg_get_background($options, 'title_bgcolor');?>">
                                            <?php echo get_sub_field('title') ? get_sub_field('title') : '&nbsp;'; ?>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if(get_sub_field('text')): ?>
                                        <div class="card-block content">
                                            <?php the_sub_field('text'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <?php if(have_rows('center_column')): ?>
                            <?php while(have_rows('center_column')): the_row(); ?>
                                <div class="card <?php echo kmdg_get_background($options);?> mb-2">
                                    <?php if(get_sub_field('title') || $options['force_titlebar']): ?>
                                        <h4 class="card-header <?php echo kmdg_get_background($options, 'title_bgcolor');?>">
                                            <?php echo get_sub_field('title') ? get_sub_field('title') : '&nbsp;'; ?>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if(get_sub_field('text')): ?>
                                        <div class="card-block content">
                                            <?php the_sub_field('text'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <?php if(have_rows('right_column')): ?>
                            <?php while(have_rows('right_column')): the_row(); ?>
                                <div class="card <?php echo kmdg_get_background($options);?> mb-2">
                                    <?php if(get_sub_field('title') || $options['force_titlebar']): ?>
                                        <h4 class="card-header <?php echo kmdg_get_background($options, 'title_bgcolor');?>">
                                            <?php echo get_sub_field('title') ? get_sub_field('title') : '&nbsp;'; ?>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if(get_sub_field('text')): ?>
                                        <div class="card-block content">
                                            <?php the_sub_field('text'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        <?php else: ?>
            <section class="layout three-col pb-3">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-2">
                        <?php if(have_rows('left_column')): ?>
                            <?php while(have_rows('left_column')): the_row(); ?>
                                <?php if(get_sub_field('title') || $options['force_titlebar']): ?>
                                    <<?php echo $options['title_tag']; ?>>
                                        <?php echo get_sub_field('title') ? get_sub_field('title') : '&nbsp;'; ?>
                                    </<?php echo $options['title_tag']; ?>>
                                <?php endif; ?>
                                <?php if(get_sub_field('text')): ?>
                                    <div class="card-block content">
                                        <?php the_sub_field('text'); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-2">
                        <?php if(have_rows('center_column')): ?>
                            <?php while(have_rows('center_column')): the_row(); ?>
                                <?php if(get_sub_field('title') || $options['force_titlebar']): ?>
                                    <<?php echo $options['title_tag']; ?>>
                                        <?php echo get_sub_field('title') ? get_sub_field('title') : '&nbsp;'; ?>
                                    </<?php echo $options['title_tag']; ?>>
                                <?php endif; ?>
                                <?php if(get_sub_field('text')): ?>
                                    <div class="card-block content">
                                        <?php the_sub_field('text'); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-sm-12 mb-2">
                        <?php if(have_rows('right_column')): ?>
                            <?php while(have_rows('right_column')): the_row(); ?>
                                <?php if(get_sub_field('title') || $options['force_titlebar']): ?>
                                    <<?php echo $options['title_tag']; ?>>
                                        <?php echo get_sub_field('title') ? get_sub_field('title') : '&nbsp;'; ?>
                                    </<?php echo $options['title_tag']; ?>>
                                <?php endif; ?>
                                <?php if(get_sub_field('text')): ?>
                                    <div class="card-block content">
                                        <?php the_sub_field('text'); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?> 
    <?php endwhile; ?>
<?php endif; ?>
