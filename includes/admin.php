<?php

////////////////////////
// Register menu item //
////////////////////////
function eog_simplestsharebuttons_admin_menu_setup() {
    add_options_page(
        __( 'EOG Simplest Share Buttons Settings', 'eog-simplestsharebuttons' ),
        'EOG Simplest Share Buttons',
        'manage_options',
        'eog_ssb_options',
        'eog_simplestsharebuttons_admin_page_screen'
    );
}
add_action( 'admin_menu', 'eog_simplestsharebuttons_admin_menu_setup' );

///////////////////
// Settings init //
///////////////////
function eog_simplestsharebuttons_settings_init() {
    /*******************\
      Register settings
    \*******************/
    register_setting( 'eog_ssb_options', 'eog_ssb_settings' );
    /*******************\
      Settings sections
    \*******************/
    add_settings_section(
        'eog_ssb_section_general',
        __( 'General Settings', 'eog-simplestsharebuttons' ),
        'eog_ssb_function_section',
        'eog_ssb_options'
    );
    add_settings_section(
        'eog_ssb_section_visual',
        __( 'Visual Settings', 'eog-simplestsharebuttons' ),
        'eog_ssb_function_section',
        'eog_ssb_options'
    );
    /*****************\
      Settings fields
    \*****************/
    add_settings_field(
        'show_fb',
        __( 'Facebook button', 'eog-simplestsharebuttons' ),
        'render_checkbox',
        'eog_ssb_options',
        'eog_ssb_section_general',
        array(
            'label_for' => __( 'Show button', 'eog-simplestsharebuttons' ),
            'setting' => 'show_fb',
            'description' => ''
        )
    );
    add_settings_field(
        'show_tw',
        __( 'Twitter button', 'eog-simplestsharebuttons' ),
        'render_checkbox',
        'eog_ssb_options',
        'eog_ssb_section_general',
        array(
            'label_for' => __( 'Show button', 'eog-simplestsharebuttons' ),
            'setting' => 'show_tw',
            'description' => ''

        )
    );
    add_settings_field(
        'show_gp',
        __( 'Google+ button', 'eog-simplestsharebuttons' ),
        'render_checkbox',
        'eog_ssb_options',
        'eog_ssb_section_general',
        array(
            'label_for' => __( 'Show button', 'eog-simplestsharebuttons' ),
            'setting' => 'show_gp',
            'description' => ''

        )
    );
    add_settings_field(
        'show_wa',
        __( 'Whatsapp button', 'eog-simplestsharebuttons' ),
        'render_checkbox',
        'eog_ssb_options',
        'eog_ssb_section_general',
        array(
            'label_for' => __( 'Show button', 'eog-simplestsharebuttons' ),
            'setting' => 'show_wa',
            'description' => __( 'Works only for mobile devices', 'eog-simplestsharebuttons' )

        )
    );
    add_settings_field(
        'position',
        __( 'Position of the icons', 'eog-simplestsharebuttons' ),
        'render_select',
        'eog_ssb_options',
        'eog_ssb_section_visual',
        array(
            'setting' => 'position',
            'values' => array(
                '1' => __( 'Before', 'eog-simplestsharebuttons' ),
                '2' => __( 'After', 'eog-simplestsharebuttons' ),
                '3' => __( 'Both', 'eog-simplestsharebuttons' ),
            ),
            'description' => __( 'Choose whether to display icons before the content, after the content or at both positions' , 'eog-simplestsharebuttons' )
        )
    );
    add_settings_field(
        'size',
        __( 'Size of the icons', 'eog-simplestsharebuttons' ),
        'render_select',
        'eog_ssb_options',
        'eog_ssb_section_visual',
        array(
            'setting' => 'size',
            'values' => array(
                '1' => __( 'Normal', 'eog-simplestsharebuttons' ),
                '2' => __( 'Big', 'eog-simplestsharebuttons' ),
                '3' => __( 'Very big', 'eog-simplestsharebuttons' )
            ),
            'description' => __( 'Choose the display size of the icons' , 'eog-simplestsharebuttons' )
        )
    );
    add_settings_field(
        'alignment',
        __( 'Alignment of the icons', 'eog-simplestsharebuttons' ),
        'render_select',
        'eog_ssb_options',
        'eog_ssb_section_visual',
        array(
            'setting' => 'alignment',
            'values' => array(
                'left' => __( 'Left', 'eog-simplestsharebuttons' ),
                'right' => __( 'Right', 'eog-simplestsharebuttons' ),
            ),
            'description' => __( 'Choose whether the icons should be aligned to the left or to the right side of the content' , 'eog-simplestsharebuttons' )
        )
    );
    add_settings_field(
        'shape',
        __( 'Shape of the icons', 'eog-simplestsharebuttons' ),
        'render_select',
        'eog_ssb_options',
        'eog_ssb_section_visual',
        array(
            'setting' => 'shape',
            'values' => array(
                'circle' => __( 'Circle', 'eog-simplestsharebuttons' ),
                'square' => __( 'Square', 'eog-simplestsharebuttons' ),
                'rounded' => __( 'Rounded square', 'eog-simplestsharebuttons' ),
                'leaf' => __( 'Leaf', 'eog-simplestsharebuttons' ),
            ),
            'description' => __( 'Choose the icons shape' , 'eog-simplestsharebuttons' )
        )
    );
    add_settings_field(
        'atenuation',
        __( 'Atenuation', 'eog-simplestsharebuttons' ),
        'render_checkbox',
        'eog_ssb_options',
        'eog_ssb_section_visual',
        array(
            'label_for' => '',
            'setting' => 'atenuation',
            'description' => __( 'Atenuate colors of icons when hover' , 'eog-simplestsharebuttons' )
        )
    );
    add_settings_field(
        'animation',
        __( 'Animation', 'eog-simplestsharebuttons' ),
        'render_select',
        'eog_ssb_options',
        'eog_ssb_section_visual',
        array(
            'setting' => 'animation',
            'values' => array(
                '' => __( 'None', 'eog-simplestsharebuttons' ),
                'rotate' => __( 'Rotation', 'eog-simplestsharebuttons' ),
                'expand' => __( 'Expand text', 'eog-simplestsharebuttons' ),
            ),
            'description' => __( 'Choose the animation of the icons when hover' , 'eog-simplestsharebuttons' )
        )
    );
    add_settings_field(
        'filling',
        __( 'Filling', 'eog-simplestsharebuttons' ),
        'render_select',
        'eog_ssb_options',
        'eog_ssb_section_visual',
        array(
            'setting' => 'filling',
            'values' => array(
                '' => __( 'None', 'eog-simplestsharebuttons' ),
                'color' => __( 'Color', 'eog-simplestsharebuttons' ),
            ),
            'description' => __( 'Choose the filling style of the buttons' , 'eog-simplestsharebuttons' )
        )
    );
//    add_settings_field( 'apikey', __( 'Google API key for shorten URL', 'eog-simplestsharebuttons' ), 'eog_ssb_options',  );
}
add_action( 'admin_init', 'eog_simplestsharebuttons_settings_init' );

