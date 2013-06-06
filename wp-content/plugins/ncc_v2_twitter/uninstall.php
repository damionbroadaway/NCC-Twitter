<?php

    if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
        exit ();

    delete_option( NCC_V2_TWITTER_OPTION_GROUP );