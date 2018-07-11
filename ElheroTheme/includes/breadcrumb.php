<?php
    $all_cats=get_the_category();//return all post categories

?>
<div class="breadcrumbs-holder">
    <div class="container">
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo get_home_url() ?>">
                    <?php bloginfo('name') ?>
                </a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" 
                role="button" aria-haspopup="true" aria-expanded="false" href="">
                    Categories <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php
                    foreach($all_cats as $cat)
                    { ?>
                        <li>
                            <a target="_blank" href="<?php echo get_category_link($cat->term_id) ?>">
                                <?php echo $cat->name ; ?>
                            </a>
                        </li>
                    <?php 
                    }
                    ?>
                </ul>
            </li>
            <li class="active">
                <?php echo get_the_title(); ?>
            </li>
        </ol>
    </div>
</div>