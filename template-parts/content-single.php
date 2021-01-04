<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php emdotnet_theme_post_thumbnail( 'blog-single' ); ?>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

        <div class="entry-meta">
            <?php
            if ( 'post' == get_post_type() ) {
                emdotnet_theme_posted_on();
            }

            if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
                ?>
                    <span class="comments-link"></span><?php comments_popup_link( __( 'Leave a comment', 'emdotnet' ), __( '1 Comment', 'emdotnet' ), __( '% Comments', 'emdotnet' ) ); ?></span>
                <?php
                endif;

                edit_post_link( __( 'Edit', 'emdotnet' ), '<span class="edit-link">', '</span>' );
            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
            the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'emdotnet' ) );
            wp_link_pages(
                array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'emdotnet' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                )
            );
            ?>
    </div><!-- .entry-content -->

    <div class="entry-meta">
        <?php if ( has_tag() ) : ?>
            <div class="tags-list">
                <div class="tags-title">Tags</div>
                
                <?php the_tags( '<div class="tag-links">', ' ', '</div>' ); ?>
            </div>
        <?php endif; ?>
        <?php if ( emdotnet_has_categories( 'Uncategorized' ) ) : ?>
            <div class="categories-list">
                <div class="categories-title">Categories</div>
            
                <div class="categories-link">
                    <?php emdotnet_post_categories( ' ', 1 ); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
                        
</article><!-- #post-## -->
