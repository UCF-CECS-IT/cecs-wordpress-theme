<div class="card mb-3">
    <h4 class="card-header bg-primary">In The News</h4>
    <ul class="list-group list-group-flush">
        <?php news_block(5); ?>
        <li class="list-group-item justify-content-center">
            <a href="/in-the-news" class="btn btn-sm btn-primary">Read More</a>
        </li>
    </ul>
</div>

<div class="card mb-3">
    <h4 class="card-header bg-info">Events</h4>
    <ul class="list-group list-group-flush">
        <?php foreach(cecs_get_events() as $event): ?>
            <li class="list-group-item flex-column align-items-start">
                <div>
                    <span class="smaller font-weight-bold"><?php echo date('F d, Y', strtotime($event->starts)); ?></span>
                </div>
                <div class="align-self-stretch">
                    <a class="smaller" href="<?php echo $event->url; ?>"><?php echo $event->title; ?></a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="card-block text-center">
        <a href="https://events.ucf.edu/calendar/1900/college-of-engineering-and-computer-science/" class="btn btn-info btn-sm">View Calendar</a>
    </div>
</div>