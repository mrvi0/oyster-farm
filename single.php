<?php
get_header();
?>

<main id="main" class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <!-- Post Header -->
            <section class="post-header">
                <div class="container">
                    <div class="post-header-content">
                        <div class="post-meta">
                            <span class="post-date">
                                <i class="fas fa-calendar-alt"></i>
                                <?php echo get_the_date(); ?>
                            </span>
                            <?php if (has_category()) : ?>
                                <span class="post-category">
                                    <i class="fas fa-folder"></i>
                                    <?php the_category(', '); ?>
                                </span>
                            <?php endif; ?>
                            <?php if (has_tag()) : ?>
                                <span class="post-tags">
                                    <i class="fas fa-tags"></i>
                                    <?php the_tags('', ', '); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        
                        <?php if (get_the_excerpt()) : ?>
                            <div class="post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-author">
                            <div class="author-info">
                                <div class="author-avatar">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                                </div>
                                <div class="author-details">
                                    <span class="author-name"><?php the_author(); ?></span>
                                    <span class="author-bio"><?php echo get_the_author_meta('description'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Post Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <section class="post-featured-image">
                    <div class="container">
                        <div class="featured-image-wrapper">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Post Content -->
            <section class="post-content">
                <div class="container">
                    <div class="content-wrapper">
                        <article class="post-article">
                            <div class="post-content-text">
                                <?php the_content(); ?>
                            </div>
                            
                            <!-- Post Navigation -->
                            <div class="post-navigation">
                                <div class="nav-links">
                                    <?php
                                    $prev_post = get_previous_post();
                                    $next_post = get_next_post();
                                    ?>
                                    
                                    <?php if ($prev_post) : ?>
                                        <div class="nav-previous">
                                            <a href="<?php echo get_permalink($prev_post); ?>">
                                                <span class="nav-subtitle">
                                                    <i class="fas fa-chevron-left"></i> Предыдущая запись
                                                </span>
                                                <span class="nav-title"><?php echo get_the_title($prev_post); ?></span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($next_post) : ?>
                                        <div class="nav-next">
                                            <a href="<?php echo get_permalink($next_post); ?>">
                                                <span class="nav-subtitle">
                                                    Следующая запись <i class="fas fa-chevron-right"></i>
                                                </span>
                                                <span class="nav-title"><?php echo get_the_title($next_post); ?></span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Author Bio -->
                            <div class="author-bio-section">
                                <div class="author-bio-content">
                                    <div class="author-avatar-large">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
                                    </div>
                                    <div class="author-info-large">
                                        <h3>Об авторе</h3>
                                        <h4><?php the_author(); ?></h4>
                                        <p><?php echo get_the_author_meta('description'); ?></p>
                                        <div class="author-social">
                                            <?php
                                            $author_website = get_the_author_meta('user_url');
                                            if ($author_website) : ?>
                                                <a href="<?php echo esc_url($author_website); ?>" target="_blank" rel="noopener">
                                                    <i class="fas fa-globe"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Related Posts -->
                            <?php
                            $categories = get_the_category();
                            if ($categories) {
                                $category_ids = array();
                                foreach ($categories as $category) {
                                    $category_ids[] = $category->term_id;
                                }
                                
                                $related_posts = new WP_Query(array(
                                    'category__in' => $category_ids,
                                    'post__not_in' => array(get_the_ID()),
                                    'posts_per_page' => 3,
                                    'orderby' => 'rand'
                                ));
                                
                                if ($related_posts->have_posts()) : ?>
                                    <div class="related-posts">
                                        <h3>Похожие записи</h3>
                                        <div class="related-posts-grid">
                                            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                                <article class="related-post-card">
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <div class="related-post-image">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_post_thumbnail('medium'); ?>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="related-post-content">
                                                        <h4>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h4>
                                                        <span class="related-post-date"><?php echo get_the_date(); ?></span>
                                                    </div>
                                                </article>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                    <?php wp_reset_postdata(); ?>
                                <?php endif;
                            }
                            ?>
                            
                            <!-- Comments -->
                            <?php
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif;
                            ?>
                        </article>
                    </div>
                </div>
            </section>
            <?php
        endwhile;
    else :
        ?>
        <section class="no-post">
            <div class="container">
                <div class="no-post-content">
                    <h3>Запись не найдена</h3>
                    <p>Запрашиваемая запись не существует или была удалена.</p>
                    <a href="<?php echo home_url(); ?>" class="back-home">Вернуться на главную</a>
                </div>
            </div>
        </section>
        <?php
    endif;
    ?>
</main>

<?php
get_footer();
?> 