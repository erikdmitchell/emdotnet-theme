<?php
/**
 * Template Name: Plugins
 */
?>
<?php get_header(); ?>

<div class="container-fluid page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title">Plugins</h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php display_plugins(); ?>
        </div>
    </div>
</div><!-- .container -->

<?php get_footer(); ?>
