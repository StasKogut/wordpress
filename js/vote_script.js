jQuery(document).ready(function( $ ) {

    $('#button_like').click(function () {
        var $a=$('#input_like').val();
        $('#button_dislike').prop('disabled',false);
        $.ajax({
            type: 'POST',
            url:'/wp-admin/admin-ajax.php',
            data:{
                post_id: $a,
                action:'vote_test'
            },
            success: function (res) {
                console.log(res);
                $('#likes_sum').html(res.likes);
                $('#dislikes_sum').html(res.dislikes);
                $('#button_like').prop('disabled',true);
                },


        });
    });
    $('#button_dislike').click(function () {
        var $a=$('#input_like').val();
        $('#button_like').prop('disabled',false);
        $.ajax({
            type: 'POST',
            url:'/wp-admin/admin-ajax.php',
            data:{
                post_id: $a,
                action:'vote_test_dis'
            },

                success: function (res) {
                    $('#dislikes_sum').html(res.dislikes);
                    $('#likes_sum').html(res.likes);
                    $('#button_dislike').prop('disabled',true);
                },

        });
    })
});
