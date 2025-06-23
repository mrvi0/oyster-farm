<?php
get_header();
?>
<main class="container">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    else :
        echo '<p>Контент не найден.</p>';
    endif;
    ?>
</main>
<?php
get_footer(); 