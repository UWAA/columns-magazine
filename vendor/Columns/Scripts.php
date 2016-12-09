<?php namespace Columns;
/**
 * This is where all the JS files are registered
 *    Modified version of the UW-2014 Script loader.  Yanking out jquery, child theme stuff as they already call it.  Mirronring 
 *    their approach to loading admin and public and site scripts.  
 *    Also loading our scripts in the footer...
 */

class Scripts
{

  private $SCRIPTS;
  // private $SUPPORT_SCRIPTS;


  function __construct()
  {

    $this->SCRIPTS = array_merge( array(
      
      'site'   => array (
        'id'      => 'columns.site',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/columns.site' . $this->dev_script() . '.js',
        'deps'    => array(),
        'version' => '1.0.3',
        'in_footer' => true,
        'admin'   => false
      ),

      'admin' => array (
        'id'      => 'columns.wp.admin',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/admin/admin.js',
        'deps'    => array(),
        'version' => '1.0',
        'in_footer' => true,
        'admin'   => true
      ),
    

    ));

  

    $this->SUPPORT_SCRIPTS = array_merge( array(
    'isotope'   => array (
        'id'      => 'isotope',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/libraries/isotope/dist/isotope.pkgd.min.js',
        'deps'    => array('jquery'),
        'version' => '2.0.1',
        'in_footer' => true,
        'admin'   => false
      ),      
      'flickity'   => array (
        'id'      => 'flickity',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/libraries/flickity/dist/flickity.pkgd.min.js',
        'deps'    => array(),
        'version' => '2.0.5',
        'in_footer' => true,
        'admin'   => false
      ),
      'isotope-packery'   => array (
        'id'      => 'isotope-packery',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/libraries/isotope-packery/packery-mode.pkgd.min.js',
        'deps'    => array('isotope'),
        'version' => '2.0.0',
        'in_footer' => true,
        'admin'   => false
      ),      
      'homepage'   => array (
        'id'      => 'homepage',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/support/homePageInit.js',
        'deps'    => array(),
        'version' => '1.0.0',
        'in_footer' => true,
        'admin'   => false
      ),

    ));

    add_action( 'wp_enqueue_scripts', array( $this, 'columns_register_default_scripts' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'columns_register_support_scripts' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'columns_enqueue_default_scripts' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'columns_enqueue_admin_scripts' ) );

  }

  function columns_register_default_scripts()
  {
      
      foreach ( $this->SCRIPTS as $script )
      {
        $script = (object) $script;

        wp_register_script(
          $script->id,
          $script->url,
          $script->deps,
          $script->version,
          $script->in_footer
        );

      }

  }

  //Used to register, but not necessarily Enqueue certain scripts unless needed.  Scripts can be loaded on specific templates as necessary.

  public function columns_register_support_scripts()
  {
      
      foreach ( $this->SUPPORT_SCRIPTS as $script )
      {
        $script = (object) $script;

        wp_register_script(
          $script->id,
          $script->url,
          $script->deps,
          $script->version,
          $script->in_footer
        );

      }

  }

  function columns_enqueue_default_scripts()
  {
      foreach ( $this->SCRIPTS as $script )
      {
        $script = (object) $script;

        if ( ! $script->admin )
          wp_enqueue_script( $script->id );
      }
  }

  function columns_enqueue_admin_scripts()
  {
      if ( ! is_admin() )
        return;

      foreach ( $this->SCRIPTS as $script )
      {
        $script = (object) $script;

        if ( $script->admin )
        {

          wp_register_script(
            $script->id,
            $script->url,
            $script->deps,
            $script->version
          );

          wp_enqueue_script( $script->id );

        }
      }

  }

  public function dev_script()
  {
    return is_user_logged_in() ? '.dev' : '';
  }

  public function min_script()
  {
    return !is_user_logged_in() ? '.min' : '';
  }

}