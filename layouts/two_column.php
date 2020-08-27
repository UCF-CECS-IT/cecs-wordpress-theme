<?php
/*
 * Label: Two Column
 * Name: two_column
 * Description: Displays a two content areas side by side, each taking up 50% of the available space
 */
?>
<?php list($options) = get_sub_field('options');

?>
<?php if(have_rows('content')): ?>
    <?php while(have_rows('content')): the_row(); ?>
        
        
        <?php if (kmdg_is_layout_formatted($options)): ?>
            <section>
                <?php 
                    $headers = kmdg_count_column_headers(get_sub_field_object('left_column'), get_sub_field_object('right_column'));

                    if ($headers == 2) { 
                        include('two_column-two-header.php');
                    }
                    if ($headers == 1) { 
                        include('two_column-one-header.php');
                    } 
                    if ($headers == 0) { 
                        include('two_column-zero-header.php');
                    } 
                ?>
            </section>

        <?php else: ?>
            <section>
                <div class="container two-column">
                    <div class="row mt-3 mb-5">
                        <div class="col-xl-6 col-lg-12">
                            <?php if(have_rows('left_column')): ?>
                                <?php while(have_rows('left_column')): the_row(); ?>
                                    <?php if(get_sub_field('title') || $options['force_titlebar']): ?>
                                        <<?php echo $options['title_tag']; ?>>
                                            <?php echo get_sub_field('title') ? get_sub_field('title') : '&nbsp;'; ?>
                                        </<?php echo $options['title_tag']; ?>>
                                    <?php endif; ?>
                                    <?php if(get_sub_field('text')): ?>
                                        <div class="content">
                                            <?php the_sub_field('text'); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>

                        <div class="col-xl-6 col-lg-12">
                            <?php if(have_rows('right_column')): ?>
                                <?php while(have_rows('right_column')): the_row(); ?>
                                    <?php if(get_sub_field('title') || $options['force_titlebar']): ?>
                                        <<?php echo $options['title_tag']; ?>>
                                            <?php echo get_sub_field('title') ? get_sub_field('title') : '&nbsp;'; ?>
                                        </<?php echo $options['title_tag']; ?>>
                                    <?php endif; ?>
                                    <?php if(get_sub_field('text')): ?>
                                        <div class="content">
                                            <?php the_sub_field('text'); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>