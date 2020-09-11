<?php 

get_header();

get_template_part( 'parts/directory', 'search' );

$staff = cecs_get_all_staff( cecs_get_staff_filter() );
$alphabetized = cecs_alphabetize_staff( $staff );

?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-2 mb-5 pb-sm-4">
		<div class="row justify-content-end">
			<div class="col-lg-3 col-md-4">
				<div class="form-group row align-items-center">
					<label for="staffSearch" class="col-sm-4 col-form-label pr-0">Search</label>
					<div class="col-sm-8">
						<input type="text" id="staffSearch" name="staffSearch" class="form-control form-control-sm">
					</div>
				</div>
			</div>
		</div>

		<table class="table table-sm small table-hover table-responsive">
			<thead>
				<tr class="bg-primary">
					<th>Name</th>
					<th>Department</th>
					<th>Title</th>
					<th>Phone</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $alphabetized as $post): ?>
					<?php if ($post->post_type == 'faculty'): ?>
						<?php
							$metaArray = get_metadata( 'post', $post->ID );
							$positionArray = faculty_get_positions( $metaArray );
							$title = ($metaArray['featured_position'][0] ?? false) ?: faculty_get_display_title($positionArray);
						?>
						<tr>
							<td><a href="<?php echo get_permalink($post->ID); ?>"><?php echo faculty_get_display_name($metaArray); ?></a></td>
							<td><?php echo $metaArray['department'][0] ?? ''; ?></td>
							<td><?php echo $title; ?></td>
							<td><?php echo $metaArray['phone'][0] ?? false;?></td>
							<td><a href="mailto:<?php echo $metaArray['email'][0]; ?>">Email</a></td>
						</tr>

					<?php else: ?>
						<tr>
							<td><?php echo ucfwp_get_person_name( $post ); ?></td>
							<td>Staff</td>
							<td><?php if ( $job_title = get_field( 'person_jobtitle', $post->ID ) ) { echo $job_title; } ?></td>
							<td><?php if ( $phone = get_field( 'person_phone', $post->ID ) ) { echo $phone; } ?></td>
							<td><?php if ( $email = get_field( 'person_email', $post->ID ) ) { echo "<a href=\"mailto:$email\">Email</a>"; } ?></td>
						</tr>
					<?php endif; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</article>

<?php get_footer(); ?>
