<?php

class TIDY_CORE_Products extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'tidy_core_products';
    }

    public function get_title()
    {
        return esc_html__('Products', 'tidy-core'); // jodi double underscore thake tahole sheta textdomain hisebe kaj kore
    }

    public function get_icon()
    {
        return 'eicon-basket-medium';
    }

    public function get_categories()
    {
        return ['tidy_core'];
    }

    public function get_keywords()
    {
        return ['mak', 'heading'];
    }

    protected function register_controls() {}

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 5,
            'paged'          => max( 1, get_query_var('paged') ),
        );
        // The Query
        $the_query = new WP_Query( $args );

        // get all product category
        $get_all_product_category = get_terms( array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
        ) );


        // get all product brand
        $get_all_product_brand = get_terms( array(
            'taxonomy'   => 'product_brand',
            'hide_empty' => false,
        ) );


    ?>
        <section id="tidy-products" class="container_9 clearfix col2-right">

            <!-- Center -->
            <article id="center_column" class=" grid_5">
                <div class="toolbar">
                    <div class="sort-select">
                        <label>Search</label>
                        <input id="search" type="text">
                    </div>
                    <div class="sort-select">
                        <label>Show</label>
                        <select id="posts_per_page" class="selectBox">
                            <option value="1">1 per page</option>
                            <option value="2">2 per page</option>
                            <option value="3">3 per page</option>
                            <option value="4">4 per page</option>
                            <option value="5">5 per page</option>
                            <option value="6" selected>6 per page</option>
                            <option value="7">7 per page</option>
                            <option value="8">8 per page</option>
                            <option value="9">9 per page</option>
                            <option value="10">10 per page</option>
                        </select>
                    </div>
                    <div class="lg-panel htabs" id="product-layout">
                        <label>View</label>
                        <a href="#" class="list-btn first-bg active" id="list"></a> 
                        <a class="grid-btn  first-bg " id="grid" href="#"></a>
                    </div>
                </div>
                <div id="product-item-wrapper">
                    <ol id="products-list" class="products-list">
                    <?php
                        if( $the_query->have_posts() ) {
                                while ( $the_query->have_posts() ) {
                                    $the_query->the_post();
                                    $product = wc_get_product( get_the_ID() );
                    ?>
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
                        <?php 
                            }
                        }
                    wp_reset_postdata();
                    ?>
                    </ol>
                    <div class="pagination" id="product-pagination">
                        <?php 
                            $big = 999999999; // need an unlikely integer
                            echo paginate_links( array(
                                'current' => max( 1, get_query_var('paged') ),
                                'total'   => $the_query->max_num_pages
                            ) );
                        ?>
                    </div>
                </div>
            </article>

            <!-- Right -->
            <aside id="right_column" class="column grid_2 omega">
                <!-- Block categories module -->
                <div id="categories_block_left" class="block category_block_left">
                    <h4 class="title_block">Categories</h4>
                    <div class="block_content">
                        <ul class="tree dhtml">
                            <?php foreach( $get_all_product_category as $category ) : ?>
                                <li> 
                                    <a href="<?php echo get_term_link($category->slug, 'product_cat'); ?>" data-slug="<?php echo $category->slug ?>"><?php echo $category->name ?> ( <?php echo $category->count ?? '' ?> )</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- /Block categories module -->

                <!-- Block Brands module -->
                <div id="categories_block_left" class="block brand_block_left">
                    <h4 class="title_block">Brands</h4>
                    <div class="block_content" style="padding: 10px 10px;">
                        <select id="brand-filter" class="selectBox">
                            <option value="">Select Brand</option>
                           <?php foreach( $get_all_product_brand as $brand ) : ?>
                                <option value="<?php echo $brand->slug ?>"><?php echo $brand->name ?> (<?php echo $brand->count ?? '' ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- /Block brands module -->
            </aside>
        </section>
<?php
    }
}
