<?php
// Fetch the current page number
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
// Query arguments for the latest news posts
$latest_news_args = array(
    'post_type' => 'post', // Only get posts from the 'post' post type
    'posts_per_page' => 7, // Number of latest posts to display
    'orderby' => 'date', // Order by date
    'order' => 'DESC', // Show the most recent posts first
    'paged' => $paged, // Current page number
);

$latest_news_query = new WP_Query($latest_news_args);

// Check if there are posts available
if ($latest_news_query->have_posts()): ?>

    <div class="latest_wrpp to-position">
        <h2 class="cat_title">
            <span> সর্বশেষ সংবাদ </span>
            <span2> <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>"> আরো খবর <i
                        class="las la-arrow-right"></i> </a> </span2>
        </h2>
        <?php while ($latest_news_query->have_posts()):
            $latest_news_query->the_post(); ?>
            <div class="latest_item">
                <div class="latest_image">
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php the_permalink(); ?>">
                            <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
                                title="<?php the_title(); ?>">
                        <?php else: ?>
                            <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>" alt="No image"
                                title="No image available">
                        <?php endif; ?>
                    </a>
                </div><!--End secOne Image-->

                <div class="latest_content">
                    <h2 class="latest_title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>

                    <div class="cat_time2">
                        <?php
                        // date translate 
                        echo newsplus_bangla_en_translate();
                        ?>
                    </div>
                </div><!--End secOne content-->

            </div><!--End Latest content-->

        <?php endwhile; ?>

        <h4 class="lates_more">
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>"> আরো খবর </a>
        </h4>

    </div><!--End wrpp-->

    <?php
endif;
wp_reset_postdata();