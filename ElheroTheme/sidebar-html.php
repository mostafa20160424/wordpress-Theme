
<div class="sidebar-html">
    <div class="widget">
        <h3><?php single_cat_title() ?> Statistics</h3>
        <div class="widget-content">
            <ul class="list-unstyled">
                <li>
                    <span>Comments Count : <?php echo get_comments_count() ?></span>
                </li>
                <li>
                    <span>Articals Count : <?php echo get_posts_count() ?></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="widget">
        <h3>Latest PHP posts</h3>
        <div class="widget-content">
            <ul class="list-unstyled">
                <?php
                    $post_args=array(
                        'posts_per_page'    => 5,
                        'cat'               => 4 //4 is id for html category
                    );
                    $query = new WP_QUERY($post_args);
                    if($query->have_posts())
                    {
                        while($query->have_posts())
                        {
                            
                            $query->the_post();
                            ?>
                            <li>
                                <a target="_blank" href="<?php the_permalink()?>">
                                    <?php the_title(); ?>
                                </a>
                            </li>
                            <?php
                        }
                        wp_reset_postdata();
                    }

                ?>
            </ul>
        </div>
    </div>
    <div class="widget">
        <h3>Hot posts By Comments</h3>
        <div class="widget-content">
        <ul class="list-unstyled">
                <?php
                    $hotpost_args=array(
                        'posts_per_page'    => 1,
                        //1 because you get the post have heighst number of comment 
                        'orderby'          => 'comment_count' 
                    );
                    $hotquery = new WP_QUERY($hotpost_args);
                    if($hotquery->have_posts())
                    {
                        while($hotquery->have_posts())
                        {
                            
                            $hotquery->the_post();
                            ?>
                            <li>
                                <a target="_blank" href="<?php the_permalink()?>">
                                    <?php the_title(); ?>
                                </a>
                                <hr style="border:1px solid #777;margin:5px 0">this post has
                                <?php comments_popup_link('No-Comments','One Comment','% Comments','comment_url','comment-disabled');?>
                            </li>
                            <?php
                            
                        }
                        wp_reset_postdata();
                    }

                ?>
            </ul>
        </div>
    </div>
</div>