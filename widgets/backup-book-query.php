 <?php 
    $args = array(
        'post_type'   => 'book',
        'post_status' => 'publish',
        'numberposts' => 6,
        'tax_query'   => array(
            array(
                'taxonomy' => 'book-category',
                'field'    => 'slug',
                'terms'    => $book_category->slug,
            )
        )
    );
    $postslist = get_posts( $args );
?>
    <?php foreach( $postslist as $single_post ) : 
        setup_postdata( $single_post );
        ?>

        <article class="tiles-item reveal-from-bottom">
            <div class="tiles-item-inner has-shadow">
                <figure class="news-item-image m-0">
                    <?php the_post_thumbnail() ?>
                </figure>
                <div class="news-item-content">
                    <div class="news-item-body">
                        <h3 class="news-item-title h4 mt-0 mb-8">
                            <a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a>
                        </h3>
                        <p class="mb-16 text-sm">
                            <?php echo wp_trim_words( get_the_content(),'20', '') ?>
                        </p>
                    </div>
                    <div class="news-item-more text-xs mb-8">
                        <a href="<?php echo the_permalink() ?>">Read more</a>
                    </div>
                </div>
            </div>
        </article>
    <?php endforeach; wp_reset_postdata(); ?>