<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class vw_kindergarten_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'vw-kindergarten-typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-kindergarten' ),
				'family'      => esc_html__( 'Font Family', 'vw-kindergarten' ),
				'size'        => esc_html__( 'Font Size',   'vw-kindergarten' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-kindergarten' ),
				'style'       => esc_html__( 'Font Style',  'vw-kindergarten' ),
				'line_height' => esc_html__( 'Line Height', 'vw-kindergarten' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-kindergarten' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-kindergarten-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-kindergarten-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-kindergarten' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-kindergarten' ),
        'Acme' => __( 'Acme', 'vw-kindergarten' ),
        'Anton' => __( 'Anton', 'vw-kindergarten' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-kindergarten' ),
        'Arimo' => __( 'Arimo', 'vw-kindergarten' ),
        'Arsenal' => __( 'Arsenal', 'vw-kindergarten' ),
        'Arvo' => __( 'Arvo', 'vw-kindergarten' ),
        'Alegreya' => __( 'Alegreya', 'vw-kindergarten' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-kindergarten' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-kindergarten' ),
        'Bangers' => __( 'Bangers', 'vw-kindergarten' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-kindergarten' ),
        'Bad Script' => __( 'Bad Script', 'vw-kindergarten' ),
        'Bitter' => __( 'Bitter', 'vw-kindergarten' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-kindergarten' ),
        'BenchNine' => __( 'BenchNine', 'vw-kindergarten' ),
        'Cabin' => __( 'Cabin', 'vw-kindergarten' ),
        'Cardo' => __( 'Cardo', 'vw-kindergarten' ),
        'Courgette' => __( 'Courgette', 'vw-kindergarten' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-kindergarten' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-kindergarten' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-kindergarten' ),
        'Cuprum' => __( 'Cuprum', 'vw-kindergarten' ),
        'Cookie' => __( 'Cookie', 'vw-kindergarten' ),
        'Chewy' => __( 'Chewy', 'vw-kindergarten' ),
        'Days One' => __( 'Days One', 'vw-kindergarten' ),
        'Dosis' => __( 'Dosis', 'vw-kindergarten' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-kindergarten' ),
        'Economica' => __( 'Economica', 'vw-kindergarten' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-kindergarten' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-kindergarten' ),
        'Francois One' => __( 'Francois One', 'vw-kindergarten' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-kindergarten' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-kindergarten' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-kindergarten' ),
        'Handlee' => __( 'Handlee', 'vw-kindergarten' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-kindergarten' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-kindergarten' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-kindergarten' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-kindergarten' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-kindergarten' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-kindergarten' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-kindergarten' ),
        'Kanit' => __( 'Kanit', 'vw-kindergarten' ),
        'Lobster' => __( 'Lobster', 'vw-kindergarten' ),
        'Lato' => __( 'Lato', 'vw-kindergarten' ),
        'Lora' => __( 'Lora', 'vw-kindergarten' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-kindergarten' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-kindergarten' ),
        'Merriweather' => __( 'Merriweather', 'vw-kindergarten' ),
        'Monda' => __( 'Monda', 'vw-kindergarten' ),
        'Montserrat' => __( 'Montserrat', 'vw-kindergarten' ),
        'Muli' => __( 'Muli', 'vw-kindergarten' ),
        'Marck Script' => __( 'Marck Script', 'vw-kindergarten' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-kindergarten' ),
        'Open Sans' => __( 'Open Sans', 'vw-kindergarten' ),
        'Overpass' => __( 'Overpass', 'vw-kindergarten' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-kindergarten' ),
        'Oxygen' => __( 'Oxygen', 'vw-kindergarten' ),
        'Orbitron' => __( 'Orbitron', 'vw-kindergarten' ),
        'Patua One' => __( 'Patua One', 'vw-kindergarten' ),
        'Pacifico' => __( 'Pacifico', 'vw-kindergarten' ),
        'Padauk' => __( 'Padauk', 'vw-kindergarten' ),
        'Playball' => __( 'Playball', 'vw-kindergarten' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-kindergarten' ),
        'PT Sans' => __( 'PT Sans', 'vw-kindergarten' ),
        'Philosopher' => __( 'Philosopher', 'vw-kindergarten' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-kindergarten' ),
        'Poiret One' => __( 'Poiret One', 'vw-kindergarten' ),
        'Quicksand' => __( 'Quicksand', 'vw-kindergarten' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-kindergarten' ),
        'Raleway' => __( 'Raleway', 'vw-kindergarten' ),
        'Rubik' => __( 'Rubik', 'vw-kindergarten' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-kindergarten' ),
        'Russo One' => __( 'Russo One', 'vw-kindergarten' ),
        'Righteous' => __( 'Righteous', 'vw-kindergarten' ),
        'Slabo' => __( 'Slabo', 'vw-kindergarten' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-kindergarten' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-kindergarten'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-kindergarten' ),
        'Sacramento' => __( 'Sacramento', 'vw-kindergarten' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-kindergarten' ),
        'Tangerine' => __( 'Tangerine', 'vw-kindergarten' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-kindergarten' ),
        'VT323' => __( 'VT323', 'vw-kindergarten' ),
        'Varela Round' => __( 'Varela Round', 'vw-kindergarten' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-kindergarten' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-kindergarten' ),
        'Volkhov' => __( 'Volkhov', 'vw-kindergarten' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-kindergarten' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-kindergarten' ),
			'100' => esc_html__( 'Thin',       'vw-kindergarten' ),
			'300' => esc_html__( 'Light',      'vw-kindergarten' ),
			'400' => esc_html__( 'Normal',     'vw-kindergarten' ),
			'500' => esc_html__( 'Medium',     'vw-kindergarten' ),
			'700' => esc_html__( 'Bold',       'vw-kindergarten' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-kindergarten' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'' => esc_html__( 'No Fonts Style', 'vw-kindergarten' ),
			'normal'  => esc_html__( 'Normal', 'vw-kindergarten' ),
			'italic'  => esc_html__( 'Italic', 'vw-kindergarten' ),
			'oblique' => esc_html__( 'Oblique', 'vw-kindergarten' )
		);
	}
}
