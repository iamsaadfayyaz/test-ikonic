<?php get_header(); ?>
<div id="page-wrapper">
<main id="single-post-content">
    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <!-- Post Thumbnail -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <!-- Post Title -->
                <h1 class="post-title"><?php the_title(); ?></h1>

                <!-- Post Meta Info -->
                <div class="post-meta">
                    <span class="author">By <?php the_author_posts_link(); ?></span>
                    <span class="date">Published on <?php echo get_the_date(); ?></span>
                    <span class="categories">Category: <?php the_category( ', ' ); ?></span>
                </div>

                <!-- Post Content -->
                <div class="post-content">
                    <?php the_content(); ?>
                </div>

                <!-- Post Tags -->
                <div class="post-tags">
                    <?php the_tags( 'Tags: ', ', ', '' ); ?>
                </div>

                <!-- Author Bio -->
                <div class="author-bio">
                    <h3>About the Author</h3>
                    <div class="author-info">
                        <div class="author-avatar">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 90 ); ?>
                        </div>
                        <div class="author-description">
                            <h4><?php the_author(); ?></h4>
                            <p><?php the_author_meta( 'description' ); ?></p> 
                        </div>
                    </div>
                </div>
            </article>

            <!-- Comments Section -->
            <?php comments_template(); ?>
        <?php endwhile; else : ?>
            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'text-domain' ); ?></p>
        <?php endif; ?>
    </div>
</main>
        </div>

<?php get_footer(); ?> 
