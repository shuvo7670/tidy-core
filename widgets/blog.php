<?php

class TIDY_CORE_BLOG_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tidy_core_blog_widget';
	}

	public function get_title() {
		return esc_html__( 'Blog Widget', 'tidy-core' );
	}

	public function get_icon() {
		return 'eicon-tabs';
	}

	public function get_categories() {
		return [ 'tidy_core' ];
	}

	public function get_keywords() {
		return [ 'mak', 'heading' ];
	}

	protected function register_controls() {
 		// Content Tab Start
		$this->start_controls_section(
			'tidy_blog_section',
			[
				'label' => esc_html__( 'Content', 'tidy-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'tidy_post_type',
            [
                'label'   => esc_html__( 'Post Type', 'tidy-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'post',
                'options' => get_post_types(),
            ]
		);
        $this->add_control(
			'tidy_post_per_page',
            [
                'label'   => esc_html__( 'Post Per Page', 'tidy-core' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 9,
            ]
		);
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $args = array(
            'post_type'      => $settings['tidy_post_type'],
            'posts_per_page' => $settings['tidy_post_per_page'],
        );
        // The Query
        $the_query = new WP_Query( $args );

		?>
          <section class="news section illustration-section-01">
                <div class="container">
                    <div class="news-inner section-inner">
                        <div class="tiles-wrap">
                            <?php
                                 // The Loop
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
                                                            <?php echo wp_trim_words( get_the_content(),'20', '') ?>
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
		<?php
	}

}