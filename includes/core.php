<?php

//////////////////////////////////////////////////////
// Function that adds share buttons to post content //
//////////////////////////////////////////////////////
function eog_simplestsharebuttons_content($content) {
    require_once 'Mobile_Detect.php';
    $options = get_option( 'eog_ssb_settings' );
    $detect = new Mobile_Detect;
    $esmovil = ( $detect->isMobile() && !$detect->isTablet() );

    $mostrarsocial = ( $options['show_fb'] || $options['show_tw'] || $options['show_gp'] || ( $options['show_wa'] && $esmovil ) );

    $size = $options['size'];
    $alignment = $options['alignment'];
    $shape = $options['shape'];
    $animation = $options['animation'];

    $socialstring = "";

    if ( is_single() && $mostrarsocial ) {
        wp_enqueue_style( 'eog-simplestsharebuttons-css-font', EOG_SIMPLESTSHAREBUTTONS_URL . 'assets/css/font-awesome.css', array(), false );
        wp_enqueue_style( 'eog-simplestsharebuttons-css-circle', EOG_SIMPLESTSHAREBUTTONS_URL . 'assets/css/styles.css', array(), false );
        wp_enqueue_script( 'eog-js-social', EOG_SIMPLESTSHAREBUTTONS_URL . 'assets/js/socwindow.js', array(), false );

        // This is the URL you want to shorten
        $longUrl = get_permalink();
        $apiKey = 'AIzaSyB9irfDNicgAak5vdSn1zDPDhnZk0Pj7FI';

        $postData = array( 'longUrl' => $longUrl );
        $jsonData = json_encode( $postData );

        $curlObj = curl_init();

        curl_setopt( $curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key=' . $apiKey );
        curl_setopt( $curlObj, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $curlObj, CURLOPT_SSL_VERIFYPEER, 0 );
        curl_setopt( $curlObj, CURLOPT_HEADER, 0 );
        curl_setopt( $curlObj, CURLOPT_HTTPHEADER, array( 'Content-type:application/json' ) );
        curl_setopt( $curlObj, CURLOPT_POST, 1 );
        curl_setopt( $curlObj, CURLOPT_POSTFIELDS, $jsonData );

        $response = curl_exec( $curlObj );

        // Change the response json string to object
        $json = json_decode( $response );

        curl_close( $curlObj );

        $shortUrl = $json->id;

        if ( $mostrarsocial ) {
            $socialstring = '
                            <div class="eog-social-bloque eog-social-' . $alignment . ' eog-social-' . $shape . '">
                                <div class="eog-social-media">';
        }
        if ( $options['show_fb'] ) {
            $socialstring .= '
                                    <a href="http://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '" rel="nofollow" title="' . __( 'Share in Facebook', 'eog-simplestsharebuttons' ) . '" target="_blank" onclick="eog_social_window(\'http://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '\', \'facebook\'); return false;">
                                        <i class="fa fa-size-' . $size . ' fa-facebook eog-social-' . $animation . '" id="facebook">
                                        </i>
                                    </a>';
        }
        if ( $options['show_tw'] ) {
            $socialstring .= '
                                    <a href="' . get_permalink() . '" rel="nofollow" title="' . __( 'Share in Twitter', 'eog-simplestsharebuttons' ) . '" target="_blank" onclick="eog_social_window(\'https://twitter.com/intent/tweet?text=' . urlencode( get_the_title() ) . '&url=' . $shortUrl . '&counturl=' . get_permalink() . '&related=PequeenMallorca&via=PequeenMallorca\', \'twitter\'); return false;">
                                        <i class="fa fa-size-' . $size . ' fa-twitter eog-social-' . $animation . '" id="twitter">
                                        </i>
                                    </a>';
        }
        if ( $options['show_gp'] ) {
            $socialstring .= '
                                    <a href="https://plus.google.com/share?url=' . get_permalink() . '" rel="nofollow" title="' . __( 'Share in Google+', 'eog-simplestsharebuttons' ) . '" target="_blank" onclick="eog_social_window(\'https://plus.google.com/share?url=' . get_permalink() . '\', \'gplus\'); return false;">
                                        <i class="fa fa-size-' . $size . ' fa-google-plus eog-social-' . $animation . '" id="gplus">
                                        </i>
                                    </a>';
        }
        if ( $options['show_wa'] && $esmovil ){
            $socialstring .= '
                                    <a href="whatsapp://send?text=' . rawurlencode( get_the_title() . ' - ' . $shortUrl ) . '" rel="nofollow" title="' . __( 'Share in WhatsApp', 'eog-simplestsharebuttons' ) . '">
                                        <i class="fa fa-size-' . $size . ' fa-whatsapp eog-social-' . $animation . '" id="whatsapp">
                                        </i>
                                    </a>
            ';
        }
        if ( $mostrarsocial ) {
            $socialstring .= '
                                </div>
                            </div>
                            <div style="clear:both;"></div>
            ';
        }
    }

    switch ($options['position']) {
        case '1':
            return $socialstring . $content;
            break;
         
        case '2':
            return $content . $socialstring;
            break;
         
        case '3':
            return $socialstring . $content . $socialstring;
            break;
         
        default:
            return $content;
            break;
    }
}

add_action( 'the_content', 'eog_simplestsharebuttons_content' );
