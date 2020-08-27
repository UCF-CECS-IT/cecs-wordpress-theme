<div class="card <?php echo kmdg_get_background($options);?> mt-3 mb-5">
    <h3 class="card-header <?php echo kmdg_get_background($options, 'title_bgcolor');?>">
        <?php
            $fields = get_sub_field_object('left_column');
            echo $fields['value'][0]['title'];
        ?>
    </h3>
    <div class="card-block">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <?php if(have_rows('left_column')): ?>
                    <?php while(have_rows('left_column')): the_row(); ?>
                        <?php if(get_sub_field('text')): ?>
                            <div class="content">
                                <?php the_sub_field('text'); ?>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <div class="col-md-6 col-sm-12">
                <?php if(have_rows('right_column')): ?>
                    <?php while(have_rows('right_column')): the_row(); ?>
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
</div>