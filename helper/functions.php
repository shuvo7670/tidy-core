<?php 

// Shortcode
    // 1. Add Shortcode 
    //    add_shortcode
    // 2. Use Shortcode 
    //     do_shortcode

add_shortcode('tidy_show_tours', 'tidy_show_tours_function');

function tidy_show_tours_function($atts){
    $per_page = !empty( $atts['post_per_page'] ) ? $atts['post_per_page'] : 6;
    $post_type = !empty( $atts['post_type'] ) ? $atts['post_type'] : 'tour';
     $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $per_page,
    );
    // The Query
    $the_query = new WP_Query( $args );
    ?>
        <section class="features-tabs section center-content has-bottom-divider">
            <div class="container">
                <div class="row" style="display: flex;">
                <?php
                    if( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
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
                                    <?php echo wp_trim_words( get_the_content(),'20', '...') ?>
                                </p>
                            </div>
                            <div class="news-item-more text-xs mb-8">
                                <a href="<?php echo get_the_permalink() ?>">Read more</a>
                            </div>
                        </div>
                    </div>
                </article>
                <?php 
                    }
                }
                wp_reset_postdata();
                ?>
                </div>
            </div>
        </section>
    <?php 
    return '';
}
