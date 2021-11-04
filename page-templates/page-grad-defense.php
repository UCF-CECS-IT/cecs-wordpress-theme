<?php
/*
 Template Name: Grad Defense Home
 */
get_header(); 

$gdconnection = grad_defense_connection();

if (!$gdconnection) {
    die('Could not connect: ' . mysqli_error($gdconnection));
}

$limitdate = grad_defense_start_date();
$res = get_grad_defenses($gdconnection, $limitdate);
$submissionArray = grad_defenses_build_array($res);

?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="container my-3">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h2 class="mt-3">Upcoming Defenses</h2>
        
                <p class="lead"><a href="http://www.cecs.ucf.edu/current-students/college-of-engineering-and-computer-science-policy-on-dissertationthesis-defenses/">College Policy on Dissertation/Thesis Defenses</a></p>
                
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

                <p><?php the_content(); ?></p>
            
            </div>

            <div class="col-lg-3 col-md-12">
                <?php get_template_part('parts/sidebar', 'events'); ?>
            </div>
        </div>
    </div>
<?php endwhile; endif; ?>

    

<?php get_footer();
