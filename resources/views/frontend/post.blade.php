@extends('frontend.layouts.app')

@section('content')
<style>
    #comment_list{
        list-style-type:none;
        padding:0px;
        margin-top:15px;
    }
    #comment_list li{
        border-bottom:1px solid gray;
        padding:5px;
    }
</style>
<div class="container">
    <div class="row">
        @if(!empty($post) && count($post)>0)
            <h1 style="border-bottom: 1px solid gray;">{{$post->title}}</h1>
            {!! $post->content !!}
            <p class='text-right'>Creat {{date('d-m-Y', strtotime($post->created_at))}}</p>
            @if(!empty($similar) && count($similar)>0)
                <h3>Bloguri similare</h3>
                <ul style="list-style-type:none; padding:0px;">
                    @foreach($similar as $i)
                    <li>
                        <a href="{{URL("/post/".$i->id)}}">{{$i->title}}</a>
                    </li>
                    @endforeach
                </ul>
            @endif
            <h3>Comentarii</h3>
            
            @if (! $logged_in_user)
                {{ link_to_route('frontend.auth.login', trans('navs.frontend.login'), [], ['class' => active_class(Active::checkRoute('frontend.auth.login')) ]) }}
                or
                @if (config('access.users.registration'))
                    {{ link_to_route('frontend.auth.register', trans('navs.frontend.register'), [], ['class' => active_class(Active::checkRoute('frontend.auth.register')) ]) }}
                @endif
                for comments
            @else
                <form method="post" action="{{URL('addcomment')}}" name="comments">
                    <textarea name="comment" class="form-control"></textarea>
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary">Comenteaza</button>
                </form>
                <!--script add comments -->
                <script>
                    $(document).ready(function(){
                        $("body").on("submit","form[name=comments]",function(e){
                            e.preventDefault();
                            var comment=$("textarea[name=comment]").val();
                            if(comment.length<1){
                                $("textarea[name=comment]").focus();
                            }else{
                                $("button[name=submit]").button("loading");
                                $.ajax({
                                    type:"post",
                                    url:"{{URL('addcomment')}}",
                                    data:{
                                        _token:"{{csrf_token()}}",
                                        comment:comment,
                                        id:"{{$post->id}}"
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
                </script>
            @endif
  
            <ul id="comment_list">
                @if(!empty($comments) && count($comments)>0)
                    @foreach($comments as $i)
                        <li>
                            <b>{{$i->name}}</b><br>
                            {{$i->comment}}
                            <p class='text-right'>{{$i->created_at}}</p>
                        </li>
                    @endforeach
                @endif
             </ul>       
        @else
            <h1 class='text-center'>Acest blog nu exista</h1>
        @endif
    </div>
</div>
@endsection
