<?php
$purchased_courses = $args['purchased_courses'];
?>
<div class="tpw-container mx-auto px-4 py-8">
    <h2 class="tpw-text-2xl tpw-font-bold mb-6">Your Purchased Courses</h2>

    <div class="tpw-grid tpw-grid-cols-1 sm:tpw-grid-cols-2 lg:tpw-grid-cols-3 gap-6">
        <?php foreach ( $purchased_courses as $course ) {
            $thumbnail_url = get_the_post_thumbnail_url($course);
            $thumbnail_alt = get_post_meta ( get_post_thumbnail_id($course), '_wp_attachment_image_alt', true )
        ?>

            <div class="tpw-bg-white tpw-shadow-md tpw-rounded-lg tpw-overflow-hidden">
                <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $thumbnail_alt; ?>" class="tpw-w-full tpw-h-48 tpw-object-cover">
                <div class="tpw-p-4">
                    <h3 class="tpw-text-xl tpw-font-semibold mb-2"><?php echo __( get_the_title($course), TEXTDOMAIN ); ?></h3>
                    <a href="<?php echo get_permalink($course); ?>" class="tpw-text-blue-500 tpw-hover:underline">View Course</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>