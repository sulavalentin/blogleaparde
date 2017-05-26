$('textarea').ckeditor();
$("body").on('submit','#formeditor',function(e){
    e.preventDefault();
    var title=$("#title").val();
    var content = CKEDITOR.instances.technig.getData();
    var url=$(this).attr("action");
    var token=$("input[name=_token]").val();
    var back=$(this).attr("back");
    if(title.length<2){
        $("#title").focus();
    }else{
        if(content.length<2 ){
            CKEDITOR.instances.technig.focus();
        }else{
            $("#save").button("loading");
            $.ajax({  
                type: 'POST',  
                url: url, 
                data: 
                    { 
                        _token: token,
                        title:title,
                        content:content
                    },
                success: function() {
                    location.href=back;
                },
                error:function(){
                    $("#save").button("reset");
                    alert('a aparut o eroare');
                }
            });
        }
    }
});
$("body").on('submit','#formeditormod',function(e){
    e.preventDefault();
    var title=$("#title").val();
    var content = CKEDITOR.instances.technig.getData();
    var url=$(this).attr("action");
    var token=$("input[name=_token]").val();
    var back=$(this).attr("back");
    var id=$(this).attr('idpost');
    if(title.length<2){
        $("#title").focus();
    }else{
        if(content.length<2 ){
            CKEDITOR.instances.technig.focus();
        }else{
            $("#save").button("loading");
            $.ajax({  
                type: 'POST',  
                url: url, 
                data: 
                    { 
                        _token: token,
                        title:title,
                        content:content,
                        id:id
                    },
                success: function(){
                    location.href=back;
                    $("#save").button("reset");
                },
                error:function(){
                    $("#save").button("reset");
                    alert('a aparut o eroare');
                }
            });
        }
    }
});