<div class="row no-gutters">
    <div class="col-md-6 col-sm-12 mb-4">
        <?php if(have_rows('left_column')): ?>
            <?php while(have_rows('left_column')): the_row(); ?>
                <div class="card <?php echo kmdg_get_background($options);?> mt-3 mb-5 border-0 h-100">
                    <h4 class="card-header <?php echo kmdg_get_background($options, 'title_bgcolor');?>">
                        <?php echo get_sub_field('title'); ?>
                    </h4>
                    <div class="card-block">
                        <?php the_sub_field('text'); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <div class="col-md-6 col-sm-12 mb-4">
        <?php if(have_rows('right_column')): ?>
            <?php while(have_rows('right_column')): the_row(); ?>
                <div class="card <?php echo kmdg_get_background($options);?> mt-3 mb-5 border-0 h-100">
                    <h4 class="card-header <?php echo kmdg_get_background($options, 'title_bgcolor');?>">
                        <?php echo get_sub_field('title'); ?>
                    </h4>
                    <div class="card-block">
                        <?php the_sub_field('text'); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
