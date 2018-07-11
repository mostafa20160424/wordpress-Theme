
jQuery(document).ready(function($){ 
    $(".main-post").niceScroll({
        cursorcolor:"#777",
        cursorwidth:"10px",
        background:"#fff",
        cursorborder:"1px solid #001f3f",
        cursorborderradius:10,
        scrollspeed: 60
    });
    $(".post-pagination a[rel='prev']").css({
        transform:'translateX(-590px)'
    });
    $(".post-pagination a[rel='next']").css({
        transform:'translateX(590px)'
    });
    $('.children .comment').each(function(){
        $(this).append('<span class="reply-to">Replay To: '+
        $(this).parent('.children').prev('.comment-body').find('.comment-author .fn').text()+'</span>')

    });
    
    $(".comment-respond input[type!='submit'],textarea").each(function(){
        $(this).addClass('form-control')
    })
    $(".comment-respond input[type='submit']").each(function(){
        $(this).addClass('btn btn-primary')
    });
    $(".author-page .author-stats .stats:not(:eq(0))").css({marginLeft:'25px'})
    $("input").each(function(){
        if($(this).attr('type')=='submit')
            {
                $(this).addClass('btn btn-primary');
            }
        else
            {
                $(this).addClass('form-control');
            }    
    });
});
