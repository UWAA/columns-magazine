<?php
//Twitter Button
$twitterIntentBaseURL = 'https://twitter.com/intent/tweet';
$twitterIntentExcerpt = '?text=' . urlencode(get_the_excerpt());
$twitterIntentURL = '&url=' . urlencode(get_the_permalink());


$compiledTwitterIntentURL = $twitterIntentBaseURL . $twitterIntentExcerpt . $twitterIntentURL; 


// Email Link
// $emailSubject = '&subject=Columns Magazine -- ' . get_the_title();
// $bodyCopy = "I thought you would like this article on Columns Magazine:  " . get_the_permalink() ;
// $emailBody = '?body=' . $bodyCopy;

$compiledMailLink = "mailto:" . $emailBody . $emailSubject;

// LinkedIn URL
$linkedInShareBaseURL = "https://www.linkedin.com/shareArticle?mini=true";
$linkedInURL = $twitterIntentURL; //same as Twitter, starts with and
$linkedInTitle = '&title=' . get_the_title();
$linkedInSummary = '&summary=' .urlencode(get_the_excerpt());

$compiledLinkedInLink = $linkedInShareBaseURL . $linkedInURL . $linkedInTitle . $linkedInSummary;


;
 ?>

<div class="social-share-container">  
<div class="row">
    <hr>  
    <ul class="social-share">
                    <li><a href="#" id="shareBtn" class="facebook"><span class="offscreen">Columns Magazine Facebook</span></a></li>
                    <li><a href="<?php echo $compiledTwitterIntentURL ?>" target="_blank" class="twitter"><span class="offscreen">@ColumnsMag</span></a></li>
                    <li><a href="<?php echo $compiledLinkedInLink ?>" target="_blank" class="linkedin"><span class="offscreen">@ColumnsMag</span></a></li>
                    <li><a href="#comments" class="comments"><span class="offscreen">Jump To Comments</span></a></li>                    
    </ul>

<hr>
    </div>    

</div>
