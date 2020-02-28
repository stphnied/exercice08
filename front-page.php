<?php
/**
 * The template for displaying all page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astral
 * @since 0.1
 */
get_header();
/* 
* Functions hooked into astral_top_banner action
* 
* @hooked astral_inner_banner
*/
do_action( 'astral_top_banner' );
/* 
* Functions hooked into astral_breadcrumb_area action
* 
* @hooked astral_breadcrumb_area
*/
do_action( 'astral_breadcrumb_area' );
?>
<div id="content">
    <section class="align-blog" id="blog">
        <div class="container">
            <div class="row">
                <!-- left side -->
                <div class="col-lg-8 single-left mt-lg-0 mt-4">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( 'post', 'page' );
                    endwhile;
                    endif;
                                    // !!!!!!!!!! NOUVELLE
                    echo '<h2>' . category_description( get_category_by_slug( 'nouvelle' ) ) . '</h2>';
                    $args = array(
                        "category_name" => "nouvelle",
                        "posts_per_page" => "3"
                        // "orderby" => "date",
                        // "order" => "DESC"
                    );

                    // The Query
                    $query1 = new WP_Query( $args );
                    
                    // The Loop
                    while ( $query1->have_posts() ) {
                        $query1->the_post();
                        echo '<h2>' . get_the_title() . '</h2>';
                        echo '<p>' . substr(get_the_excerpt(), 0, 200) . '</p>';
                    }
                    
                    /* Restore original Post Data 
                    * NB: Because we are using new WP_Query we aren't stomping on the 
                    * original $wp_query and it does not need to be reset with 
                    * wp_reset_query(). We just need to set the post data back up with
                    * wp_reset_postdata().
                    */
                    wp_reset_postdata();
                    
                    
                    /* The 2nd Query (without global var) */
                    $args2 = array(
                        "category_name" => "evenement",
                        "posts_per_page" => "3"
                    );

                    $query2 = new WP_Query( $args2 );
                    
                    // The 2nd Loop
                    while ( $query2->have_posts() ) {
                        $query2->the_post();
                        echo '<li>' . get_the_title( $query2->post->ID ) . '</li>';
                        the_post_thumbnail('thumbnail');
                    }
                    
                    // Restore original Post Data
                    wp_reset_postdata();
                     
					?>
                </div>
                <!-- right side -->
                <div class="col-lg-4 event-right">
					<?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
get_footer();