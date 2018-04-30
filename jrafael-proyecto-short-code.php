<?php
/*
Plugin Name: jrafael-proyecto-short-code
Plugin URI: 
Description: short code para listar post types proyecto
Version: 1.0
Author: j Rafael simarro
Author URI: http://juanrafaelsimarro.com
License: GPL2
*/

function add_css_proyects(){ ?>
    <style>
        
        .proyectos-area .proyecto{
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50%;
            min-height: 250px;
            margin-bottom:1rem;
            
        }
        .proyectos-area .proyecto img{
           height:100%;
        }

        .proyectos-area .proyecto .info:hover{
            opacity:1;
        }
        .proyectos-area .proyecto .info:hover p{
            transform:translateY(0);
        }

        .proyectos-area .proyecto .info{
            position:absolute;
            top:0;
            left:0;
            bottom:0;
            right:0;
            background-color:rgba(0,0,0,0.75);
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            z-index:999999;
            opacity:0;
            transition: opacity .4s;
           
        }
        .proyectos-area .proyecto .info a{
            display:block;
        }
        .proyectos-area .proyecto .info a .read-more{
            
            padding:.5rem;
            font-size: 1rem;
            color: #d6cfcf;
            border:1px solid;
            display:block;
            width: 6rem;
            margin:1rem auto 0;
                  
        }
                
        .proyectos-area .proyecto .info p{
            color:white;
            text-align:center;
            margin:0;
            font-size:1rem;
            padding:0 .5rem;
            transform:translateY(-150%);
            transition: all .4s;

        }

        .proyectos-area .proyecto h2{
            font-weight: 100;
            text-align: center;
            padding: 5px;
            color: white;
            background: #ce2020;
            font-size:1.2rem;
            position: absolute;
            z-index: 1;
            top: .6rem;
            box-shadow: 2px 2px 7px rgb(27, 21, 21);
            transition: opacity .4s;
            
        }
        .proyectos-area .proyecto:hover h2{
            opacity:0;
        }

        .proyectos-area .proyecto img{
           
        }

        @media (min-width: 1024px) {
            .proyectos-area {
                display:grid;
                grid-template-columns:repeat(auto-fill,48%);
                grid-gap:4px;
            }
            .proyectos-area .proyecto{
                margin-bottom:0;
            }
            
        }
    </style>
<?php
}
add_action( 'wp_head', 'add_css_proyects');

function shortcode_proyectos($content = null) {
    ob_start();
    ?>
        <div class="proyectos-area">
        <?php $query = new WP_Query( array(
                'post_type' => 'proyecto',
                'posts_per_page' => 10,
            ));

            if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background-image:url(<?php echo esc_url(get_the_post_thumbnail_url());?>)">
                    
                      <?php //if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
                            <?php //the_post_thumbnail()?>
                        <?php //endif; ?>
                   
                        <h2 class="post-title"><?php the_title(); ?></h2>
                        <div class="info">
                            <a href="<?php echo esc_url(get_the_permalink()); ?>">
                                <?php 
                                    
                                 echo sprintf('<p>%s</p>',wp_trim_words(get_the_excerpt(), 10, ' &hellip;<span class="read-more">Leer Mas</span>'));?>
                            </a>
                        </div>
                </article>
            <?php endwhile; wp_reset_postdata(); endif;?>

            </div>
        <?php $content = ob_get_contents();  ob_end_clean();

        return $content;
    }

add_shortcode('proyectos', 'shortcode_proyectos');
?>