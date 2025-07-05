<?php
/*
Template Name: Блог
*/

get_header();

// Настройки для блога
$posts_per_page = 6; // Количество постов на странице
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Получаем посты
$blog_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'post_status' => 'publish'
));
?>

<main id="main" class="site-main">
    <!-- Blog Header -->
    <section class="blog-header">
        <div class="container">
            <div class="blog-header-content">
                <h1><?php echo get_the_title(); ?></h1>
                <?php if (get_post_meta(get_the_ID(), '_blog_subtitle', true)) : ?>
                    <p><?php echo esc_html(get_post_meta(get_the_ID(), '_blog_subtitle', true)); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="blog-content">
        <div class="container">
            <?php if ($blog_query->have_posts()) : ?>
                <div class="blog-grid">
                    <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        <article class="blog-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="blog-card-content">
                                <div class="blog-meta">
                                    <span class="blog-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <?php if (has_category()) : ?>
                                        <span class="blog-category">
                                            <i class="fas fa-folder"></i>
                                            <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <h2 class="blog-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <div class="blog-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="blog-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        Читать далее <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <!-- Pagination -->
                <?php if ($blog_query->max_num_pages > 1) : ?>
                    <div class="blog-pagination">
                        <?php
                        echo paginate_links(array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $blog_query->max_num_pages,
                            'prev_text' => '<i class="fas fa-chevron-left"></i> Назад',
                            'next_text' => 'Вперед <i class="fas fa-chevron-right"></i>',
                            'type' => 'list',
                            'end_size' => 3,
                            'mid_size' => 3
                        ));
                        ?>
                    </div>
                <?php endif; ?>
                
            <?php else : ?>
                <div class="no-posts">
                    <div class="no-posts-content">
                        <i class="fas fa-newspaper"></i>
                        <h3>Записей пока нет</h3>
                        <p>В блоге пока нет опубликованных записей. Загляните позже!</p>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</main>

<?php
get_footer();
?> 