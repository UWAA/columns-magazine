<?php 
get_header("columns");
use \Columns\Utilities as Utilities;

?>
<div class="single-header">    
</div>

<div class="container-fluid">

    <div class="row">
        <div class="breadcrumbs">
            <?php uw_breadcrumbs() ?>
        </div> 
        <div class="content-tags">
            <!-- Fluid containter, 2 cols -->
        </div>
    </div>

    <div class="columns-feature-content">
        <div class="row">
            <?php


            while ( have_posts() ) : the_post(); 

            ?>

            <h1><?php the_title() ?></h1>

                <?php the_content(); 

                $headers = "?reference=COLUMNSMAGAZINE&hideComments=yes&personOrOrg=P";            
                ?>
            
            <div id="wufoo-z1ph7cqd01rkvsh">
Fill out my <a href="https://uwalum.wufoo.com/forms/z1ph7cqd01rkvsh">online form</a>.
</div>
<script type="text/javascript">var z1ph7cqd01rkvsh;(function(d, t) {
var s = d.createElement(t), options = {
'userName':'uwalum',
'formHash':'z1ph7cqd01rkvsh',
'autoResize':true,
'height':'862',
'async':true,
'host':'wufoo.com',
'header':'show',
'ssl':true};
s.src = ('https:' == d.location.protocol ? 'https://' : 'http://') + 'www.wufoo.com/scripts/embed/form.js';
s.onload = s.onreadystatechange = function() {
var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
try { z1ph7cqd01rkvsh = new WufooForm();z1ph7cqd01rkvsh.initialize(options);z1ph7cqd01rkvsh.display(); } catch (e) {}};
var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, 'script');</script>


            <?php                
            endwhile;

            ?>

        </div>
    </div>
</div>




<?php


get_footer(); 