////////////////////////
// Callback functions //
////////////////////////
function eog_ssb_function_section ( $arg ) {
}


//////////////////////////
// Validation functions //
//////////////////////////


/////////////////////
// Render settings //
/////////////////////
function render_checkbox ( $args ) {
    $options = get_option( 'eog_ssb_settings' );
?>
    <input id='<?php echo $args['setting']; ?>' type='checkbox' name='eog_ssb_settings[<?php echo $args['setting']; ?>]' <?php if ( isset( $options[$args['setting']] ) ) { checked( $options[$args['setting']], 1 ); } ?> value='1'>
    <label for="<?php echo $args['setting']; ?>"><?php echo $args['label_for']; ?></label>
<?php if ( $args['description'] ) { ?>
    <p class="description"><?php echo $args['description']; ?></p>
<?php } ?>
<?php
}

function render_select ( $args ) {
    $options = get_option( 'eog_ssb_settings' );
?>
    <select name='eog_ssb_settings[<?php echo $args['setting']; ?>]'>
<?php
    foreach ( $args['values'] as $value => $display ) {
?>
        <option value='<?php echo $value; ?>' <?php if ( isset( $options[$args['setting']] ) ) { selected( $options[$args['setting']], $value ); } ?>><?php echo $display; ?></option>
<?php
    }
?>
    </select>
<?php
    if ( $args['description'] ) {
?>
    <p class="description"><?php echo $args['description']; ?></p>
<?php
    }
}

//////////////////////////
// Display page content //
//////////////////////////
function eog_simplestsharebuttons_admin_page_screen() {
    global $submenu;
    // access page settings 
    $page_data = array();
    foreach ( $submenu['options-general.php'] as $i => $menu_item ) {
        if ( $submenu['options-general.php'][ $i ][2] == 'eog_ssb_options' ) {
            $page_data = $submenu['options-general.php'][ $i ];
        }
    }

    // output 
    ?>
    <div class="wrap">
        <h2><?php echo $page_data[3]; ?></h2>
        <form id="eog_simplestsharebuttons_options" action="options.php" method="POST">
            <?php
                settings_fields( 'eog_ssb_options' );
                do_settings_sections( 'eog_ssb_options' ); 
                submit_button( __( 'Save options', 'eog-simplestsharebuttons' ), 'primary', 'eog_simplestsharebuttons_options_submit' );
            ?>
        </form>
    </div>
    <?php
}

///////////////////////////////////////////////////
// Add settings link to plugin management screen //
///////////////////////////////////////////////////
function eog_simplestsharebuttons_settings_link($actions, $file) {
    if ( false !== strpos( $file, 'eog-simplest-share-buttons' ) ) {
        $actions['settings'] = '<a href="options-general.php?page=eog_simplestsharebuttons_menu">' . __( 'Settings', 'eog-simplestsharebuttons' ) . '</a>';
    }
    return $actions;
}
add_filter('plugin_action_links', 'eog_simplestsharebuttons_settings_link', 2, 2);
