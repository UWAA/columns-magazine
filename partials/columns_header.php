  <div class="container-fluid">

    <nav class="columns-navbar navbar">

      <div class="masthead-search-header">

        <div class="masthead">



          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">        
            <div class="masthead-logo">
              <div class="columns-logo">
                <img src="<?php echo get_stylesheet_directory_uri();  ?>/assets/artboard2-02.svg" alt="Columns Online Logo" />    
              </div>
              <div class="subtitle">
                <p>The University of Washington<br class="hidden-xs"> Alumni Magazine</p>
              </div>
            </div>
          </a>


        </div>

        <div class="uwaa-branding-search">      

          <div class="search">
            <div class="columns-form search-form search-widescreen">
              <form role="search" method="get" id="search-form-widescreen" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input id="Search" name="s" type="search" spellcheck="false" placeholder="Search Columns" class="columns-search-input-field" value="<?php  echo esc_attr( get_search_query() ); ?>" maxlength="255">
                <input id="searchSite" name="search" class="inlineSubmit" type="submit" value="Search" class="columns-search-input-submit">
              </form>
            </div>
            <div id="icon-search">
              <svg viewbox="103 30 43.73 43.73">

                <g>
                  <path class="glass" d="M119.78,50.59a6.07,6.07,0,1,0,6.08-6.07,6.07,6.07,0,0,0-6.08,6.07h0Zm-1.76,0a7.83,7.83,0,1,1,7.83,7.83h0A7.84,7.84,0,0,1,118,50.59h0" />    
                  <rect class="handle" x="113.94" y="57.46" width="7.86" height="1.97" transform="translate(-6.83 100.38) rotate(-44.96)"/>
                  <circle class="outer-circle" cx="124.87" cy="51.86" r="20.78" style="fill:none"/>
                  <rect x="103" y="30" width="43.73" height="43.73" style="fill:none"/>
                </g>
              </svg>
            </div>

          
        </div>

        <a href="https://www.uw.edu/alumni">
          <div class="uwaa-logo"></div>
        </a>


          </div> 




      </div>  <!-- end masthead-search header -->


 <div class="search search-mobile">
              <div class="columns-form search-form">
                <form role="search" method="get" id="search-form-mobile" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <input id="Search" name="s" type="search" spellcheck="false" placeholder="Search Columns" class="columns-search-input-field" value="<?php  echo esc_attr( get_search_query() ); ?>" maxlength="255">
                  <input id="searchSite" name="search" class="inlineSubmit" type="submit" value="Search" class="columns-search-input-submit">
                </form>
              </div>        
            </div> 



      <div class="columns-navigation-row" role="navigation">
        <div id="navbar-button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        MENU
        </div>

        <?php wp_nav_menu(array(
          'menu' => 'Header Navigation',
          'menu_class' => 'columns-main-nav-ul',
          'menu_id' => 'columns-main-navigation',
          'container_id' => 'columns-navigation-container',
          'item_spacing' => 'discard'
          )
        );
        ?>

      </div>




      <!-- here for header menu -->


    </nav>

  </div>


