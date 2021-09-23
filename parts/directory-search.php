<?php

?>

<div class="row mt-3 justify-content-center" id="faculty-alphabet-list">
    <?php faculty_alphabet_header(); ?>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-lg-3 mb-2">
        <a href="/directory" class="btn btn-primary btn-block text-transform-none <?php if ($post->post_name == 'directory') { echo 'btn-secondary disabled';} else {echo 'btn-primary'; } ?>">Full Directory</a>
    </div>

    <div class="col-lg-3 mb-2">
        <a href="/directory/department" class="btn btn-block text-transform-none <?php if ($post->post_name == 'department') { echo 'btn-secondary disabled';} else {echo 'btn-primary'; } ?>">By Department</a>
    </div>

    <div class="col-lg-3 mb-2">
        <a href="/directory/search" class="btn btn-primary btn-block text-transform-none <?php if ($post->post_name == 'search') { echo 'btn-secondary disabled';} else {echo 'btn-primary'; } ?>">Search</a>
    </div>
</div>

<!-- search -->
<?php if ($post->post_name == 'department'): ?>
    <form method="GET" action="">
        <div class="form-group row justify-content-center my-4 align-items-center">
            <label class="col-sm-1 col-form-label text-sm-right mt-2 pr-0">Search</label>
            <div class="col-sm-1 mt-2">
                <select class="form-control form-control-sm" name="filters[post_type]">
                    <option <?php cecs_staff_filter_selected('post_type', 'all'); ?> value="all">All</option>
                    <option <?php cecs_staff_filter_selected('post_type', 'faculty'); ?> value="faculty">Faculty</option>
                    <option <?php cecs_staff_filter_selected('post_type', 'person'); ?> value="person">Staff</option>
                </select>
            </div>

            <label for="staffSearch" class="col-sm-1 col-form-label text-sm-right mt-2 pr-0">Department</label>
            <div class="col-sm-4 mt-2">
                <select class="form-control form-control-sm" name="filters[department]">
                    <option <?php cecs_staff_filter_selected('department', 'all'); ?> value="all">All</option>
                    <option <?php cecs_staff_filter_selected('department', 'CE&CE'); ?> value="CE&CE">Civil, Environmental and Construction Engineering</option>
                    <option <?php cecs_staff_filter_selected('department', 'Computer Science'); ?> value="Computer Science">Computer Science</option>
                    <option <?php cecs_staff_filter_selected('department', 'Electrical & Computer Engineering'); ?> value="Electrical & Computer Engineering">Electrical & Computer Engineering</option>
                    <option <?php cecs_staff_filter_selected('department', 'Industrial Engineering & Management Systems'); ?> value="Industrial Engineering & Management Systems">Industrial Engineering & Management Systems</option>
                    <option <?php cecs_staff_filter_selected('department', 'Materials Science and Engineering'); ?> value="Materials Science and Engineering">Materials Science and Engineering</option>
                    <option <?php cecs_staff_filter_selected('department', 'Mechanical and Aerospace Engineering'); ?> value="Mechanical and Aerospace Engineering">Mechanical and Aerospace Engineering</option>
                </select>
            </div>

            <div class="col-sm-2 mt-2">
                <input type="submit" class="btn btn-sm btn-default" value="Search">
            </div>
        </div>
    </form>

<?php endif; ?>

<?php if ($post->post_name == 'directory'): ?>

<?php endif; ?>