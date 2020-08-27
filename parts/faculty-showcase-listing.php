<?php $department = get_field('department');?>

<div class="col-lg-3 col-md-4 col-10 mb-3" data-department="<?php the_field('department'); ?>">
    <a href="<?= get_permalink() ?>" class="remove-pointer"  id="post-<?php the_ID(); ?>">
        <div class="card overlay-group media-background-container h-100">
            <img class="media-background object-fit-cover" src="<?php echo showcase_get_photo(); ?>">

            <div class="hover-show bg-secondary-t-3 fade text-center h-75 d-flex flex-column justify-content-center">
                <p class="larger font-weight-bold"><?php the_field('hover_text', false, false);?></p>
            </div>

            <div class="h-25 py-2 mb-0 bg-inverse-t-3 text-center">
                <h5><?php the_title();?></h5>
                <p class="font-italic pb-0 mb-0"><?php the_field('sub_heading', false, false);?></p>
            </div>
        </div>
    </a>
</div>