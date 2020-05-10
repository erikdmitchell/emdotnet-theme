<?php
/**
 * Template Name: Plugins
 */
?>
<?php get_header(); ?>

<div class="page-header">
    <div class="em-container">
        <div class="em-row">
            <div class="em-col">
                <h1 class="page-title">Plugins</h1>
            </div>
        </div>
    </div>
</div>

<div class="em-container">
    <div class="em-row">
        <div class="em-col">
            <?php display_plugins(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
