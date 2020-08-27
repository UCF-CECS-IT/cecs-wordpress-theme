<?php
/**
 * 
 */

get_header(); ?>

<div class="container mt-4 mt-sm-5 mb-2 pb-sm-4">

    <div class="pb-5 ">
        <h5 class="heading-underline">Filter</h5>    
        <button id="show-all" data-filter="all" class="btn btn-sm smaller btn-default m-2">Show All</button>
        <button id="show-cece" data-filter="one" class="btn btn-sm smaller btn-default m-2">Civil, Environmental, and Construction Engineering</button>
        <button id="show-cs" data-filter="two" class="btn btn-sm smaller btn-default m-2">Computer Science</button>
        <button id="show-ece" data-filter="three" class="btn btn-sm smaller btn-default m-2">Electrical & Computer Engineering</button>
        <button id="show-iems" data-filter="four" class="btn btn-sm smaller btn-default m-2">Industrial Engineering & Management Systems</button>
        <button id="show-mse" data-filter="five" class="btn btn-sm smaller btn-default m-2">Materials Science and Engineering</button>
        <button id="show-mae" data-filter="six" class="btn btn-sm smaller btn-default m-2">Mechanical and Areospace Engineering</button>
    </div>

    <div class="row justify-content-center" id="showcase-cards">
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('parts/faculty-showcase','listing'); ?>
        <?php endwhile;	?>
    </div>
</div>
    
<?php get_footer(); ?>