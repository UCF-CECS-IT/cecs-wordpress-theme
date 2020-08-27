<?php 
get_header(); 
global $wp_query;
?>

<div class="container mt-4 mb-5 pb-sm-4">
    <div class="row" id="content">
        <div class="col-lg-9 col-md-12">
            <form role="search" method="get" action="/">
                <div class="form-group">
                    <label for="search" class="form-label font-weight-bold">Search For:</label>
                    <div class="input-group">
                        <input id="search" class="form-control" placeholder="Search …" name="s">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-success">Search</button>
                        </span>
                    </div>
                </div>
            </form>
            <?php if ( have_posts() && $wp_query->query['s'] !== "" ): ?>
                <div class="row">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-lg-4 col-md-6 mb-4">	
                            <article class="<?php echo $post->post_status; ?> post-list-item mb-4 h-100"  id="post-<?php the_ID(); ?>">
                                <div class="card h-100">
                                    <div class="card-img-top card-height-set-4">
                                        <a class="h-100" href="<?php the_permalink(); ?>">   
                                            <img class="img-fluid position-relative" src="<?php news_get_thumbnail(get_the_ID(), 'sm'); ?>">
                                            <?if (get_post_type() == 'post'): ?>
                                                <span class="badge badge-primary position-absolute position-top-right">
                                                    <?php news_get_badge_tag(); ?>
                                                </span>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="card-block text-secondary pb-0">
                                        <a class="remove-pointer" href="<?php the_permalink(); ?>">  
                                            <p class="font-weight-bold text-secondary"><?php the_title(); ?></p>
                                        </a>

                                        <a class="remove-pointer" href="<?php the_permalink(); ?>"> 
                                            <p class="text-primary mb-0 pb-0">Read More <span class="fa fa-angle-double-right" aria-hidden="true"></span></p>
                                        </a>
                                    </div>
                                    <div class="card-footer bg-secondary">
                                        <span class="date text-muted small text-uppercase letter-spacing-3"><?php the_time( 'F j, Y' ); ?></span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="row justify-content-center">
                    <?php ucfwp_the_posts_pagination(); ?>
                </div>
            <?php else: ?>
                <p>No results found.</p>
            <?php endif; ?>
        </div>
        <div class="col-lg-3 col-md-12">
            <?php get_template_part('parts/sidebar', 'news'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>