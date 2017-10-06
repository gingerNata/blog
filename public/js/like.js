function likePost(id){
    var el = document.getElementById("like"+id);
    var postId = id;

    $.ajax({
        url: '/like/post/'+postId,
        type: "get",
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');
            if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }

        },
        data: {'id': postId},
        success:function(data){
            var elem = $("#count-likes-"+id);
            var count = parseInt(elem.text());
            var active = $("#like-"+id);
            if(data == 'like') {
                count += 1;
                elem.text(count);
                active.addClass('active');
            }else {
                count -= 1;
                elem.text(count);
                active.removeClass('active');
            }

        },
        error:function(){
            console.log("error!!!!");
        }
    });
}
