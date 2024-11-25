<?php get_header() ?>

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
                                        <li><a href=""> <?php the_category(',') ?> </a></li>
                                        <li><a href=""> </a></li>
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
                                        <span>ডিবিসি নিউজ</span>
                                    </div>


                                </div>

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
                    <div class="col-12">
                        <div class="single_details">

                            <?php the_content(); ?>

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


            </div><!--End col-8-->

        </div><!--End row-->




    </div><!--End container-->
</section><!--End section-->




<?php get_footer() ?>