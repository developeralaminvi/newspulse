<?php
// 404.php template for displaying a custom error page when a page is not found
get_header(); ?>

<style>
    .error-404 {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-color: #f7f7f7;
        text-align: center;
        padding: 20px;
    }

    .error-404 h1 {
        font-size: 6rem;
        color: #bb1c1c;
        /* Primary color */
        font-weight: bold;
    }

    .error-404 p {
        font-size: 1.25rem;
        color: #666;
        padding: 31px 0;
        line-height: 30px;
    }

    .error-404 a {
        color: #fff;
        background-color: #bb1c1c;
        /* Primary color */
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }

    .error-404 a:hover {
        background-color: #a11b1b;
    }
</style>

<div class="error-404">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>404</h1>
                <p>Oops! The page you are looking for doesn't exist or has been moved.</p>
                <a href="<?php echo home_url(); ?>" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>