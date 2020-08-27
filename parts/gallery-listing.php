<?php
$img = get_field('gallery_images')[0];
?>

<article class="h-100" id="gallery-<?php the_ID(); ?>">
    <a class="h-100 remove-pointer" href="<?php the_permalink(); ?>">
        <div class="card h-100">
            <div class="card-img-top card-height-set-3">
                <img class="img-fluid position-relative" src="<?php echo $img['sizes']['large'] ?>">
                <span class="badge badge-primary position-absolute position-top-right"><?php the_title(); ?></span>
            </div>
            <div class="card-block smaller">
                <?php if (get_the_content()): ?>
                    <span class="text-secondary"><?php the_content(); ?></span>
                <?php else: ?>
                    <span class="text-secondary">No caption available</span>
                <?php endif; ?>
            </div>
            <div class="card-footer text-muted bg-secondary">
                <span class="text-muted smaller text-uppercase letter-spacing-3">
                    <?php while(have_rows('date_range')): the_row();
                        echo get_sub_field('start_date');
                    endwhile; ?>
                </span>
            </div>
        </div>
    </a>
</article>