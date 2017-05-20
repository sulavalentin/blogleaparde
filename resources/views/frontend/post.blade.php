@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(!empty($post) && count($post)>0)
            <h1 class="post_title">{{$post->title}}</h1>
            {!! $post->content !!}
            <p class='text-right'>{{trans('labels.backend.access.users.table.created')}} {{date('d-m-Y', strtotime($post->created_at))}}</p>
            @if(!empty($similars) && count($similars)>0)
                <h3>Bloguri similare</h3>
                <ul class="similars">
                    @foreach($similars as $similar)
                    <li>
                        {{link_to_route('frontend.post',$similar->title,[$similar->id],[])}}
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
                <form method="post" action="{{route('frontend.addcomment.post')}}" name="comments">
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
                                    url:"{{route('frontend.addcomment.post')}}",
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
                    @foreach($comments as $comment)
                        <li>
                            <b>{{$comment->username}}</b><br>
                            {{$comment->comment}}
                            <p class='text-right'>{{$comment->created_at}}</p>
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
