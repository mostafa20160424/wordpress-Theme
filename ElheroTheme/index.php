<?php get_header(); //like include "header.php"?>

<div class="container home-page">
    <div class="row">
<?php
    if (have_posts()) {
        while(have_posts())
        {
            the_post();?>
            <div class="col-sm-6">
                <div class="main-post">
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
                     ,'comment class'
                     ,'display text case comment disabled for this post');
                     */
                     ?>
                </span>
                <?php
                 the_post_thumbnail('',['class'=>'img-responsive img-thumbnail']);
                 //the_post_thumbnail(size,attr);
                 //thumbnailsize:medium,large,full
                  ?>
                  <p class="post-content">
                  <?php the_excerpt() ?>
                </p>
                <hr>
                <span class="post-categories">
                    <i class="fa fa-tags fa-fw "></i>
                    <?php the_category(',') ?>    
                </span>
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


?>

</div>
<div class="pagination-number">
    <?php
    echo number_pagination();
    ?>
</div>
<?php
    
    echo "<div class='post-pagination'>";
    if(get_previous_posts_link())
    {
        previous_posts_link('Prev');//args:text
    }else{
        echo "<span class='span-prev'>No Previous Posts Link</span>";
    }
    if(get_next_posts_link()){
        next_posts_link('Next');//args:text
    }else{
        echo "<span class='span-next'>No Next Posts Link</span>";
    }
    echo '</div>';
?>
    </div>

<?php get_footer(); //like include "footer.php" ?>
