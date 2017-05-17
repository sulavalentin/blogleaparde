@extends ('backend.layouts.app')
@section('content')
@if(!empty($post) && count($post)>0)
    {{Form::open(['id'=>'formeditor'])}}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title',$post->title,array('class' => 'form-control', 'placeholder'=>'Title','id'=>'title'))}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Content')}}
            {{Form::textarea('body',$post->content,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'technig'))}}
            </div>
        <div class="form-group">
            {{Form::submit('Publish Post',array('class' => 'btn btn-primary btn-sm','id'=>'save'))}} 
        </div>
    {{Form::close()}}
    
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script>
        $('textarea').ckeditor();
        $("body").on('submit','#formeditor',function(e){
            e.preventDefault();
            var title=$("#title").val();
            var content = CKEDITOR.instances.technig.getData();
            if(title.length<2){
                $("#title").focus();
            }else{
                if(content.length<2 ){
                    CKEDITOR.instances.technig.focus();
                }else{
                    $("#save").button("loading");
                    $.ajax({  
                        type: 'POST',  
                        url: "{{URL('/admin/edit')}}", 
                        data: 
                            { 
                                _token: "{{ csrf_token() }}",
                                title:title,
                                content:content,
                                id:"{{$post->id}}"
                            },
                        success: function(){
                            location.href="{{URL('/admin')}}";
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
    </script>
@else
    <h1>Nu exista acest post</h1>
@endif
@endsection