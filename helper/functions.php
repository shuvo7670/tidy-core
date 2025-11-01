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
    $nonce  = !empty( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';

    // verify nonce 
    if ( ! wp_verify_nonce( $nonce, 'ajax_product_filter' ) ) {
        wp_send_json_error( 'Invalid nonce' );
        wp_die();
    }


    // if( !current_user_can('edit_others_posts') ) {
    //     wp_send_json_error( 'Unauthorized user' );
    //     wp_die();
    // }

    $category               = !empty( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';
    $brand                  = !empty( $_POST['brand'] ) ? sanitize_text_field( $_POST['brand'] ) : '';
    $paged                  = !empty( $_POST['paged'] ) ? sanitize_text_field( $_POST['paged'] ) : 1;
    $layout                 = !empty( $_POST['layout'] ) ? sanitize_text_field( $_POST['layout'] ) : 'list';
    $default_posts_per_page = $layout == 'grid' ? 9 : 6;
    $posts_per_page         = !empty( $_POST['posts_per_page'] ) ? sanitize_text_field( $_POST['posts_per_page'] ) : $default_posts_per_page;
    $search                 = !empty( $_POST['search'] ) ? sanitize_text_field( $_POST['search'] ) : '';

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $posts_per_page,
        'paged'          => max( 1, $paged ),
        's'              => $search,
    );
    if( !empty( $category ) ) {
        $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => [$category],
        );
    }
    if( !empty( $brand ) ) {
        $args['tax_query'][] = array(
                'taxonomy' => 'product_brand',
                'field'    => 'slug',
                'terms'    => $brand,
        );
    }

    // if( !empty( $search ) ) {
    //     $args['meta_query'][] = array(
    //             'key'     => 'added_by',
    //             'value'   => $search,
    //             'compare' => 'LIKE',
    //     );
    // }

    // The Query
    $the_query = new WP_Query( $args );
    ?>
     <ol id="products-list" class="<?php echo $layout == 'grid' ? 'products-grid' : 'products-list' ?>">
        <?php
            if( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $get_thumnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    $product = wc_get_product( get_the_ID() );

        ?>
            <?php if( $layout == 'list' ) : ?>
                <li class="item fadeIn animated"> 
                    <a rel="prettyPhoto[pp_gal]" class="product-image" title="" href="<?php echo get_the_permalink() ?>">
                        <?php the_post_thumbnail() ?>
                    </a>
                    <div class="product-shop">
                        <div class="no-fix">
                            <h2 class="product-name"><a title="" href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></h2>
                            <div class="price-box"> <span id="product-price-51" class="regular-price">
                                <span class="price"><?php echo $product->get_price_html(); ?></span> </span>
                            </div>
                            <div class="desc std">
                                <?php echo wp_trim_words( get_the_content(),'100', '...') ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php else : ?>
                <li class="item first fadeIn animated" style="text-align: center;"> 
                    <a rel="prettyPhoto[pp_gal]" class="fa-search-btn first-bg"  href="<?php echo $get_thumnail_url ?>"> enlarge image <i class="icon-search"></i></a> 
                    <a class="product-image" title="Product Name" href="<?php echo get_the_permalink() ?>"> 
                        <?php the_post_thumbnail() ?>
                    </a>
                    <h2 class="product-name"> <a title="<?php echo get_the_title() ?>" href="<?php echo get_the_permalink() ?>"> <?php echo get_the_title() ?> </a> </h2>
                    <a class="btn" style="margin-bottom: 10px;"> View More</a> 
                    </div>
                </li>
            <? endif; ?>
        <?php 
            }
        }

        ?>
        </ol>
        <div class="pagination" id="product-pagination">
            <?php 
                echo paginate_links( array(
                    'current' => max( 1, $paged ),
                    'total'   => $the_query->max_num_pages
                ) );
            ?>
        </div>
        <?php 
        wp_reset_postdata();
        ?>
    <?php 
    wp_die();
}