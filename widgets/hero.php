<?php

class TIDY_CORE_Hero extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tidy_core_hero';
	}

	public function get_title() {
		return esc_html__( 'Hero', 'tidy-core' ); // jodi double underscore thake tahole sheta textdomain hisebe kaj kore
	}

	public function get_icon() {
		return 'eicon-heading';
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
			'tidy_hero_section',
			[
				'label' => esc_html__( 'Content', 'tidy-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'tidy_hero_bg_shape',
            [
                'label' => esc_html__( 'Background Shape', 'tidy-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
		);

        // Title Control
		$this->add_control(
			'tidy_hero_section_title',
			[
				'label'   => esc_html__( 'Title', 'tidy-core' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Landing template for startups', 'tidy-core' ),
			]
		);
        // Description Control
		$this->add_control(
			'tidy_hero_section_description',
			[
				'label'   => esc_html__( 'Description', 'tidy-core' ),
				'type'    => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Our landing page template works on all devices, so you only have to set it up once, and get beautiful results forever.', 'tidy-core' ),
			]
		);

		$this->end_controls_section();
        // Content Tab End

        // Button One Start
		$this->start_controls_section(
			'tidy_button_one_section',
			[
				'label' => esc_html__( 'Button One', 'tidy-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        // Title Control
		$this->add_control(
			'tidy_hero_section_button_one_text',
			[
				'label'   => esc_html__( 'Button Text', 'tidy-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Pricing and Plans', 'tidy-core' ),
			]
		);
        // Description Control
		$this->add_control(
			'tidy_hero_section_button_one_url',
			[
                'label' => esc_html__( 'Button URL', 'tidy-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
			]
		);

		$this->end_controls_section();
        // Button One End

        // Button One Start
		$this->start_controls_section(
			'tidy_button_two_section',
			[
				'label' => esc_html__( 'Button Two', 'tidy-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        // Title Control
		$this->add_control(
			'tidy_hero_section_button_two_text',
			[
				'label'   => esc_html__( 'Button Text', 'tidy-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn more', 'tidy-core' ),
			]
		);
        // Description Control
		$this->add_control(
			'tidy_hero_section_button_two_url',
			[
                'label' => esc_html__( 'Button URL', 'tidy-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url'         => '#',
                    'is_external' => true,
                    'nofollow'    => true,
                ],
			]
		);

		$this->end_controls_section();
        // Button One End

        // Video Section Start
		$this->start_controls_section(
			'tidy_video_section',
			[
				'label' => esc_html__( 'Video', 'tidy-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        // Title Control
		$this->add_control(
			'tidy_video_section_thumbnail',
            [
                'label' => esc_html__( 'Video Thumbnail', 'tidy-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
		);

        $this->add_control(
			'tidy_video_section_url',
			[
                'label' => esc_html__( 'Video URL', 'tidy-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url'         => 'https://youtu.be/-WdwsofyCxo',
                    'is_external' => true,
                    'nofollow'    => true,
                ],
			]
		);

		$this->end_controls_section();
        // Video Section End


        // Style Tab Start
		$this->start_controls_section(
			'tidy_hero_style_content_section',
			[
				'label' => esc_html__( 'Content', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .hero.has-bg-color::before',
			]
		);


		// Style for Title
		$this->add_control(
			'tidy_hero_style_content_section_title_color',
			[
				'label' => esc_html__( 'Title Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero .hero-inner .split-item h1' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'tidy_hero_style_content_section_title_typography',
				'selector' => '{{WRAPPER}}  .hero .hero-inner .split-item h1',
			]
		);

        // Style for Description
        $this->add_control(
            'tidy_hero_style_content_section_description_color',
            [
                'label' => esc_html__( 'Description Color', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero .hero-inner .split-item p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tidy_hero_style_content_section_description_typography',
                'selector' => '{{WRAPPER}}  .hero .hero-inner .split-item p', 
            ]
        );

		$this->end_controls_section();

        // Style section for Button One
		$this->start_controls_section(
			'tidy_hero_style_button_section',
			[
				'label' => esc_html__( 'Buttons Style', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'tidy_hero_style_button_section_button_one_color',
            [
                'label' => esc_html__( 'Button One BG Color', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero .hero-inner .split-item .button-primary' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tidy_hero_style_button_section_button_two_color',
            [
                'label' => esc_html__( 'Button Two BG Color', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero .hero-inner .split-item .button-dark' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
        $settings        = $this->get_settings_for_display();
        $title           = $settings['tidy_hero_section_title'];
        $description     = $settings['tidy_hero_section_description'];
        $button_one_text = $settings['tidy_hero_section_button_one_text'];
        $button_one_url  = $settings['tidy_hero_section_button_one_url']['url'];
        $button_two_text = $settings['tidy_hero_section_button_two_text'];
        $button_two_url  = $settings['tidy_hero_section_button_two_url']['url'];
        $video_thumbnail = $settings['tidy_video_section_thumbnail']['url'];
        $video_url       = $settings['tidy_video_section_url']['url'];

		?>
            <section class="hero section has-bg-color invert-color">
				<div class="container">
					<div class="hero-inner section-inner">
                        <div class="split-wrap">
                            <div class="split-item">
                                <div class="hero-content split-item-content center-content-mobile reveal-from-top">
                                    <h1 class="mt-0 mb-16">
                                        <?php echo $title ?>
                                    </h1>
                                    <p class="mt-0 mb-32">
                                        <?php echo $description ?>
                                    </p>
                                    <div class="button-group">
                                        <a class="button button-primary button-wide-mobile" href="<?php echo $button_one_url ?>"><?php echo $button_one_text ?></a>
                                        <a class="button button-dark button-wide-mobile" href="<?php echo $button_two_url ?>"><?php echo $button_two_text ?></a>
                                    </div>
                                </div>
                                <div class="hero-figure split-item-image split-item-image-fill illustration-element-01 reveal-from-bottom">
                                    <a class="modal-trigger" aria-controls="modal-01" data-video="<?php echo $video_url ?>" data-video-tag="iframe" href="#">
                                        <img src="<?php echo $video_thumbnail ?>" alt="Video" width="528" height="396">
                                    </a>
                                </div>
                                <div id="modal-01" class="modal modal-video">
                                    <div class="modal-inner">
                                        <div class="responsive-video">
                                            <iframe src="<?php echo $video_url ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
            </section>

            <style>
                .hero.section .illustration-element-01::after {
                    background-image: url(<?php echo $settings['tidy_hero_bg_shape']['url']; ?>);
                }
            </style>
        <?php 
	}

}