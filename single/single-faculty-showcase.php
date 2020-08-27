<?php the_post();  ?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-2 pb-sm-4">
        
        <!-- Top card -->
        <div class="card mb-4">
            <div class="row no-gutters">
                <div class="col-lg-4">
                    <img class="w-100" src="<?php echo showcase_get_photo(); ?>" alt="<?php the_title();?>">
                </div>
                <div class="col-lg-8">
                    <?php if(get_field('info_card_text')):?>
                        <div class="bg-metallic-lightest p-3 pl-4">
                            <h5 class="m-0"><?php the_field('info_card_text');?></h5>
                        </div>
                    <?php endif;?>
                    <div class="p-3 pl-4">
                        <h4 class="text-primary-aw">
                            <?php the_title();?>
                            <small class="text-muted d-inline-block"><?php the_field('sub_heading', false, false);?></small>
                        </h4>

                        <div class="row">
                            <?php if( have_rows('icon_line') ): ?>
                                <?php while ( have_rows('icon_line') ) : the_row(); ?>
                                    <div class="col-md-6 col-sm-12 mb-2">
                                        <i class="fa <?php the_sub_field('icon');?> text-primary-aw mr-2"></i>

                                        <?php if(get_sub_field('link')) : ?>
                                            <a href="<?php the_sub_field('link');?>" target="_blank">
                                                <?php the_sub_field('text');?>
                                            </a>

                                        <?php else : ?>
                                            <span><?php the_sub_field('text');?></span>
                                        <?php endif;?>
                                    </div>
                                <?php endwhile;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About card -->
        <div class="card mb-4 px-4">
            <div class="p-3">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <span class="font-weight-light"><?php the_field('bar_text'); ?></span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <blockquote class="blockquote blockquote-reverse blockquote-quotation smaller mb-0">
                            <p class="mb-0"><?php the_field('bar_quote'); ?></p>
                        </blockquote>
                    </div>
                </div>
            </div>                                                
        </div>

        <!-- Repeater for article cards -->
        <?php if( have_rows('article') ): ?>
            <div class="card-columns format-column">              
                <?php while ( have_rows('article') ) : the_row(); ?>
                    <div class="card mb-3">
                        <?php if(get_sub_field('title')):?>
                            <h4 class="card-header bg-primary"><?php the_sub_field('title');?></h4>
                        <?php endif;?>

                        <!-- Optional image section -->
                        <?php if(get_sub_field('thumbnail_image')):?>
                            <div class="card-img-top">
                                <img class="img-fluid" src="<?php the_sub_field('thumbnail_image'); ?>">
                            </div>
                        <?php endif;?>

                        <!-- Optional video embed -->
                        <?php if(get_sub_field('video_embed')): ?>
                            <?php if(showcase_get_video_info(get_sub_field('video_embed'))->type == 'youtube'): ?>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo showcase_get_video_info(get_sub_field('video_embed'))->id ?>" allowfullscreen></iframe>
                                </div>
                            <?php elseif(showcase_get_video_info(get_sub_field('video_embed'))->type == 'vimeo'): ?>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/<?php echo showcase_get_video_info(get_sub_field('video_embed'))->id ?>" allowfullscreen></iframe>
                                </div>
                            <?php else : ?>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="<?php the_sub_field('video_embed');?>" allowfullscreen></iframe>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Card body content -->
                        <?php if(get_sub_field('content')):?>
                            <div class="card-block smaller">
                                <?php the_sub_field('content');?>
                            </div>
                        <?php endif;?>

                        <!-- Optional button -->
                        <?php if(get_sub_field('button_text')):?>
                            <a class="btn btn-default btn-block" href="<?php the_sub_field('button_url');?>">
                                <?php the_sub_field('button_text');?>
                            </a>
                        <?php endif;?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif;?>

        <!-- Repeater for slides -->
        <?php if( have_rows('single_slide') ): ?>
            
            <div id="showcaseCarousel" class="carousel slide" data-ride="carousel" data-interval="6000">
                <?php if (count(get_field('single_slide')) > 1):?>
                    <ol class="carousel-indicators">
                        <li data-target="#showcaseCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#showcaseCarousel" data-slide-to="1"></li>
                        <li data-target="#showcaseCarousel" data-slide-to="2"></li>
                    </ol>
                <?php endif; ?>
                <div class="carousel-inner">
                    <?php while ( have_rows('single_slide') ) : the_row(); ?>
                        <div class="carousel-item <?php if (get_row_index() == 1) echo 'active'; ?>">
                            <img src="<?php echo get_sub_field('slide_image');?>" class="d-block w-100">
                            <?php if (get_sub_field('overlay_content')) : ?>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?php the_sub_field('overlay_content');?></h5>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile;?>
                </div>
                <?php if (count(get_field('single_slide')) > 1):?>
                    <a class="carousel-control-prev" href="#showcaseCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#showcaseCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
	</div>
</article>