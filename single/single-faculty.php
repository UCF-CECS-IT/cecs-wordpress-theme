<?php 

the_post(); 

$metaArray = get_metadata('post', $post->ID);
$positionArray = faculty_get_positions($metaArray);
$educationArray = faculty_get_education($metaArray);
$publicationsArray = faculty_get_publications($metaArray);

?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">
        <h1 class="display-4 font-weight-light text-center pb-4">
            <?php echo faculty_get_display_name($metaArray); ?>
        </h1>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-8 col-10 pb-2">
                <img class="img-fluid w-100" src="<?php echo faculty_get_photo(); ?>">
            </div>

            <div class="col-lg-8 col-sm-12">
                <h4 class="font-weight-light text-lg-left text-center"><?php echo ($metaArray['featured_position'][0] ?? false) ?: faculty_get_display_title($positionArray) ?></h4>
                <table class="table">
                    <tr>
                        <th>Department:</th>
                        <td><?php echo $metaArray['department'][0] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <th class="w-25">Email:</th>
                        <td><?php echo faculty_get_email($metaArray); ?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo $metaArray['phone'][0] ?? '';?></td>
                    </tr>
                    <tr>
                        <th>Office:</th>
                        <td><?php echo $metaArray['building'][0] ?? ''; ?> <?php echo $metaArray['room'][0] ?? ''; ?></td>
                    </tr>
                    <tr>
                        <th>Website:</th>
                        <td class="limit-width"><?php echo faculty_get_website($metaArray);?></td>
                    </tr>
                    <tr>
                        <th>Resume:</th>
                        <td><?php echo faculty_get_resume($metaArray);?></td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="faculty-accordion my-4" id="accordion" role="tablist">

            <!-- Summary Fold -->
            <?php if (($metaArray['summary'][0] ?? false) || ($metaArray['quote'][0] ?? false) || ($metaArray['research_interests'][0] ?? false)): ?>
                <div class="card">
                    <h6 class="card-header tab-header mb-0" data-toggle="collapse" href="#summaryCollapse" aria-expanded="false" aria-controls="summaryCollapse">
                        <i class="fa fa-plus"></i>&nbsp; Summary
                    </h6>
                    <div id="summaryCollapse" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-block">
                            <?php if ($metaArray['quote'][0] ?? false): ?>
                                <blockquote class="blockquote blockquote-reverse blockquote-quotation">
                                    <p class="mb-0"><?php echo $metaArray['quote'][0] ?? false; ?></p>
                                </blockquote>
                            <?php endif; ?>

                            <?php if ($metaArray['summary'][0] ?? false): ?>
                                <p><?php echo $metaArray['summary'][0] ?? false; ?></p>
                            <?php endif; ?>

                            <?php if ($metaArray['research_interests'][0] ?? false): ?>
                                <p class="mb-0">
                                    <span class="font-weight-bold">Research Interests:</span> <?php echo $metaArray['research_interests'][0] ?? false; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Education fold -->
            <?php if (!empty($educationArray)): ?>
                <div class="card">
                    <h6 class="card-header tab-header collapsed mb-0" data-toggle="collapse" href="#educationCollapse" aria-expanded="false" aria-controls="educationCollapse">
                        <i class="fa fa-plus"></i>&nbsp; Education
                    </h6>
                    <div id="educationCollapse" class="collapse" role="tabpanel" aria-labelledby="educationCollapse" data-parent="#accordion">
                        <ul class="list-group list-group-flush">
                            <?php foreach(faculty_get_education($metaArray) as $entry): ?>
                                <li class="list-group-item py-0">
                                    <table class="table shrink-mobile">
                                        <tr>
                                            <th class="w-25"><?php echo $entry['degree_level'];?></th>
                                            <td class="w-25"><?php echo $entry['institution'];?></td>
                                            <td><?php echo $entry['field'];?></td>
                                        </tr>
                                    </table>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Positions fold -->
            <?php if (faculty_has_positions($positionArray)): ?>
                <div class="card">
                    <h6 class="card-header tab-header collapsed mb-0" data-toggle="collapse" href="#positionsCollapse" aria-expanded="false" aria-controls="positionsCollapse">
                        <i class="fa fa-plus"></i>&nbsp; Positions
                    </h6>
                    <div id="positionsCollapse" class="collapse" role="tabpanel" aria-labelledby="positionsCollapse" data-parent="#accordion">
                        <table class="table">
                            <?php foreach($positionArray as $type => $values): ?>
                                <?php if (!empty($values)): ?>
                                    <tr>
                                        <td class="w-25"><h6 class="heading-underline"><?php echo $type; ?></h6>
                                        <td>
                                            <ul>
                                                <?php foreach($values as $value): ?>
                                                    <li><?php echo $value;?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Publications -->
            <?php if (!empty($publicationsArray)): ?>
                <div class="card">
                    <h6 class="card-header tab-header collapsed mb-0" data-toggle="collapse" href="#publicationsCollapse" aria-expanded="false" aria-controls="publicationsCollapse">
                        <i class="fa fa-plus"></i>&nbsp; Publications
                    </h6>
                    <div id="publicationsCollapse" class="collapse" role="tabpanel" aria-labelledby="publicationsCollapse" data-parent="#accordion">
                        <ul class="list-group list-group-flush">
                            <?php foreach($publicationsArray as $publication): ?>
                                <li class="list-group-item">
                                    <p>
                                        <?php echo $publication['citation']; ?>
                                    </p>
                                    <!-- <p>
                                        <a class="text-left" href="<?php echo $publication['link']; ?>"><?php echo $publication['link']; ?></a>
                                        <span class="float-right"><?php echo $publication['year']; ?></span>
                                    </p> -->
                                </li>   
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

             <!-- Web / Social -->
             <?php if (($metaArray['website'][0] ?? false) || ($metaArray['youtube_link'][0] ?? false) || ($metaArray['twitter_url'][0] ?? false)): ?>
                <div class="card">
                    <h6 class="card-header tab-header collapsed mb-0" data-toggle="collapse" href="#webCollapse" aria-expanded="false" aria-controls="webCollapse">
                        <i class="fa fa-plus"></i>&nbsp; Web/Social
                    </h6>
                    <div id="webCollapse" class="collapse" role="tabpanel" aria-labelledby="webCollapse" data-parent="#accordion">
                        <table class="table">
                            <tr>
                                <?php if ($metaArray['website'][0] ?? false): ?>
                                    <th>Website:</th>
                                    <td><?php echo faculty_get_website($metaArray);?></td>
                                <?php endif; ?>
                            </tr>

                            <tr>
                                <?php if ($metaArray['youtube_link'][0] ?? false): ?>
                                    <th>YouTube:</th>
                                    <td><?php echo faculty_get_social($metaArray, 'youtube');?></td>
                                <?php endif; ?>
                            </tr>

                            <tr>
                                <?php if ($metaArray['twitter_url'][0] ?? false): ?>
                                    <th>Twitter:</th>
                                    <td><?php echo faculty_get_social($metaArray, 'twitter');?></td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

        </div>
		
	</div>
</article>

