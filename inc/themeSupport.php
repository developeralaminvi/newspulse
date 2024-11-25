<?php
// Register a primary menu for the theme

if (!function_exists('newspulse_register_menus')) {
    function newspulse_register_menus()
    {
        register_nav_menu('primary-menu', __('Primary Menu', 'newspulse'));
        register_nav_menu('side_menu', __('Side Menu', 'newspulse'));
        register_nav_menu('footer-menu', __('Footer Menu', 'newspulse'));
    }

    // Enable support for post thumbnails (featured images)
    add_theme_support('post-thumbnails');

    // Enable support for dynamic title tag
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'newspulse_register_menus');


// Add custom icon class field to menu items in the WordPress admin
function newspulse_menu_icon_custom_field($item_id, $item, $depth, $args)
{
    $icon_class = get_post_meta($item_id, '_menu_item_icon_class', true);
    ?>
    <p class="field-icon-class description description-wide">
        <label for="edit-menu-item-icon-class-<?php echo esc_attr($item_id); ?>">
            <?php _e('Menu Icon (Line Awesome Class)', 'newspulse'); ?><br>
            <input type="text" id="edit-menu-item-icon-class-<?php echo esc_attr($item_id); ?>"
                class="widefat edit-menu-item-icon-class" name="menu-item-icon-class[<?php echo esc_attr($item_id); ?>]"
                value="<?php echo esc_attr($icon_class); ?>">
            <span
                class="description"><?php _e('Enter a Line Awesome icon class (e.g., las la-home)', 'newspulse'); ?></span>
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'newspulse_menu_icon_custom_field', 10, 4);

function newspulse_save_menu_icon_custom_field($menu_id, $menu_item_db_id)
{
    if (isset($_POST['menu-item-icon-class'][$menu_item_db_id])) {
        $icon_class = sanitize_text_field($_POST['menu-item-icon-class'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_icon_class', $icon_class);
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_icon_class');
    }
}
add_action('wp_update_nav_menu_item', 'newspulse_save_menu_icon_custom_field', 10, 2);


// Custom walker to display Line Awesome icons directly within menu links
class Newspulse_Menu_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        // Add specific classes for items with children
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'has-sub';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li id="menu-item-' . esc_attr($item->ID) . '"' . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';

        // Retrieve icon class from menu item meta
        $icon_class = get_post_meta($item->ID, '_menu_item_icon_class', true);

        // Build menu item link with icon if provided
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';

        // Add icon if the icon class is defined
        if (!empty($icon_class)) {
            $item_output .= '<i class="' . esc_attr($icon_class) . '"></i> ';
        }

        // Add menu item title
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        // Add dropdown toggle icon if the item has children
        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= '<a class="dd-toggle" href="#"><span class="icon-plus"></span></a>';
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// Fallback function for the main menu
function newspulse_main_menu_fallback()
{
    // Display the message with a link to the menu settings page
    echo '<ul>';
    echo '<li><a href="' . admin_url('nav-menus.php') . '" target="_blank">Add main menu to Primary menu location</a></li>';
    echo '</ul>';
}

// Side_Menu_Walker
class Side_Menu_Walker extends Walker_Nav_Menu
{

    // Start Level (for submenus)
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $class = ($depth > 0) ? ' class="submenu"' : '';
        $output .= "\n<ul$class>\n";
    }

    // Start Element (for menu items)
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Check for Line Awesome icon
        $icon_class = get_post_meta($item->ID, '_menu_item_icon', true);
        $icon_html = $icon_class ? '<i class="la ' . esc_attr($icon_class) . '"></i> ' : '';

        $classes = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $classes = $classes ? ' class="' . esc_attr($classes) . '"' : '';

        // Generate the menu item output with the icon
        $output .= '<li' . $classes . '>';
        $output .= '<a href="' . esc_url($item->url) . '">' . $icon_html . apply_filters('the_title', $item->title, $item->ID) . '</a>';
    }

    // End Element (for menu items)
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}


// Fallback function for the side menu
function newspulse_side_menu_fallback()
{
    // Display the message with a link to the menu settings page
    echo '<ul>';
    echo '<li><a href="' . admin_url('nav-menus.php') . '" target="_blank">Add side menu to side menu location</a></li>';
    echo '</ul>';
}


// Function to get post thumbnail URL or default image URL
function blog_default_image($size = 'full') {
    if (has_post_thumbnail()) {
        return get_the_post_thumbnail_url(null, $size);
    } else {
        $default_image = get_option('newspulse_options')['default_image']['url'] ?? get_template_directory_uri() . '/public/frontend/assets/images/WP BIG PRO.png';
        return $default_image;
    }
}
