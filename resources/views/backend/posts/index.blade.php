@extends ('backend.layouts.app')
@section('content')
    {{Form::open(['id'=>'formeditor'])}}
        <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Title','id'=>'title'))}}
        </div>
        <div class="form-group">
        {{Form::label('body', 'Content')}}
        {{Form::textarea('body',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'technig'))}}
        </div>
        <div class="form-group">
            {{Form::submit(trans('buttons.general.save'),array('class' => 'btn btn-primary btn-sm','id'=>'save'))}} 
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
                        url: "{{route('admin.addpost.post')}}", 
                        data: 
                            { 
                                _token: "{{ csrf_token() }}",
                                title:title,
                                content:content
                            },
                        success: function() {
                            location.href="{{route('admin.dashboard')}}";
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
@endsection
