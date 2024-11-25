<?php get_header(); ?>

<section class="single_page">
    <div class="container">

        <div class="rachive-info-cats">
            <a href="<?php echo home_url(); ?>"><i class="las la-home"></i></a>
            <p>Search Results for: <?php echo get_search_query(); ?></p>
        </div>

        <div class="row">
            <div class="col-lg-9 col-md-7">

                <div class="related_news">
                    <div class="row">

                        <?php if (have_posts()): ?>
                            <?php while (have_posts()):
                                the_post(); ?>
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
                                        </div><!-- End Related Image -->

                                        <div class="related_content">
                                            <div class="cat_time3">
                                                <?php echo newsplus_bangla_en_translate(); // Make sure this function exists ?>
                                            </div>

                                            <h3 class="related_title">
                                                <a href="<?php the_permalink(); ?>"
                                                    rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                                            </h3>

                                            <div class="post-excerpt">
                                                <?php echo wp_trim_words(get_the_content(), 10, '...'); ?>
                                            </div>
                                        </div><!-- End Related Content -->

                                    </div><!-- End Wrapper -->
                                </div><!-- End col-3 -->
                            <?php endwhile; ?>

                            <!-- Pagination -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <?php
                                    $pagination_links = paginate_links(array(
                                        'total' => $wp_query->max_num_pages,
                                        'current' => max(1, get_query_var('paged')),
                                        'type' => 'array',
                                        'prev_text' => '<i class="las la-angle-left"></i>',
                                        'next_text' => '<i class="las la-angle-right"></i>',
                                    ));

                                    if ($pagination_links):
                                        foreach ($pagination_links as $link):
                                            $active_class = strpos($link, 'current') !== false ? ' active' : '';
                                            echo '<li class="page-item' . $active_class . '">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
                                        endforeach;
                                    endif;
                                    ?>
                                </ul>
                            </nav>

                        <?php else: ?>
                            <p>No posts found.</p>
                        <?php endif; ?>

                    </div><!-- End row -->
                </div><!-- End Related News -->

                <div style="text-align: center; margin:20px; display: ruby;"></div>

            </div><!-- End col-9 -->

            <?php include_once get_template_directory() . '/inc/arciveSidebar.php'; ?>

        </div><!-- End row -->

    </div><!-- End container -->
</section><!-- End section -->

<?php get_footer(); ?>