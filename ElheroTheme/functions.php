<?php
require_once("wp-bootstrap-navwalker.php");

//add featured img support
add_theme_support('post-thumbnails');

/*
** function add custom Styles
**Add By @mostafa
**wp_enqueue_style()
*/
/*
** wp_enqueue_style( handle, src, deps, media )
** wp_enqueue_script( handle, src, deps, media )
** handle : the require name of stylesheet
** src    : the url of stylesheet
** deps   : array of register stylesheet type array
** media  : responsive website type boolean
** infooter : exist only in wp_enqueue_script and have type boolean
*/
function add_style()
{
    wp_enqueue_style(
    'bootstrap'
    , get_template_directory_uri().'/css/bootstrap.min.css'
    );
    wp_enqueue_style(
        'fontawesome'
        , get_template_directory_uri().'/css/font-awesome.min.css'
        );
    wp_enqueue_style(
            'main'
            , get_template_directory_uri().'/css/main.css'
        );   

}
function add_script()
{
    
    wp_deregister_script('jquery');//remove register jquery
    wp_register_script('jquery',includes_url("js/jquery/jquery.js"),true,'', true );
    wp_enqueue_script('jquery');// will put jquery script if you not register will put script tag in head tag 
    wp_enqueue_script(
    'bootstrap-js',
    get_template_directory_uri().'/js/bootstrap.min.js',
    array('jquery'),
    
    /*
     mean put jquery because bootstrap depend on jquery
     but will but jquery in the head tag
    */
    false,
    true //to put before end of the body the default is false
    );
    wp_enqueue_script(
        'scroll-js',
        get_template_directory_uri().'/js/jquery.nicescroll.min.js',
        array('jquery'),
        
        /*
         mean put jquery because bootstrap depend on jquery
         but will but jquery in the head tag
        */
        false,
        true //to put before end of the body the default is false
        );
    wp_enqueue_script(
        'main-js',
         get_template_directory_uri().'/js/main.js',
        array(),
        false,
        true    // to put before end of the body the default is false
    );
    wp_enqueue_script( "html5shilv", get_template_directory_uri().'/js/html5shilv.js' );
    wp_script_add_data( "html5shilv", 'conditional', 'lt IE 9' );//to use only if IE Version leth than 9
    wp_enqueue_script( "respond", get_template_directory_uri().'/js/respond.js' );
    wp_script_add_data( "respond", 'conditional', 'lt IE 9' );
    //wp_script_add_data( "respond", 'use as', 'condition' );
    //to use only if internetExploler Version leth than 9

}
/*
* Add Custom Menu Support
* Added By @mostafa
*register_nav_men(location,description);
*/

function elhero_register_menu()
{
    //register_nav_menu('bootstrap-menu',__('Bootstrap Navigation Bar'));
    register_nav_menus( array(
        'bootstrap-menu' => 'Bootstrap Navigation Bar',//create location
        'footer-menu'    => 'Footer-menu'//to add new location to wordpress dashboard menu 
        //name => location_name
    ) );
}

function elhero_bootstrap_menu()
{
    wp_nav_menu(array(
        //theme_location => 'the name you give to the created location'
        'theme_location' => 'bootstrap-menu',
        //if you put any name not exist on themem location will show website custom menu
        'menu_class'     => 'nav navbar-nav navbar-right',//giv bootstrap class
        'container'      => false, //to remove the div parent from ul
        'depth'          => 2,
        'walker'         => new WP_Bootstrap_Navwalker() 
    ));
}

function elhero_sidebar()
{
    //you can register more than one sidebar
    register_sidebar( array(
        'name'          =>  'MainSidebar',
        'id'            =>  'main-sidebar',
        'description'   =>  'appear evry were',
        'class'         =>  'main_sidebar',
        'before_widget' =>  '<div class="widget-content">',
        'after_widget'  =>  '</div>',
        'before_title'  =>  '<h3 class="widget-title">',
        'after_title'   =>  '</h3>'
    ));
}
add_action('widgets_init','elhero_sidebar');

function number_pagination()
{
    global $wp_query;//$wp_query variable in wordpress its object from WP_QUERY class
    $all_pages=$wp_query->max_num_pages;
    $current_page=max(1,get_query_var('paged'));
    //max(return the hieghst number),get_query_var() return current page number
    if($all_pages>1)//check have more than one page
    {
        return paginate_links(array(
            'base'          => get_pagenum_link() .'%_%',
            'format'        =>  'page/%#%/',
            'current'       =>  $current_page,
            'mid_size '     => 2 ,
            'end_size'      => 2
           /*
            'end_size'  => is numbers of page links in end after and before ...
            'mid_size ' =>  is the default value mean the numbers
             page link before and after curren page link 
            'total'         => number of  pages the default is "number of all pages" ,
            'prev_text'     => the default is "Previous" its the text put on the link  ,
            'next_text'     =>  the default is "Next" its the text put on the link ,
            'prev_next'     => (boolean) icluding the links previous and next
            */
        ));
    }

}
function get_comments_count(){
        # get Comments Post Count
   $comments_args=array('statues'=>'approve');//only approved comments
   $comments_count=0; 
   $all_comments=get_comments( $comments_args );
   foreach($all_comments as $comment)
   {
       $post_id = $comment->comment_post_ID;//get post id of comment
       if(in_category('html',$post_id))
       {
            $comments_count++;
       }
   }
   return $comments_count;
}
function get_posts_count(){
    # get category Posts Count
   $cat=get_queried_object();
   /*
   get_queried_object(); return object from WP_Term Object class
   have attributes(
    [term_id] => category_id
    [name] => category_name
    [slug] => category_slug
    [description] => hmlt 5.1 relased
    [parent] => category_parent id
    [count] => posts_count
    [cat_ID] => category_id
    [category_count] => posts_count
    [category_description] => hmlt 5.1 relased
    [cat_name] => html
    [category_nicename] => html
    [category_parent] => 0
   )
    echo $cat->cat_ID;

    get_queried_object_id() return category id
   */
   $posts_count=$cat->count;
   return $posts_count;
}

/**
*Customize The Except Word Lenght
**/

function elhero_excerpt_lenght($length)
{
    if(is_author())//if you are in author page return 15 words
    {
        return 15;
    }elseif(is_category()){
        return 60;
    }
    else{
        return 40;
    }
    
}
add_filter( 'excerpt_length','elhero_excerpt_lenght');

function change_excerpt_shape()
{
    return ' ...';
}
add_filter('excerpt_more', 'change_excerpt_shape');

function posts_link_next() {
    return 'class="next"';
}
function posts_link_prev()
{
    return 'class="prev"';
}
add_filter('next_posts_link_attributes', 'posts_link_next');
add_filter('previous_posts_link_attributes', 'posts_link_prev');

#function remove paragraph from post content
function elhero_remove_paragraph($content)
{
    remove_filter( 'the_content','wpautop');#wpautop create auto paragraph
    return $content;
}
add_filter('the_content','elhero_remove_paragraph',0);
#0 mean order to execute the first thing

//add_action('wp_enqueue_scripts','function name')
add_action('wp_enqueue_scripts','add_style');
add_action('wp_enqueue_scripts','add_script');
add_action( 'init','elhero_register_menu');

