<?php
// Access Redux global options variable
global $newspulse_options;
?>

<form class="searchBar" method="get" action="<?php echo home_url('/'); ?>">
    <input name="s" type="text"
        placeholder="<?php echo esc_attr(isset($newspulse_options['search_form_placeholder']) ? $newspulse_options['search_form_placeholder'] : 'এখানে লিখুন'); ?>"
        required aria-label="Search input">
    <button
        type="submit"><?php echo esc_html(isset($newspulse_options['search_button_text']) ? $newspulse_options['search_button_text'] : 'খুজুন'); ?></button>

    <div class="remove" role="button" aria-label="Clear search">
        <i class="las la-times"></i>
    </div>
</form>
