<?php get_header( )?>
<div class="container author-page">
        <h1 class="text-center">
        <?php the_author_meta('nickname') ?>
        Page
        </h1>
    <div class="author-info">
    <div class="row">
        <div class="col-md-3">
        <?php
                $avatar_args=array(
                    'class'=>'img-responsive img-thumbnail center-block'
                );
                echo get_avatar( get_the_author_meta('ID'),196,'',' user-avatar ',$avatar_args );
                //get_avatar( id,size,,alttext )
                ?>
        </div>
        <div class="col-md-9">
            <ul class="list-unstyled">
                <li>first name : <?php the_author_meta('first_name') ?> </li>
                <li>last name : <?php  the_author_meta('last_name') ?> </li>
                <li>nick name : <?php the_author_meta('nickname') ?> </li>
            </ul>
            <hr>
            <p>
                <?php
                    if(get_the_author_meta('description'))
                    {
                            the_author_meta('description');
                    }
                    else{
                        echo "There is no biography";
                    }
                 ?>
            </p>     
        </div>
    </div>
    </div><!-- end author-info-->
    <div class="row author-stats">
        <div class=" stats">
            posts count
            <span><?php echo count_user_posts(get_the_author_meta('ID')) ?></span>
        </div>
        <div class=" stats">
            comment count
            <span>
                <?php
                 $comment_args_count=array(
                     'user_id'=>get_the_author_meta('ID'),
                     'count'  => true
                     //true mean return number ,false is the default mean return array
                 );
                 echo get_comments($comment_args_count);
                  ?>
            </span>
        </div>
        <div class=" stats">
            posts count
            <span>0</span>
        </div>
        <div class=" stats">
            comment count
            <span>0</span>
        </div>
    </div>
    <div class="row">
    <?php
    $posts_count=6;
    $post_args=array(
        'author'        => get_the_author_meta('ID'),
        'posts_per_page'=>$posts_count //will show 5 posts if -1 will show all posts
        //the benfit if you limit posts to show in wordpress settings
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
        </div>    
           <?php 
            //the title() can take before,after string to display in the title
        }
       
    }

?>
</div>
  <?php  
    wp_reset_postdata();//to reste the request
    $comments_count=6;
    $comment_args=array(
        'user_id'        => get_the_author_meta('ID'),
        'statues'        =>'approve',
        'number'         =>$comments_count,
        'post-statues'   =>'publish',
        'post_type'      =>'post'
    );
    $comments=get_comments($comment_args);
    ?>
    <div class="author-comments-list">
       <?php if($comments)
        {
        ?>    
            <?php
                echo "<h3 class='post-h3'>";
                    if(get_comments($comment_args_count) < $comments_count)
                    {

                        echo the_author_meta('nickname').' Comments';
                    }
                    else{
                        echo 'Latest ['.$comments_count.'] Comments Of ';
                        the_author_meta('nickname');
                    }
                echo "</h3>";
            ?>
            <?php    
            foreach($comments as $comment)
                { ?>
                    <div class="mycomment">
                        <h3>
                        <a href='<?php echo get_permalink($comment->comment_post_ID)?>'>
                            <?php echo get_the_title($comment->comment_post_ID); ?> 
                            </a>
                        </h3>
                        <span class="post-date">
                            <i class="fa fa-calendar fa-fw "></i>
                            <?php echo "Added on ". mysql2date('d,M,Y', $comment->comment_post_ID);  ?>
                        </span>
                        <p>
                        <?php echo $comment->comment_content;  ?>
                        </p>
                    </div>
                <?php
                }
        }
        else{
            echo "no comments to display";
        }        
        ?>
        
    </div>
</div><!--end container-->
<?php get_footer( )?>
