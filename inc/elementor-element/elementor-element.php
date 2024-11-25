<?php
namespace NPWidgetsElementor;

/**
 * Class ElementorAddonsMain
 *
 * Main Plugin class
 * @since 1.2.0
 */
class ElementorAddonsMain
{

    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * widget_style
     *
     * Load main style files.
     *
     * @since 1.0.0
     * @access public
     */

    public function widget_styles()
    {
        // Register and enqueue styles
        // wp_enqueue_style('treavel-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', array(), '5.2.3');
    }

    public function widget_scripts()
    {
        // // Register and enqueue Owl Carousel JS and Bootstrap JS
        // wp_enqueue_script('jquery'); // Ensure jQuery is loaded
        // wp_enqueue_script('treavel-bootstrap-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js', array('jquery'), '2.11.6', true);
    }




    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets()
    {
        require_once(__DIR__ . '/NP_Post.php');
        require_once(__DIR__ . '/NP_Post_list_1.php');
        require_once(__DIR__ . '/NP_Post_list_2.php');
        require_once(__DIR__ . '/NP_post_title.php');
        require_once(__DIR__ . '/NP_Post_list_3.php');
        require_once(__DIR__ . '/NP_Post_grid_2.php');
        require_once(__DIR__ . '/NP_Post_list_4.php');
        require_once(__DIR__ . '/NP_latest_post.php');



        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Newspulse_Posts_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Newspulse_Posts_list_1_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Newspulse_Posts_list_2_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Newspulse_Post_Title_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Newspulse_Posts_list_3_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Newspulse_Posts_Grid_2_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Newspulse_Posts_list_4_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Newspulse_Latest_post_Widget());


    }
    public function add_elementor_widget_categories($elements_manager)
    {

        $elements_manager->add_category(
            'newspulse_category',
            [
                'title' => __('Newspulse Element', 'newspulse'),

            ]
        );

    }
    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct()
    {

        // Register widget style
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'widget_styles']);

        // Register widget style
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'widget_scripts']);

        // Register widgets
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);

        //Register Widget Category
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);

    }
}

// Instantiate Plugin Class
ElementorAddonsMain::instance();
