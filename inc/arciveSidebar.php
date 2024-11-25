<?php
// Query arguments for the latest news posts
$latest_news_args = array(
    'post_type' => 'post', // Only get posts from the 'post' post type
    'posts_per_page' => 9, // Number of latest posts to display
    'orderby' => 'date', // Order by date
    'order' => 'DESC' // Show the most recent posts first
);

$latest_news_query = new WP_Query($latest_news_args);

// Check if there are posts available
if ($latest_news_query->have_posts()): ?>

    <div class="col-lg-3 col-md-5">
        <div class="sitebar-fixd" style="position: sticky; top: 0;"><!-- Fixed Sidebar -->

            <div class="archivePopular">
                <ul class="nav nav-pills" id="archivePopular-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <div class="nav-link active" data-bs-toggle="pill" data-bs-target="#archiveTab_recent" role="tab"
                            aria-controls="archiveRecent" aria-selected="true"> সর্বশেষ সংবাদ </div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link" data-bs-toggle="pill" data-bs-target="#archiveTab_popular" role="tab"
                            aria-controls="archivePopulars" aria-selected="false"> আলোচিত সংবাদ </div>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="pills-tabContentarchive">
                <!-- Latest News Tab Content -->
                <div class="tab-pane active show fade" id="archiveTab_recent" role="tabpanel"
                    aria-labelledby="archiveRecent">
                    <div class="archiveTab-sibearNews">
                        <?php
                        $count = 1;
                        while ($latest_news_query->have_posts()):
                            $latest_news_query->the_post(); ?>
                            <div class="archive-tabWrpp archiveTab-border">
                                <div class="archiveTab-image">
                                    <?php if (has_post_thumbnail()): ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>"
                                                alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                                        <?php else: ?>
                                            <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>"
                                                alt="No image" title="No image available">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <h4 class="archiveTab_hadding"><a href="<?php the_permalink(); ?>"
                                        title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                                <div class="archive-conut">
                                    <?php
                                    $selected_language = get_option('newspulse_options')['language_select'] ?? 'bn';
                                    if ($selected_language == 'bn') {

                                        echo convert_to_bangla($count);

                                    } else {

                                        echo $count;

                                    }

                                    ?>
                                </div>
                            </div>
                            <?php $count++; endwhile; ?>
                    </div>
                </div>

                <?php
                // Reset query data before querying most commented posts
                wp_reset_postdata();

                // Query arguments for most commented posts
                $most_commented_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 9,
                    'orderby' => 'comment_count',
                    'order' => 'DESC'
                );

                $most_commented_query = new WP_Query($most_commented_args);

                if ($most_commented_query->have_posts()): ?>
                    <div class="tab-pane fade" id="archiveTab_popular" role="tabpanel" aria-labelledby="archivePopulars">
                        <div class="archiveTab-sibearNews">
                            <?php
                            $count = 1;
                            while ($most_commented_query->have_posts()):
                                $most_commented_query->the_post(); ?>
                                <div class="archive-tabWrpp archiveTab-border">
                                    <div class="archiveTab-image">
                                        <?php if (has_post_thumbnail()): ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>"
                                                    alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                                            </a>
                                        <?php else: ?>
                                            <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>" alt="No image"
                                                title="No image available">
                                        <?php endif; ?>
                                    </div>
                                    <h4 class="archiveTab_hadding"><a href="<?php the_permalink(); ?>"
                                            title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                                    <div class="archive-conut">
                                        <?php
                                        $selected_language = get_option('newspulse_options')['language_select'] ?? 'bn';
                                        if ($selected_language == 'bn') {

                                            echo convert_to_bangla($count);

                                        } else {

                                            echo $count;

                                        }

                                        ?>
                                    </div>
                                </div>
                                <?php $count++; endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div><!-- Fixed Sidebar End -->
    </div><!-- End col-4 -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>