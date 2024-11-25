<?php get_header();
global $newspulse_options;

?>

<?php
if (have_posts()):
    while (have_posts()):
        the_post();
        ?>

        <section class="single_page">
            <div class="container">
                <div class="gredent_wrpp">
                    <div class="row g-0">
                        <div class="col-lg-7 col-md-7">
                            <div class="gredent_bg bg_color">
                                <div class="single_cat">
                                    <ul>
                                        <li><a href=""> <?php the_category(' , ') ?> </a></li>
                                    </ul>
                                </div><!--End Single_cat-->

                                <h2 class="single_page_title">
                                    <?php the_title(); ?>
                                </h2><!--End Single_Titel-->

                                <div class="repotar_wrpp">
                                    <div class="repotar_image">
                                        <?php echo get_avatar(get_the_author_meta('ID')); ?>
                                    </div>

                                    <div class="repotar_name">
                                        <?php echo get_the_author(); ?>
                                        <span>
                                            <?php echo $newspulse_options['repotar_roll_text'] ?>
                                        </span>
                                    </div>


                                </div>

                                <div class="single_social_item">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="single_time">
                                                <?php
                                                // date translate 
                                                echo newsplus_bangla_en_translate();
                                                ?>
                                            </div>
                                        </div><!--End col-6-->
                                        <div class="col-lg-8 col-md-8">

                                            <div class="addthis_inline_share_toolbox">
                                                <div class="post-share">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                                                        target="_blank" rel="noopener noreferrer" class="share-icon facebook"
                                                        title="Share on Facebook">
                                                        <i class="lab la-facebook-f"></i>
                                                    </a>
                                                    <a href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                                                        target="_blank" rel="noopener noreferrer" class="share-icon twitter"
                                                        title="Share on Twitter">
                                                        <i class="lab la-twitter"></i>
                                                    </a>
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>"
                                                        target="_blank" rel="noopener noreferrer" class="share-icon linkedin"
                                                        title="Share on LinkedIn">
                                                        <i class="lab la-linkedin-in"></i>
                                                    </a>
                                                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode(get_the_post_thumbnail_url()); ?>&description=<?php echo urlencode(get_the_title()); ?>"
                                                        target="_blank" rel="noopener noreferrer" class="share-icon pinterest"
                                                        title="Share on Pinterest">
                                                        <i class="lab la-pinterest-p"></i>
                                                    </a>
                                                    <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>"
                                                        class="share-icon email" title="Share via Email">
                                                        <i class="las la-envelope"></i>
                                                    </a>
                                                </div>


                                            </div>

                                        </div><!--End col-6 -->

                                    </div><!--End row-->
                                </div><!--End Single_social -->

                            </div><!--End gredent_bg-->

                        </div><!--End col-7-->

                        <div class="col-lg-5 col-md-5">
                            <div class="single_Page_image">
                                <?php if (has_post_thumbnail()): ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>"
                                            alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                                    <?php else: ?>
                                        <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>" alt="No image"
                                            title="No image available">
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div><!--End col-5-->


                    </div><!--End row -->
                </div><!--End Gredent_wrpp-->

                <div class="row">
                    <div class="col-lg-9 col-md-7">
                        <div class="single_details">

                            <?php
                            // Only display the button if enabled
                            if ($newspulse_options['enable_voice_button']):
                                ?>

                                <button id="playContent" onclick="playPostContent();" type="button" value="Play">
                                    <i id="playIcon" class="las la-volume-up"></i>
                                    <?php echo $newspulse_options['voice_button_text']; ?>
                                </button>


                            <?php endif; ?>

                            <div id="">
                                <?php the_content(); ?>
                            </div>

                            <div id="postContent" style="display: none;">
                                <?php the_content(); // The content to be read aloud ?>
                            </div>

                            <p class="mt-3">
                                <?php echo $newspulse_options['upload_news_author_title'] ?> <span
                                    class="fw-bold"><?php echo get_the_author(); ?></span>
                            </p>

                        </div>


                        <div class="row">
                            <div class="col-lg-9 col-md-9">
                                <div class="sharethis-inline-share-buttons"></div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <!-- <div class="single-social"
                            style="  background: #3b5998; width: 100%; padding: 10px; text-align: center; ">
                            <a href="https://themebazar.xyz/laratvsitescript/post/print/137" style="color:white;"
                                target="_blank"> প্রিন্ট করুন : <i class="las la-print"></i></a>
                        </div> -->

                            </div>

                        </div>


                        <?php
                        // Display comments section
                        if (comments_open() || get_comments_number()):
                            comments_template();
                        endif;
                        ?>

                        <?php
    endwhile;
endif;
?>

                <?php
                // Get categories of the current post
                $categories = get_the_category();
                if ($categories) {
                    $category_ids = array();

                    // Get category IDs
                    foreach ($categories as $category) {
                        $category_ids[] = $category->term_id;
                    }

                    // Query arguments for related posts
                    $related_args = array(
                        'category__in' => $category_ids, // Matches current post categories
                        'post__not_in' => array(get_the_ID()), // Exclude the current post
                        'posts_per_page' => 4, // Number of related posts to show
                        'ignore_sticky_posts' => 1
                    );

                    $related_query = new WP_Query($related_args);

                    // Check if related posts are available
                    if ($related_query->have_posts()): ?>
                        <div class="related_news mt-4">
                            <div class="related_cat">
                                <?php echo $newspulse_options['related_news_text'] ?>
                            </div>
                            <div class="row">
                                <?php while ($related_query->have_posts()):
                                    $related_query->the_post(); ?>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="related_wrpp">
                                            <div class="related_image">
                                                <?php if (has_post_thumbnail()): ?>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>"
                                                            alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                                                    <?php else: ?>
                                                        <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>"
                                                            alt="No image" title="No image available">
                                                    <?php endif; ?>
                                                </a>
                                            </div><!--End Related Image-->
                                            <div class="related_content">
                                                <div class="cat_time3">

                                                    <?php
                                                    // date translate 
                                                    echo newsplus_bangla_en_translate();
                                                    ?>


                                                </div>

                                                <h3 class="related_title">
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                                <div class="content_details">
                                                    <?php
                                                    // Display the first 10 words of the post content
                                                    echo wp_trim_words(get_the_content(), 10, '...');
                                                    ?>
                                                </div>
                                            </div><!--End Related_content-->

                                        </div><!--End Wrpp-->
                                    </div><!--End col-3-->
                                <?php endwhile; ?>
                            </div><!--End row-->
                        </div><!--End Related News-->

                        <?php
                    endif;
                    wp_reset_postdata();
                }
                ?>

            </div><!--End col-8-->

            <div class="col-lg-3 col-md-5">

                <?php get_sidebar() ?>

            </div><!--End col-4-->
        </div><!--End row-->




    </div><!--End container-->
</section><!--End section-->




<?php get_footer() ?>