<?php

/**
 * Testimonial Carousel Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'wfitness-carousel-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$className = 'testimonial-carousel';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if( $is_preview ) {
    $className .= ' is-admin';
}

?>
<div id="<?php echo esc_attr($id); ?>" class="bs-row wfitness-slick wfitness-carousel <?php echo esc_attr($className); ?>">
    <?php if( have_rows('testimonial_selection') ): ?>
		<div class="bs-col-xs-12 testimonial-carousel-items">
			<?php while( have_rows('testimonial_selection') ): the_row(); 
                    // Create variables for the fields
					$review_content = get_sub_field('review_content');
					$review_name = get_sub_field('review_name_author');
					
					// Image variables
					$review_image = get_sub_field('review_image');
					$review_image_size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)

				?>
                <div class="testimonial-carousel-item bs-flex bs-flex-direction-col">
						<?php if($review_content) { ?>
						<p class="review-content"><?php echo $review_content; ?></p>
						<?php } ?>
						<?php if($review_name) { ?>
						<p class="review-name"><?php echo $review_name; ?></p>
						<?php } ?>
						<div class="review-img"><?php if( $review_image ) {
						echo wp_get_attachment_image( $review_image, $review_image_size );
							}?>
						</div>
                </div>
			<?php endwhile; ?>
		</div>
	<?php else: ?>
		<p>Please add a testimonial.</p>
	<?php endif; ?>
</div>