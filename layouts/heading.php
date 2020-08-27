<?php
/*
 * Label: Section Heading
 * Name: heading
 * Description: Displays a h1 tag and (optional) image
 */

 $fields = get_fields();

//  echo '<pre>';
//  print_r($fields);
//  echo '</pre>';
?>

<?php list($options) = get_sub_field('options'); ?>
<section class="layout py-3">

    <?php if(have_rows('content')): ?>
        <?php if (kmdg_is_layout_formatted($options)): ?>
            <div class="p-2 <?php echo kmdg_get_background($options);?>">
                <?php while(have_rows('content')): the_row(); ?>
                    <<?php echo $options['title_tag']; ?> class="title">
                        <?php the_sub_field('title'); ?>
                    </<?php echo $options['title_tag']; ?>>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="p-2">
                <?php while(have_rows('content')): the_row(); ?>
                    <<?php echo $options['title_tag']; ?> class="title">
                        <?php the_sub_field('title'); ?>
                    </<?php echo $options['title_tag']; ?>>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</section>
