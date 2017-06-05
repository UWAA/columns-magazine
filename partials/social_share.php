<?php
$twitterIntentExcerpt = '?text=' . urlencode(get_the_excerpt());
$twitterIntentURL = '&url=' . urlencode(get_the_permalink());
$twitterIntentBaseURL = 'https://twitter.com/intent/tweet';

$compiledTwitterIntentURL = $twitterIntentBaseURL . $twitterIntentExcerpt . $twitterIntentURL; 
 ?>
<div class="social-share-container">
    <div class="row">
    <ul class="social-share">
                    <li><a href="#" id="shareBtn" class="facebook"><span class="offscreen">Columns Magazine Facebook</span></a></li>
                    <li><a href="<?php echo $compiledTwitterIntentURL ?>" class="twitter"><span class="offscreen">@ColumnsMag</span></a></li>
                    <li><a href="#" class="linkedin"><span class="offscreen">@ColumnsMag</span></a></li>
                    <li><a href="#" class="email"><span class="offscreen">@ColumnsMag</span></a></li>                    
    </ul>
    </div>
    <hr>
</div>