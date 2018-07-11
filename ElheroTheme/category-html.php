<?php
 get_header();
  //like include "header.php"
  //if you want create special page for any category create file and name it "category-'category name'"
  //this file is special for html category 
 ?>

<div class="container category-page">
    <div class="row">
        <div class="cat-info cat-html text-center">
            <div class="col-md-4">
                <h1 class=""><?php single_cat_title()?></h1>
            </div>
            <div class="col-md-4">
                <div class="category-description "><?php echo category_description(); ?></div>
            </div>
            <div class="col-md-4">
                <span>Articals Count : <?php echo get_posts_count(); ?> , </span>
                <span>Comments Count : <?php echo get_comments_count(); ?> </span>
            </div>
        </div> 
        <div class="col-md-9">
<?php
    if (have_posts()) {
        while(have_posts())
        {
            the_post();?>
                <div class="main-post">
                    <div class="row">
                        <?php
                        if(get_the_post_thumbnail()){?>
                            <div class="col-md-6">
                            <?php
                            the_post_thumbnail('',['class'=>'img-responsive img-thumbnail']);
                            ?>
                            </div>
                        <?php    
                        }
                        ?>
                        <div class="col-md-6">
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
                            ?>
                            </span>
                            <p class="post-content">
                            <?php the_excerpt() ?>
                            <a class="more" href="<?php get_permalink() ?>">Read More ...</a>
                            </p>
                        </div>
                    </div>
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
                   
           <?php 
           
            //the title() can take before,after string to display in the title
        }
       
    }

    echo "</div>";//end col-md-9
?>
    <div class="col-md-3">
        <?php
        get_sidebar('html');
        //will create default wordpress sidebar if sidebar.php not exist take
        //if you want make spicial sidebar to any page create file name it sidebar-name
        //put this name as a parameter to get_sidebar(name)

        /*
            if(is_active_sidebar('main-sidebar'))
            {
                dynamic_sidebar('main-sidebar');
            }
         */   
         
        ?>
    </div>
    </div><!--end row-->
    <div class="pagination-number">
        <?php
        echo number_pagination();
        ?>
    </div>
</div>

<?php get_footer(); //like include "footer.php" ?>
