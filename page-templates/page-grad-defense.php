<?php
/*
 Template Name: Grad Defense Home
 */
get_header(); 

$gdconnection = mysqli_connect("localhost","defenseview","5Yu#TBQsmgvRkkN","graddef");
// $gdconnection = mysqli_connect("localhost","root","root","graddef");

if (!$gdconnection) {
    die('Could not connect: ' . mysqli_error($gdconnection));
}

$limitdate = date("Y-m-d 00:00:00",time());
$res = mysqli_query($gdconnection,"SELECT * FROM `submissions` WHERE Approved = 'Yes' AND Date >= '$limitdate' ORDER BY Date asc");

?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="container my-3">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h2 class="mt-3">Upcoming Defenses</h2>
        
                <p class="lead"><a href="http://www.cecs.ucf.edu/current-students/college-of-engineering-and-computer-science-policy-on-dissertationthesis-defenses/">College Policy on Dissertation/Thesis Defenses</a></p>
                <?php 
                    for ($i=0; $i < mysqli_num_rows($res); $i++) {
                        $row = mysqli_fetch_assoc($res);
                        
                        if ($lastday == date("M j Y",strtotime($row['date']))) { 
                            echo ""; 
                        } else { 

                            if ($i > 0) {
                                echo '</ul></div>';
                            }

                            echo '<div class="card mt-3 mb-4"><h3 class="card-header bg-primary-lighter">'; 
                            echo date("M j Y",strtotime($row['date']))."</strong>  <br />"; 
                            echo '</h3><ul class="list-group list-group-flush">';
                        }
                        
                        echo "<li class='list-group-item'><a class='nobold' href=/graddefense-old/pdf/".$row['ID'].">".$row['department']." Defense - ".$row['fname']." ".$row['lname']."</a></li>";

                        $lastday = date("M j Y",strtotime($row['date']));

                        if (mysqli_num_rows($res) == 1) {
                            echo '</ul></div>';
                        }
                    }
                    mysqli_close($gdconnection);
                    
                    if($i == 0) {
                        echo "<p>There are no upcoming defenses for this semester.</p>";
                    }
                ?>

                <p><?php the_content(); ?></p>
            
            </div>

            <div class="col-lg-3 col-md-12">
                <?php get_template_part('parts/sidebar', 'events'); ?>
            </div>
        </div>
    </div>
<?php endwhile; endif; ?>

    

<?php get_footer();
