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


// AJAX Handler for getting product data
add_action( 'wp_ajax_get_product_data', 'get_product_data' );
add_action( 'wp_ajax_nopriv_get_product_data', 'get_product_data' );

function get_product_data(){

    $category = !empty( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 6,
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ),
    );
    // The Query
    $the_query = new WP_Query( $args );
    ?>
        <?php
            if( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
        ?>
            <li class="item fadeIn animated"> 
                <a rel="prettyPhoto[pp_gal]" class="product-image" title="" href="product.html">
                    <?php the_post_thumbnail() ?>
                </a>
                <div class="product-shop">
                    <div class="no-fix">
                        <h2 class="product-name"><a title="" href="product.html"><?php echo get_the_title() ?></a></h2>
                        <div class="price-box"> <span id="product-price-51" class="regular-price"> <span class="price">$299.99</span> </span> </div>
                        <div class="desc std">
                            <?php echo wp_trim_words( get_the_content(),'100', '...') ?>
                        </div>
                    </div>
                </div>
                <div class="btn-set">
                    <div class="actions"> <a class="btn-circle first-bg-hover"> <i class="icon-heart"></i> </a> <a class="btn-circle first-bg-hover"> <i class="icon-shopping-cart"></i> </a> <a class="btn-circle first-bg-hover"> <i class="icon-exchange"></i> </a> </div>
                </div>
            </li>
        <?php 
            }
        }
    wp_reset_postdata();
    ?>
    <?php 
    wp_die();
}