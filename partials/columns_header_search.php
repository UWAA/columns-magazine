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

        

        <a href="https://www.uw.edu/alumni">
          <div class="uwaa-logo"></div>
        </a>


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



      </div>  <!-- end masthead-search header -->


      




      <!-- here for header menu -->


    </nav>

  </div>


