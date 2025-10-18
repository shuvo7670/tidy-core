<?php

class TIDY_CORE_Book extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tidy_core_book';
	}

	public function get_title() {
		return esc_html__( 'Book', 'tidy-core' ); // jodi double underscore thake tahole sheta textdomain hisebe kaj kore
	}

	public function get_icon() {
		return 'eicon-post';
	}

	public function get_categories() {
		return [ 'tidy_core' ];
	}

	public function get_keywords() {
		return [ 'mak', 'heading' ];
	}

	protected function register_controls() {
       
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        $get_all_book_category = get_terms( array(
            'taxonomy'   => 'book-category',
            'hide_empty' => false,
        ) );

        ?>

         <section class="features-tabs section center-content has-bottom-divider">
            <div class="container">
                <div class="features-tabs-inner section-inner has-top-divider">
                    <div class="tabs">
                        <ul class="tab-list list-reset mb-0">
                            <?php foreach(  $get_all_book_category as $index => $book_category ) : ?>
                                <li class="tab <?php echo $index == 0 ? 'is-active' : '' ?>" role="tab" aria-controls="<?php echo $book_category->slug ?>">
                                    <div class="text-color-high fw-600 text-sm">
                                        <?php echo $book_category->name ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php foreach(  $get_all_book_category as $book_category ) : ?>
                            <div id="<?php echo $book_category->slug ?>" class="tab-panel" role="tabpanel">
                                <section class="news section illustration-section-01">
                                    <div class="container">
                                        <div class="news-inner section-inner">
                                            <div class="tiles-wrap">
                                                 <?php
                                                    $args = array(
                                                        'post_type'      => 'book',
                                                        'posts_per_page' => 6,
                                                        'tax_query' => array(
                                                            array(
                                                                'taxonomy' => 'book-category',
                                                                'field'    => 'slug',
                                                                'terms'    => $book_category->slug,
                                                            ),
                                                        ),
                                                    );
                                                    // The Query
                                                    $the_query = new WP_Query( $args );
                                                    if ( $the_query->have_posts() ) {
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

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <style>
            .news-item-image img {
                height: 300px;
                object-fit: cover;
            }
        </style>
        <?php 
	}

}