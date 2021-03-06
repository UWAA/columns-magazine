    <div class="container-fluid">
        <div id="uwaa-footer" class="uw-footer">
            <nav role="navigation" aria-label="uwaa social networking" class="social-icons">
                <ul class="uwaa-social">
                    <li><a href="https://www.facebook.com/ColumnsMagazine/" class="facebook"><span class="offscreen">Columns Magazine Facebook</span></a></li>
                    <li><a href="https://twitter.com/@ColumnsMag" class="twitter"><span class="offscreen">@ColumnsMag</span></a></li>                    
                </ul>
            </nav>
            <nav role="navigation" aria-label="about uwaa and join" class="contact-links">            
            <div>
                <ul class="footer-links">
                    <li><a href="<?php echo home_url('/contact-columns'); ?>">Contact Columns</a></li>                    
                    <li><a href="<?php echo home_url('/about'); ?>">About</a></li>
                    <li><a href="<?php echo home_url('/manage-your-subscription'); ?>">Subscribe</a></li>
                    <li><a href="<?php echo home_url('/update-your-information'); ?>">Update your info</a></li>
                </ul>                   
            </div>
            </nav>
            
            <div class="uwaa-logo">
            <a href="http://www.uw.edu/alumni">
                <?php get_template_part('assets/uwaa', 'logo.svg');?>
            </a>
            </div>
            
        </div>
    </div>
    <div class="uw-footer">

        <a href="http://www.washington.edu" class="footer-wordmark">University of Washington</a>

        <a href="http://www.washington.edu/boundless/"><h3 class="be-boundless">Be boundless</h3></a>

        <h4>Connect with us:</h4>

        <nav role="navigation" aria-label="social networking">
            <ul class="footer-social">
                <li><a class="facebook" href="http://www.facebook.com/UofWA">Facebook</a></li>
                <li><a class="twitter" href="http://twitter.com/UW">Twitter</a></li>
                <li><a class="instagram" href="http://instagram.com/uofwa">Instagram</a></li>
                <li><a class="tumblr" href="http://uofwa.tumblr.com/">Tumblr</a></li>
                <li><a class="youtube" href="http://www.youtube.com/user/uwhuskies">YouTube</a></li>
                <li><a class="linkedin" href="http://www.linkedin.com/company/university-of-washington">LinkedIn</a></li>
                <li><a class="pinterest" href="http://www.pinterest.com/uofwa/">Pinterest</a></li>
                <li><a class="vine" href="https://vine.co/uofwa">Vine</a></li>
                <li><a class="google" href="https://plus.google.com/+universityofwashington/posts">Google+</a></li>
            </ul>
        </nav>

        <nav role="navigation" aria-label="footer links">
            <ul class="footer-links">
                <li><a href="http://www.uw.edu/accessibility">Accessibility</a></li>
                <li><a href="http://uw.edu/home/siteinfo/form">Contact Us</a></li>
                <li><a href="http://www.washington.edu/jobs">Jobs</a></li>
                <li><a href="http://www.washington.edu/safety">Campus Safety</a></li>
                <li><a href="http://myuw.washington.edu/">My UW</a></li>
                <li><a href="http://www.washington.edu/admin/rules/wac/rulesindex.html">Rules Docket</a></li>
                <li><a href="http://www.washington.edu/online/privacy">Privacy</a></li>
                <li><a href="http://www.washington.edu/online/terms">Terms</a></li>
            </ul>
        </nav>


        <p role="contentinfo">&copy;	<?php echo date("Y") ?> University of Washington  |  Seattle, WA</p>


    </div>

    </div><!-- #uw-container-inner -->
    </div><!-- #uw-container -->

<?php 
wp_footer(); 
?>

</body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '745277895637735',
      xfbml      : true,
      version    : 'v2.9'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</html>