<?php
$options = get_option('newspulse_options');
$logo_url = isset($options['header_logo']['url']) ? $options['header_logo']['url'] : '';
$header_bg_color = isset($options['header_bg_color']) ? $options['header_bg_color'] : '';
?>

<!DOCTYPE html>
<html lang="<?php language_attributes() ?>">

<head>
    <meta charset="<?php bloginfo('charset') ?> " class="no-js">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('-', true, 'right');
    bloginfo('name'); ?></title>
    <?php wp_head() ?>
</head>



<body <?php body_class() ?>>


    <!--========WPBigPro===============
       WPBigPro Header Section Start
    ============WPBigPro==============-->

    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="date">
                        <?php newsplus_bangla_date(); ?>
                    </div><!--End Date-->
                </div><!--End col-3-->

                <div class="col-lg-6 col-md-6">
                    <div class="logo">
                        <?php if (!empty($logo_url)) {

                            ?>
                            <a href="<?php echo home_url() ?>"> <img src="<?php echo $logo_url; ?>"
                                    alt=" <?php echo bloginfo() ?> " title="LOGO"> </a>
                            <?php
                        } else {
                            ?>
                            <a href="<?php echo home_url() ?>"> <img src="<?php echo blog_default_image(); ?>"
                                    alt="No image" title="No image available"> </a>
                            <?php
                        }

                        ?>

                    </div><!--End Logo-->
                </div><!--End col-3-->

                <div class="col-lg-3 col-md-3">

                    <div class="mobile_logo">
                        <?php if (!empty($logo_url)) {

                            ?>
                            <a href="<?php echo home_url() ?>"> <img src="<?php echo $logo_url; ?>"
                                    alt=" <?php echo bloginfo() ?> " title="LOGO"> </a>
                            <?php
                        } else {
                            ?>
                            <a href="<?php echo home_url() ?>"> <img src="<?php echo blog_default_image(); ?>"
                                    alt="No image" title="No image available"> </a>
                            <?php
                        }

                        ?>

                    </div><!--End Mobile Logo-->

                    <!-- search start -->
                    <div class="header_click">
                        <ul>
                            <?php if (get_option('newspulse_options')['live_tv_enable']): ?>
                                <li class="tvBnt">
                                    <a
                                        href="<?php echo esc_url(get_option('newspulse_options')['live_tv_link'] ?? '#'); ?>">
                                        <i
                                            class="<?php echo esc_attr(get_option('newspulse_options')['live_tv_icon'] ?? 'las la-tv'); ?>"></i>
                                        <?php echo esc_html(get_option('newspulse_options')['live_tv_text'] ?? 'লাইভ'); ?>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <li class="searchIcon"> <i class="las la-search"></i> </li>
                            <li class="click-icon"> <i class="las la-indent"></i> </li>
                        </ul>
                    </div><!--End Header Click Iocn-->

                    <?php get_search_form() ?>

                </div><!--End col-3-->

            </div><!--End row-->
        </div><!--End container -->
    </header><!--End Header -->


    <div class="header-menu">
        <div class="clickMenu_item">
            <div class="close-icons">
                <?php if (!empty($logo_url)) {

                    ?>
                    <a href="<?php echo home_url() ?>"> <img src="<?php echo $logo_url; ?>" alt=" <?php echo bloginfo() ?> "
                            title="LOGO"> </a>
                    <?php
                } else {
                    ?>
                    <a href="<?php echo home_url() ?>"> <img src="<?php echo blog_default_image(); ?>" alt="No image"
                            title="No image available"> </a>
                    <?php
                }

                ?>

                <i class="las la-times"></i>
            </div><!--End Close Icon-->

            <div class="click-menu">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'side_menu',
                    'walker' => new Side_Menu_Walker(),
                    'fallback_cb' => 'newspulse_side_menu_fallback',
                ));

                ?>

            </div><!--End Click Menu-->
        </div><!--End ClickMenu Item-->
    </div><!--End Right Sitebar Menu-->

    <!--==========WPBigPro=============
        WPBigPro Header Section End
     ==============WPBigPro============-->

    <!--=========WPBigPro==============
            Menu-section-Start
    =============WPBigPro=============-->

    <section class="menu-section" id="themeMenu">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="mobile_logo">
                        <?php if (!empty($logo_url)) {

                            ?>
                            <a href="<?php echo home_url() ?>"> <img src="<?php echo $logo_url; ?>"
                                    alt=" <?php echo bloginfo() ?> " title="LOGO">
                            </a>
                            <?php
                        } else {
                            ?>
                            <a href="<?php echo home_url() ?>"> <img src="<?php echo blog_default_image(); ?>"
                                    alt="No image" title="No image available"> </a>
                            <?php
                        }

                        ?>
                    </div><!--End Mobile Logo-->

                    <div class="stellarnav">

                        <?php
                        // Use the custom walker when displaying the menu
                        wp_nav_menu(array(
                            'theme_location' => 'primary-menu',
                            'container' => false,
                            'walker' => new Newspulse_Menu_Walker(),
                            'fallback_cb' => 'newspulse_main_menu_fallback',
                        ));
                        ?>

                    </div><!--End Stellarnav Menu -->

                </div><!--End col--->
            </div><!--End row-->
        </div><!--End container -->
    </section><!--End Section -->


    <!--=========WPBigPro==============
              Menu-section-End
    =============WPBigPro=============-->