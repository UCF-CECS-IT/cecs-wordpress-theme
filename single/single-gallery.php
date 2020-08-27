<?php the_post(); 

$images = get_field('gallery_images');

// print_r($images[0]);
?>
<div class="">

<div class="container pt-4 pt-sm-5 pb-2 pb-sm-4">
    <div class="row">
        <div class="col">
            <span class="lead">
                <?php the_content(); ?> 
            </span>
        </div>
    </div>

    <hr class="bg-primary">

    <div class="row">
        <?php foreach($images as $image): ?>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4" id="gallery-item-<?php echo $image['id']; ?>">
                <div class="card">
                    <div class="card-img-top rounded-top card-height-set-4">
                        <a data-toggle="modal" data-target="#galleryModal<?php echo $image['id']; ?>">
                            <img src="<?php echo $image['sizes']['medium']; ?>">
                        </a>

                        <div class="modal fade" id="galleryModal<?php echo $image['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="galleryModal<?php echo $image['id']; ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <!-- <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> -->
                                    <div class="modal-body p-0">
                                        <img class="img-fluid" src="<?php echo $image['url']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center bg-primary-lighter">
                        <a class="smaller text-secondary" href="<?php echo $image['url'];?>" download="<?php echo $image['filename'];?>">
                            <i class="fa fa-download"></i> Download High-Res
                        </a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>

</div>