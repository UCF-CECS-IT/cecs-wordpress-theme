<?php
/*
 Template Name: Grad Defense Year
 */
get_header(); 

$gdconnection = grad_defense_connection();

if (!$gdconnection) {
    die('Could not connect: ' . mysqli_error($gdconnection));
}

$slug = $post->post_name;
$year = explode('-', $slug)[2];
$today = date("Y-m-d H:i:s");

$res = get_grad_defenses($gdconnection, "$year-12-31 23:59:00");
$submissionArray = grad_defenses_build_array($res);

global $post;
$slug = $post->post_name;
$year = explode('-', $slug)[2];

$today = date("Y-m-d H:i:s");
$res = mysqli_query($gdconnection,"SELECT * FROM `submissions` WHERE Approved = 'Yes' AND Date < '$year-12-31 23:59:00' AND Date > '$year-01-01 00:00:00' ORDER BY Date desc");
$submissionArray = grad_defenses_build_array($res);

?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="container my-3">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <p><a href="http://www.cecs.ucf.edu/current-students/grad-defenses/">Back to Upcoming Defenses</a></p>

                <?php the_content(); ?>

                <?php foreach($submissionArray as $defenseDate => $presentations): ?>
                    <div class="card mt-3 mb-4">
                        <h3 class="card-header bg-primary-lighter"><?php echo $defenseDate; ?></h3>
                        <ul class="list-group list-group-flush">
                            <?php foreach($presentations as $presentation): ?>
                                <li class='list-group-item'><a class='nobold' href="/graddefense-old/pdf/<?php echo $presentation['ID'];?>"><?php echo $presentation['department']; ?> Defense - <?php echo $presentation['fname']; ?> <?php echo $presentation['lname']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="col-lg-3 col-md-12">
                <?php get_template_part('parts/sidebar', 'events'); ?>
            </div>
        </div>
    </div>

<?php endwhile; endif; ?>

<?php get_footer();

