$(document).ready(function(){
    $("body").on("submit","form[name=comments]",function(e){
        e.preventDefault();
        var comment=$("textarea[name=comment]").val();
        var token=$("input[name=_token]").val();
        var url=$(this).attr("action");
        var postid=$(this).attr("postid");
        if(comment.length<1){
            $("textarea[name=comment]").focus();
        }else{
            $("button[name=submit]").button("loading");
            $.ajax({
                type:"post",
                url:url,
                data:{
                    _token:token,
                    comment:comment,
                    id:postid
                },
                success:function(data){
                    $("textarea[name=comment]").val("");
                    $("button[name=submit]").button("reset");
                    alert('comentariul tau va fi aprobat de administrator');
                },
                error:function(){
                    $("button[name=submit]").button("reset");
                }
            });
        }
    });
    
});