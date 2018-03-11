<?php
/*
Plugin Name: Secure WordPress REST API Access
Plugin URI: https://emanuelpoletto.com/
Description: Require authentication for accessing the WordPress REST API to improve security.
Version: 0.2.0
Author: Emanuel Poletto
Author URI: https://emanuelpoletto.com/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: swpra
*/

/*
Copyright Emanuel Poletto.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <https://www.gnu.org/licenses/>.
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



if ( ! class_exists( 'Swpra_Access' ) ) :



class Swpra_Access {



    public function __construct( $add_hooks = false ) {
        if ( $add_hooks ) {
            add_filter( 'rest_authentication_errors', array( $this, 'rest_authentication_errors' ) );
            add_action( 'init', array( $this, 'create_token' ) );
        }
    }



    public function get_hash() {
        return is_multisite() ? get_blog_option( 1, 'swpra_hash' ) : get_option( 'swpra_hash' );
    }



    public function set_hash( $token ) {
        $hash = password_hash( $token, PASSWORD_DEFAULT );
        return is_multisite() ? update_blog_option( 1, 'swpra_hash', $hash ) : update_option( 'swpra_hash', $hash );
    }



    public function generate_token() {
        return bin2hex( openssl_random_pseudo_bytes(32) );
    }



    public function create_token() {
        if ( isset( $_GET['swpra_token_gen'] ) && is_user_logged_in() && current_user_can( 'update_core' ) ) {
            echo $token = $this->generate_token();
            $this->set_hash( $token );
            exit;
        }
    }



    public function verify_token( $token = '' ) {
        if ( empty( $token ) && isset( $_GET['swpra_token'] ) ) {
            $token = $_GET['swpra_token'];
        }

        if ( empty( $token ) ) {
            return false;
        }

        $hash = $this->get_hash();

        return password_verify( $token, $hash );
    }



    public function rest_authentication_errors( $result ) {
        if ( ! empty( $result ) || $this->verify_token() ) {
            return $result;
        }

        if ( ! is_user_logged_in() || ! current_user_can( 'edit_posts' ) ) {
            return new WP_Error( 'rest_not_logged_in', __( 'You are not currently logged in.', 'swpra' ), array( 'status' => 401 ) );
        }

        return $result;
    }



}



new Swpra_Access( 'add_hooks' );



endif;