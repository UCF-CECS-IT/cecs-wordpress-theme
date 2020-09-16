<?php 
/*
 Template Name: Scholarship
 */

get_header(); 
the_post();  
the_row();
$college_group = get_field('college_group');

$args = [
    'post_type'=> 'scholarship',
    'order'    => 'ASC',
	'orderby' => 'title',
	'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'college_group',
            'value' => $college_group,
            'compare' => '=',
        )
    )
];              

$metaQuery = new WP_Query( $args );

//echo '<pre>';
// print_r($the_query );
// echo '</pre>';

?>

<div class="container">
    <? // the_content(); ?>

    <table class="table table-mobile">
        <thead>
            <tr class="centered-rows">
                <th>Scholarship Name</th>
                <th>Number Available</th>
                <th>Eligible Majors</th>
                <th>Application Deadline</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($metaQuery->posts as $post): 
                $scholarship = get_fields($post->ID);?>
                
                <tr class="centered-rows">
                    <td>
                        <a href="#" data-toggle="modal" data-target="#scholarship<?php echo $post->ID; ?>">
                            <?php echo $scholarship['name']; ?>
                        </a>

                        <div class="modal fade" id="scholarship<?php echo $post->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header bg-primary-lighter">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $scholarship['name']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-left">
                                    <?php echo $scholarship['requirements']; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><?php echo $scholarship['number_available']; ?></td>
                    <td><?php echo $scholarship['eligible_majors']; ?></td>
                    <td><?php echo $scholarship['deadline']; ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php get_footer(); ?>
