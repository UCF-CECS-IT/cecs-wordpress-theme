<li class="list-group-item flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
        <span class="font-weight-bold small"><?php the_field('news_outlet');?></span>
        <span class="font-weight-bold small"><?php the_time('F d, Y');?></span>
    </div>
    <a class="smaller align-self-stretch" href="<?php the_field('link');?>" target="_blank"><?php the_field('headline');?></a>
    <p class="font-italic smaller pb-0 mb-0"><?php the_field('author_name');?></p>
</li>