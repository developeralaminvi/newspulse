<?php get_header() ?>

<section class="single_page">
    <div class="container">


        <div class="rachive-info-cats" bis_skin_checked="1">
            <a href="<?php echo home_url() ?>"><i class="las la-home"> </i> </a>
            <p><?php
            if (is_category()) {
                // Display category name
                single_cat_title('Category: ', true);
                the_archive_description('<div class="taxonomy-description mt-2">', '</div>');
            } elseif (is_tag()) {
                // Display tag name
                single_tag_title('Tag: ', true);
            } elseif (is_author()) {
                // Display author name
                echo 'Author: ' . get_the_author();
                the_archive_description('<div class="taxonomy-description mt-2">', '</div>');
            } elseif (is_day()) {
                // Display the archive for a specific day
                echo 'Archive for ' . get_the_date();
                the_archive_description('<div class="taxonomy-description mt-2">', '</div>');
            } elseif (is_month()) {
                // Display the archive for a specific month
                echo 'Archive for ' . get_the_date('F Y');
                the_archive_description('<div class="taxonomy-description mt-2">', '</div>');
            } elseif (is_year()) {
                // Display the archive for a specific year
                echo 'Archive for ' . get_the_date('Y');
                the_archive_description('<div class="taxonomy-description mt-2">', '</div>');
            } else {
                // Display a general archive label
                echo 'Archive';
            }
            ?></p>
        </div>

        <div class="row">
            <div class="col-lg-9 col-md-7">

                <div class="related_news">
                    <div class="row">

                        <?php


                        if (have_posts()):
                            while (have_posts()):
                                the_post(); ?>

                                <div class="col-lg-3 col-md-6">
                                    <div class="related_wrpp">

                                        <div class="related_image">

                                            <!-- Featured image (using the_post_thumbnail() for each post) -->

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

                                            <h3 class="related_title"><a href="<?php the_permalink(); ?>"
                                                    rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                                            </h3>
                                            <div class="post-excerpt">
                                                <?php
                                                // Display the first 10 words of the post content
                                                echo wp_trim_words(get_the_content(), 10, '...');
                                                ?>
                                            </div>
                                        </div><!--End Related_content-->

                                    </div><!--End Wrpp-->
                                </div><!--End col-3-->


                                <?php
                            endwhile;

                            // Display pagination with Bootstrap styles
                            ?>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <?php
                                    // Use paginate_links() to get pagination links
                                    $links = paginate_links(array(
                                        'total' => $wp_query->max_num_pages,
                                        'current' => max(1, get_query_var('paged')),
                                        'type' => 'array', // Return array of links
                                        'prev_text' => '<i class="las la-angle-left"></i>',
                                        'next_text' => '<i class="las la-angle-right"></i>',
                                    ));

                                    // Loop through each link to add Bootstrap classes
                                    if ($links):
                                        foreach ($links as $link):
                                            // Check for current page to add active class
                                            $active = strpos($link, 'current') !== false ? ' active' : '';
                                            echo '<li class="page-item' . $active . '">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
                                        endforeach;
                                    endif;
                                    ?>
                                </ul>
                            </nav>
                            <?php
                        else:
                            echo '<p>No posts found.</p>';
                        endif;

                        ?>



                    </div><!--End row-->

                </div><!--End Related News-->

                <div style="text-align: center; margin:20px; display:display: ruby;"> </div>


            </div><!--End col-8-->

            <div class="col-lg-3 col-md-5">

                <?php get_sidebar() ?>

            </div><!--End col-4-->
        </div><!--End row-->




    </div><!--End container-->
</section><!--End section-->

<?php get_footer() ?>