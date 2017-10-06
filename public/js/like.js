function likePost(id){
    var el = document.getElementById("like");
    var postId = id;

    $.ajax({
        url: '/like/post/'+postId,
        type: "get",
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');
            if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
            console.log(token);

        },
        data: {'id': postId},
        success:function(data){
            console.log(data);
            // $( "."+postId ).load('../like/post  .'+postId);
            var count = parseInt($("#count_likes").text());
            if(data == 'like') {
                count += 1;
                $("#count_likes").text(count);
                $(el).addClass('active');
            }else {
                count -= 1;
                $("#count_likes").text(count);

                $(el).removeClass('active');
                // $("#count_likes").text("count - 1");
            }

        },
        error:function(){
            console.log("error!!!!");
        }
    });
}
