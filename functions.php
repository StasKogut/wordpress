<?php

function do_session() {
        session_start();
}

function add_post_content($content) {

    $get_post_meta_likes=get_post_meta(get_THE_ID(),'likes', true);
    $get_post_meta_dislikes=get_post_meta(get_THE_ID(),'dislikes', true);
    $content .='<br>'.'<button type="button" id="button_like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>'.
        '<span id="likes_sum">'."$get_post_meta_likes".'</span>'.
        '<input type="hidden" id="like_sum" name="" value="'.$get_post_meta_likes.'">'.
        '<input type="hidden" id="like_sum" name="" value="'.$get_post_meta_dislikes.'">'.
        '<input type="hidden" id="input_like" name="" value="' .get_THE_ID().'">'.
        '<input type="hidden" id="input_like" name="" value="' .get_THE_ID().'">'.
        '<button type="button" id="button_dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>'.
        '<span id="dislikes_sum">'."$get_post_meta_dislikes".'</span>';
return $content;
}

function vote_scripts(){
    wp_enqueue_script('vote_script.js',plugins_url('/js/vote_script.js',__FILE__),array('jquery'));
}
wp_enqueue_style('vote','/css/vote.css',__FILE__);

function wp_ajax_vote_test(){
    $post_id=(int)$_POST['post_id'];
    if (empty($_SESSION['id'][$post_id])){
        $_SESSION['id'][$post_id]='like';
        $likes_value=(int)get_post_meta($post_id,'likes', true)+1;
        $vote=array('likes'=>"$likes_value");
        update_post_meta($post_id,'likes',$likes_value);
        wp_send_json($vote);
    } elseif ($_SESSION['id'][$post_id]=='dislike'){
        $_SESSION['id'][$post_id]='like';
        $likes_value=(int)get_post_meta($post_id,'likes', true)+1;
        if ((int)get_post_meta($post_id,'dislikes', true)>0) {
            $dislikes_value = (int)get_post_meta($post_id, 'dislikes', true) - 1;
        } else $dislikes_value = (int)get_post_meta($post_id, 'dislikes', true);
        $vote=array('likes'=>"$likes_value",'dislikes'=>"$dislikes_value");
        update_post_meta($post_id,'likes',$likes_value);
        update_post_meta($post_id,'dislikes',$dislikes_value);
        wp_send_json($vote);
    }

}
function wp_ajax_vote_test_dis(){
    $post_id=(int)$_POST['post_id'];
    if (empty($_SESSION['id'][$post_id])){
        $_SESSION['id'][$post_id]='dislike';
        $dislikes_value=(int)get_post_meta($post_id,'dislikes', true)+1;
        update_post_meta($post_id,'dislikes',$dislikes_value);
        $vote_d=array('dislikes'=>"$dislikes_value");
        wp_send_json($vote_d);
    } elseif ($_SESSION['id'][$post_id]=='like'){
    $_SESSION['id'][$post_id]='dislike';
    $dislikes_value=(int)get_post_meta($post_id,'dislikes', true)+1;
    if ((int)get_post_meta($post_id,'likes', true)>0) {
        $likes_value = (int)get_post_meta($post_id, 'likes', true) - 1;
    } else $likes_value = (int)get_post_meta($post_id, 'likes', true);
    update_post_meta($post_id,'dislikes',$dislikes_value);
    update_post_meta($post_id,'likes',$likes_value);
    $vote_d=array('likes'=>"$likes_value",'dislikes'=>"$dislikes_value");
    wp_send_json($vote_d);
}

}

