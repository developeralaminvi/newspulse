<?php
/**
 * The template for displaying comments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package msbdtcp
 */

if (post_password_required()) {
    return;
}
?>


<div id="comments" class="comments-area my-4">
    <?php
    if (have_comments()):
        $msbdtcp_comment_count = get_comments_number();
        $comments_title = ($msbdtcp_comment_count > 1) ? "{$msbdtcp_comment_count} Comments" : "Very first comment";
        ?>
        <div class="title-wrap">
            <h3 class="comments-title"><?php echo $comments_title; ?></h3>
        </div>
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 80,
                'max_depth' => 3,
                'walker' => new MSBDTCP_Walker_Comment
            ));
            ?>
        </ol>
        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()):
            ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'msbdtcp'); ?></p>
            <?php
        endif;
    endif; // Check for have_comments().
    
    $commenter = wp_get_current_commenter();
    $html_req = " required='required'";
    $custom_fields = array(
        'author' => '<div class="form-row mb-3 comment-input-wrap"><div class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" placeholder="' . __("Name", "msbdtcp") . '" class="form-control"' . $html_req . '></div>',

        'email' => '<div class="comment-form-email mt-3"><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" placeholder="' . __("Email", "msbdtcp") . '" class="form-control"' . $html_req . '></div>',

        
    );

    $args = array(
        'fields' => $custom_fields,

        'comment_field' => '<div class="form-row mb-3"><div class="col comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control" placeholder="' . __("Comment", "msbdtcp") . '"></textarea></div></div>',

        'class_submit' => 'submit btn btn-primary'
    );
    comment_form($args);
    ?>
</div>