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
            'posts_per_page' => 6,
        );
        // The Query
        $the_query = new WP_Query( $args )

    ?>
        <section id="tidy-products" class="container_9 clearfix col2-right">

            <!-- Center -->
            <article id="center_column" class=" grid_5">
                <div class="toolbar">
                    <div class="sort-select">
                        <label>Sort by</label>
                        <select class="selectBox">
                            <option>Position</option>
                        </select>
                    </div>
                    <div class="sort-select">
                        <label>Show</label>
                        <select class="selectBox">
                            <option>5 per page</option>
                            <option>7 per page</option>
                            <option>9 per page</option>
                        </select>
                    </div>
                    <div class="lg-panel htabs">
                        <label>View</label>
                        <a href="product-list.html" class="list-btn first-bg active" id="list"></a> <a class="grid-btn  first-bg " id="grid" href="product-grid.html"></a>
                    </div>
                </div>
                <ol id="products-list" class="products-list">
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
                </ol>


                <div class="pagination">
                    <div class="item-total"> Items 1 to 9 of 12 total </div>
                    <ul>
                        <li><a href="#">«</a></li>
                        <li class="active first-bg-hover"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </article>

            <!-- Right -->
            <aside id="right_column" class="column grid_2 omega">

                <!-- Block categories module -->
                <div id="categories_block_left" class="block">
                    <h4 class="title_block">Categories</h4>
                    <div class="block_content">
                        <ul class="tree dhtml">
                            <li> <a href="/" title="">Living Room</a>
                                <ul>
                                    <li> <a href="/" title="">Chairs</a> </li>
                                    <li> <a href="/" title="">Sofas</a> </li>
                                    <li> <a href="/" title="">Tables</a> </li>
                                    <li> <a href="/" title="">Wardrobes</a> </li>
                                </ul>
                            </li>
                            <li> <a href="/" title="">DedRoom</a>
                                <ul>
                                    <li> <a href="/" title="">Sofas</a> </li>
                                    <li> <a href="/" title="">Wardrobes</a> </li>
                                </ul>
                            </li>
                            <li> <a href="/" title="">Dining Room</a>
                                <ul>
                                    <li> <a href="/" title="">Wardrobes</a> </li>
                                    <li> <a href="/" title="">Tables</a> </li>
                                    <li> <a href="/" title="">Chairs</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Block categories module -->

                <!-- Block CMS module -->
                <div class="block" id="layered_block_left">
                    <h4 class="title_block">Filter By</h4>
                    <div class="block_content">
                        <form id="layered_form" action="#">
                            <div>
                                <div> <span class="layered_subtitle">Categories</span>
                                    <div class="clear"></div>
                                    <ul class="Hide" id="ul_layered_category_0">
                                        <li>
                                            <input type="checkbox" id="layered_category_1" class="checkbox">
                                            <label for="layered_category_1"> Jackets<span> (1)</span> </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="layered_category_2" class="checkbox">
                                            <label for="layered_category_2"> Chairs <span> (10)</span> </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="layered_category_3" class="checkbox">
                                            <label for="layered_category_3"> Kids & Babies<span> (1)</span> </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="layered_category_4" class="checkbox">
                                            <label for="layered_category_4"> Electronics <span> (1)</span></label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="layered_category_5" class="checkbox">
                                            <label for="layered_category_5"> Jackets<span> (1)</span></label>
                                        </li>
                                    </ul>
                                </div>
                                <div> <span class="layered_subtitle">Condition</span>
                                    <div class="clear"></div>
                                    <ul class="Hide" id="ul_layered_condition_0">
                                        <li>
                                            <input type="checkbox" id="layered_Condition_1" class="checkbox">
                                            <label for="layered_Condition_1"> New<span> (1)</span></label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="layered_Condition_2" class="checkbox">
                                            <label for="layered_Condition_2">Old<span> (1)</span></label>
                                        </li>
                                    </ul>
                                </div>

                                <!-- bxSlider Javascript file -->
                                <script src="js/jquery.slider.min.js"></script>

                                <!-- Javascripts All -->
                                <script src="js/scripts.js"></script>
                                <!-- Javascripts -->
                                <script src="js/jquery.nouislider.min.js"></script>
                                <link rel="stylesheet" href="css/nouislider.fox.css" type="text/css" media="screen" />
                                <div class="layered_price"> <span class="layered_subtitle">Price</span>
                                    <div class="clear"></div>
                                    <ul id="ul_layered_price_0" class="Hide">
                                        <div class="section-body">
                                            <div class="range-slider-container">
                                                <div class="range-slider"></div>
                                                <div class="range-slider-value clearfix"> <span class="min"></span> <span class="max"></span> </div>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                        </form>
                    </div>
                </div>
            </aside>
        </section>
<?php
    }
}
