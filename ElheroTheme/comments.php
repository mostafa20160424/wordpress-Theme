<?php
/*
$comments_ars=array(
    'max-depth',
    'style'=>ol or ul,
    'type'=>'comment'
    per_page => comments number you want to show in page
    'reverse-top-level'=>true will show new comments in the top
    );
    
*/
if(comments_open())
{
    //comments_number('case 0','case 1','case more')
    ?>
    <h3 class="comment-number">
    <?php comments_number('0 Comment','1 Comment','% Comment') ?>
    </h3>
    <?php
    echo '<ul class="list-unstyled comments-list">';
    $comments_ars=array(
        'max-depth'=>3, //mean max reply comments
        'type'     =>'comment',
        'per_page' => 0,
        'avatar_size'=>30
    );
    wp_list_comments($comments_ars);
   /* foreach($comments as $comment)//$comments have all comments
    {
        comment_author();
    }*/
    echo '</ul>';
    echo '<hr>';
    $comment_form=array(
        'fields' => array(
            'author'=>'<div class="form-group"><label>name</label><input name="author" type="text" placeholder="Name"></div>',
            'email'      =>'<div class="form-group"><input name="email" type="text" placeholder="Email"></div>',
            'url'      =>'<div class="form-group"><input name="url" type="text" placeholder="Website_Url"></div>'
        ),
        'comment_field' => '<div class="form-group"><textarea name="comment" placeholder="Add Your Comment"></textarea></div>'
        //must put this names names to inputs and textarea
    );
    comment_form($comment_form);//to show reply
}else{
    echo 'comments_closed';
}
