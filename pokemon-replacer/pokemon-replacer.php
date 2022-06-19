<?php
/**
* Plugin Name: Technical Machine TS69
* Description: DOM Evoluter -  Flip a coin. If heads, search your deck for a random Pokemon and place it on your opponent's image src, causing it to instantly evolve. The opponent's image is now confused.
* Version:     1.0.0
* Author:      Useless Plugins by ElementOracle
* Author URI:  https://elementoracle.com/useless
*

***********************************************
***********************************************
To use:
1) Add this short code to any poast: [evolve]
2) View the post in the front end and add ?evolve=someurl.com to the end of your URL.

Example: https://yourwebsite.com/page-with-shortcode/?evolve=https://old.reddit.com

This shortcode fires the function evoluter() which grabs the target html, parse the DOM, and replaces all img src attributes. This is meant for educational purposes, to give an example of manipulating the DOM via PHP.

***********************************************
***********************************************
*/

//load the dom parser library into the Technical Machine
include_once( 'simple_html_dom.php' );

//Get random card
function replace_with() {
  //Generates a random number between 1 and 69 and grabs the image
  $random_number = rand( 1, 69 );
  $img_src = "https://images.pokemontcg.io/base1/" . $random_number . "_hires.png";
  return $img_src;
}
//Evolve the images from a provided URL:
function evoluter() {
  if ( $_GET[ 'evolve' ] ) {
    $url = $_GET[ 'evolve' ];

    $html = file_get_html( $url );


    //evolve all images
    foreach ( $html->find( 'img' ) as $e ) {
      $e->outertext = '<img class="evolved" width="100%" src="' . replace_with() . '">';
    }
    //render the final html
    return $html;
  } else {
    return false;
  }
}

//add the shortcode [evolve] that executes the evoluter() function
add_shortcode( 'evolve', 'evoluter' );