<?php

// Pull last five news articles
$latest = news_get_recent(5);


?>
<div class="card mb-3 recent-news-item">
    <h4 class="card-header bg-primary">Recent News</h4>
    <div class="list-group-flush">
        <?php if($latest->have_posts()): ?>
            <?php while($latest->have_posts()): $latest->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action bg-primary-lightest smaller"><?php the_title(); ?></a>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<div class="card mb-3 recent-news-item">
    <h4 class="card-header bg-info">Archives</h4>
    <?php wp_get_archives(array('type' => 'monthly', 'limit' => 12, 'show_post_count' => true, 'format' => 'custom', 'before' => '<li class="list-group-item">', 'after' => '</li>')); ?>
</div>