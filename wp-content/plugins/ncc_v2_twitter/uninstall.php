<?php

    if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
        exit ();

    if ( get_option('ncc_v2_twitter_admin_options') )
        delete_option( 'ncc_v2_twitter_admin_options' );