jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.ncc_v2_twitter_shortcode_plugin', {
        init : function(ed, url) {
            // Register command for when button is clicked
            ed.addCommand('ncc_v2_twitter_insert_shortcode', function() {

                    content =  '[tweets]';

                tinymce.execCommand('mceInsertContent', false, content);
            });

            // Register buttons - trigger above command when clicked
            ed.addButton('ncc_v2_twitter_admin_editor_shortcode_button', {text: 'Insert Tweets', title: 'Insert Tweets', cmd: 'ncc_v2_twitter_insert_shortcode', image: url + '/twitter.png'});
        }
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('ncc_v2_twitter_admin_editor_shortcode_button', tinymce.plugins.ncc_v2_twitter_shortcode_plugin);
});