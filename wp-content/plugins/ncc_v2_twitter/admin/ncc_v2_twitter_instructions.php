<div class='wrap'>
    <h2>Instructions</h2>
    <ol>
        <li><a href="https://dev.twitter.com/apps" target="_blank">Create a Twitter app.</a></li>
        <li>Enter the values into the form below.</li>
        <li>Select a Twitter use.</li>
        <li>Set cache duration. Use minutes.</li>
        <li>Insert the shortcode <code>[tweets]</code> on any page or post to view tweets.</li>
            <ol>
                <li>Alternate option: insert <code>show_tweets();</code> into any template file.</li>
            </ol>
        <li>Pulls in latest 20 Tweets.</li>
        <li>Enjoy.</li>
    </ol>
    <h2>Hello Nerdery Code Reviewer!</h2>
    <p>First, you sure do look good today. Your eyes just seem to sparkle.</p>
    <p>So, there are a couple things that would not make into a final plugin but will make things easier for you.
            You do not have to create a Twitter app. Just enter the example values under the text fields. They are from the app I used to make this.</p>
    <p>You will see a little non-standard code in ncc_v2_twitter_tweets.php.
        It's to show you - the reviewer- if the cache is working. Hover over the title. Red is a json call while green is from the cache.
            I suggest you set the cache to 1 minute. Makes it really easy to see.
            You will also see a little js there as well. Just something I wanted to see in action. Wouldn't actually use in production.</p>
    <p>You can find this plugin on <a href="https://github.com/damionbroadaway/NCC-Twitter/tree/master/wp-content/plugins/ncc_v2_twitter" target="_blank">GitHub</a>.</p>
</div>