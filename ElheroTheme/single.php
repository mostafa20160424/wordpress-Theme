<?php get_header();
 //like include "header.php"
 include (__DIR__."/includes/breadcrumb.php");
 //get_template_directory()=__DIR__
 
 ?>



<div class="container single-page">
<?php
    if (have_posts()) {
        while(have_posts())
        {
            the_post();?>
            
            <div class="main-post single-post">
                <?php
                edit_post_link('Edit<i class="fa fa-pencil"></i>');
                //edit_post_link( text, before, after, id, class )
                ?>
                <h3 class='post-title'>
                    <a href="<?php the_permalink() ?>">
                    <!--the_permalink() use for when you click on post title move to signal post page-->
                    <?php the_title() ?>
                    </a>
                </h3>
                <span class="post-author">
                    <i class="fa fa-user fa-fw "></i>
                    <?php the_author_posts_link(); ?>
                </span>
                <span class="post-date">
                    <i class="fa fa-calendar fa-fw "></i>
                    <?php the_time("F j,Y"); ?>
                </span>
                <span class="post-comments">
                    <i class="fa fa-comments fa-fw fa-lg"></i>
                    <?php
                     comments_popup_link('No-Comments','One Comment','% Comments','comment_url','comment-disabled');
                    /* comments_popup_link(
                    'display text case no comment'
                     ,'display text case one comment'
                     ,'display text case more than one comment'
                     ,'comment class','display text case comment disabled for this post');
                     */
                     ?>
                </span>
                    <div class="row">
                        <div class="col-md-6">
                        <?php
                            the_post_thumbnail('',
                            ['class'=>'img-responsive img-thumbnail']);
                            //the_post_thumbnail(size,attr);
                            //size:thumbnail,medium,large,full
                            ?>
                        </div>
                        <div class="col-md-6">
                            <p class="post-content">
                            <?php the_content() ?>
                            </p>
                        </div>
                    </div>

                <hr>
                <span class="post-categories">
                    <i class="fa fa-tags fa-fw "></i>
                    <?php  the_category(',') ?>    
                </span>
                <span class="post-tags">
                     
                    <?php
                    if(has_tag())
                    {
                        the_tags();//the_tags(before,mid,after) 
                    }else{
                        echo "<br>There's no Tags in This Post";
                    }
                     
                     ?>    
                </span>      
            </div>
            <hr>   
           <?php
           ?>
        <div class="container myinfo">
        <div class="row">
            <div class="col-md-2 img">
                <?php
                $avatar_args=array(
                    'class'=>'img-responsive img-thumbnail center-block'
                );
                    echo get_avatar( get_the_author_meta('ID'),64,'','user-avatar',$avatar_args );
                    //get_avatar( id,size,,alttext )
                ?>
            </div>
            <div class="col-md-10 author-info">
                <h4>
                <?php the_author_meta('first_name') ?>
                <?php the_author_meta('last_name') ?>
                (<span><?php the_author_meta('nickname') ?></span>)
                </h4>
                    <p>
                    <?php
                    if(get_the_author_meta('description'))
                    {
                            the_author_meta('description');
                            /*
                            the_author_meta('ID');
                            the_author_meta('column info');
                            */
                    }
                    else{
                        echo "There is no biography";
                    }
                   ?>
                    </p>
                </div><!--end col-10-->
            </div><!--end row myinfo -->

                <!-- start posts count-->
                <p class="author-stats">
                        Users Posts Count:
                        <span class="posts-count">
                            <?php
                                echo count_user_posts(get_the_author_meta('ID'));
                            ?>
                        </span>
                        <br>
                        Users Profile links:
                            <?php
                                the_author_posts_link();
                            ?>
                </p>
                <!-- end posts count-->
            </div><!-- end container-->
       <hr>
        

        <?php
    echo "<div class='post-pagination'>";
        $nextPost = get_next_post();
        //get_next_post(); return object of next post then you can use $nextPost->columne name in DB
        if($nextPost) {
        $nextThumbnail = get_the_post_thumbnail($nextPost->ID, array(20,20) );//array(width,height)
        next_post_link("%link","$nextThumbnail  %title");
        } else {
        echo "<span class='span-next'>This is the most recent post</span>";
        }
        $previousPost = get_previous_post();
        if($previousPost) {
        $previousThumbnail = get_the_post_thumbnail($previousPost->ID, array(20,20) );
        previous_post_link("%link","$previousThumbnail  %title");
        } else {
        echo "<span class='span-prev'>This is the oldest post</span>";
        }
    echo '</div>';
    echo '<hr>';
           
            //the title() can take before,after string to display in the title
        }
       
    }
    $category=get_the_category();
    //get_the_category() return the post category as array
    $cat_id=get_cat_ID($category[0]->name);
    $posts_count=6;
    $post_args=array(
        'author'        => get_the_author_meta('ID'),
        'posts_per_page'=>$posts_count,
         //will show 5 posts if -1 will show all posts
        //the benfit if you limit posts to show in wordpress settings
        'cat'           =>$cat_id,
        'orderby'       =>'rand',
        'statues'       =>'publish',
        'post__not_in'  =>array(get_the_ID())
        //get_the_ID() return post id
    );
    $author_posts=new WP_QUERY($post_args);
    if ($author_posts->have_posts()) {
        echo "<h3 class='post-h3'>";
            if(count_user_posts(get_the_author_meta('ID'))<$posts_count)
            {
                echo the_author_meta('nickname').' Posts';
            }
            else{
                echo 'Latest ['.$posts_count.'] Posts Of ';
                the_author_meta('nickname');
            }
        echo "</h3>";
        while($author_posts->have_posts())
        {
            $author_posts->the_post();?>
            <div class="col-sm-12">
                <div class="author-post s">
                    <div class="media-left">
                        <?php
                          the_post_thumbnail('',
                          ['class'=>'img-responsive img-thumbnail media-object media-middle']);
                    //the_post_thumbnail(size,attr);
                    //size:thumbnail,medium,large,full
                         ?>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            <h3 class='post-title'>
                                <a href="<?php the_permalink() ?>">
                                <!--the_permalink() use for when you click on post title move to signal post page-->
                                <?php the_title() ?>
                                </a>
                            </h3>
                        </div>
                        <span class="post-author">
                            <i class="fa fa-user fa-fw "></i>
                            <?php the_author_posts_link(); ?>
                        </span>
                        <span class="post-date">
                            <i class="fa fa-calendar fa-fw "></i>
                            <?php the_time("F j,Y"); ?>
                        </span>
                        <span class="post-comments">
                            <i class="fa fa-comments fa-fw fa-lg"></i>
                            <?php
                            comments_popup_link('No-Comments','One Comment','% Comments','comment_url','comment-disabled');
                            /* comments_popup_link(
                            'display text case no comment'
                            ,'display text case one comment'
                            ,'display text case more than one comment'
                            ,'comment class','display text case comment disabled for this post');
                            */
                            ?>
                        </span>
                        <p class="post-content">
                        <?php
                         the_excerpt(); 
                         ?>
                        </p>
                        <hr>
                        <span class="post-categories">
                            <i class="fa fa-tags fa-fw "></i>
                            <?php the_category(',') ?>    
                        </span>
                        <br>
                        <span class="post-tags">
                            
                            <?php
                            if(has_tag())
                            {
                                the_tags();//the_tags(before,mid,after) 
                            }else{
                                echo "There's no Tags in This Post";
                            }
                            
                            ?>    
                        </span>  
                    </div>    
            </div>
           <?php 
            //the title() can take before,after string to display in the title
        }
       
    }
    else{
        echo '<div class="alert alert-danger">No Related <strong>Posts</strong> to Display</div>';
    }

?>
    
<?php comments_template('/comments.php',false); ?>
</div><!-- end container -->
<?php get_footer(); //like include "footer.php" ?>
