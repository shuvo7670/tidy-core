<?php

class TIDY_CORE_TAB_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tidy_core_tab_widget';
	}

	public function get_title() {
		return esc_html__( 'Tidy Tab Widget', 'elementor-addon' );
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
 		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'tidy-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'tab_list',
			[
				'label'  => esc_html__( 'Tab List', 'tidy-core' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name'        => 'tab_heading',
						'label'       => esc_html__( 'Tab Heading', 'tidy-core' ),
						'type'        => \Elementor\Controls_Manager::TEXT,
						'default'     => esc_html__( 'Internal Feedback' , 'tidy-core' ),
						'label_block' => true,
					],
					[
						'name'    => 'tab_icon',
						'label'   => esc_html__( 'Icon', 'tidy-core' ),
						'type'    => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value'   => 'fas fa-circle',
							'library' => 'fa-solid',
						],
						'recommended' => [
							'fa-solid' => [
								'circle',
								'dot-circle',
								'square-full',
							],
							'fa-regular' => [
								'circle',
								'dot-circle',
								'square-full',
							],
						],
					],
					[
						'name'    => 'tab_image',
						'label'   => esc_html__( 'Choose Image', 'tidy-core' ),
						'type'    => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					]
				],
				'title_field' => '{{{ tab_heading }}}',
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tab_list = ! empty( $settings['tab_list'] ) ? $settings['tab_list'] : [];

		?>
			<script>
				const tabs = document.getElementsByClassName('tab')

				function handleTabs (tab) {
					let id = tab.getAttribute('aria-controls')
					document.getElementById(id).classList.add('is-active')
					tab.classList.add('is-active')
				}

				if (tabs.length > 0) {
					for (let i = 0; i < tabs.length; i++) {
					let tab = tabs[i]
					tab.addEventListener('click', function (e) {
						e.preventDefault()

						const tabsContainer = this.closest('.tabs')
						const tabPanels = tabsContainer.getElementsByClassName('tab-panel')

						// Do nothing if item is active
						if (this.classList.contains('is-active')) {
						return
						}
						// Remove active classes
						for (let i = 0; i < tabs.length; i++) {
						tabs[i].classList.remove('is-active')
						}
						for (let i = 0; i < tabPanels.length; i++) {
						tabPanels[i].classList.remove('is-active')
						}

						handleTabs(this)
					})
					if (tab.classList.contains('is-active')) {
						handleTabs(tab)
					}
					}
				}
			</script>
		<?php 
		?>
            <section class="features-tabs section center-content has-bottom-divider">
                <div class="container">
                    <div class="features-tabs-inner section-inner has-top-divider">
                        <div class="tabs">
                            <ul class="tab-list list-reset mb-0">
								<?php foreach( $tab_list as $index => $item ) : ?>
									<li class="tab <?php echo $index == 0 ? 'is-active' : '' ?>" role="tab" aria-controls="tab-<?php echo $index ?>">
										<div class="features-tabs-tab-image mb-12">
											<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], [ 'aria-hidden' => 'true' ] ); ?>
										</div>
										<div class="text-color-high fw-600 text-sm">
											<?php echo $item['tab_heading'] ?>
										</div>
									</li>
								<?php endforeach; ?>
                            </ul>
							<?php foreach( $tab_list as $index => $item ) : ?>
								 <div id="tab-<?php echo $index ?>" class="tab-panel" role="tabpanel">
									<img class="has-shadow" src="<?php echo $item['tab_image']['url'] ?>" alt="Features tabs image 01" width="896" height="504">
								</div>
							<?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
		<?php
	}

}