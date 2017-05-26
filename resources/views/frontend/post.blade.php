@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(!empty($post) && count($post)>0)
            <h1 class="post-title">{{$post->title}}</h1>
            {!! $post->content !!}
            <p class='text-right'>{{trans('labels.backend.access.users.table.created')}} {{date('d-m-Y', strtotime($post->created_at))}}</p>
            @if(!empty($similars) && count($similars)>0)
                <ul class="similars">
                    @foreach($similars as $similar)
                    <li>
                        {{link_to_route('frontend.post',$similar->title,[$similar->id],[])}}
                    </li>
                    @endforeach
                </ul>
            @endif
            <h3>{{trans('others.comments')}}</h3>
            
            @if (! $logged_in_user)
                {{ link_to_route('frontend.auth.login', trans('navs.frontend.login'), [], ['class' => active_class(Active::checkRoute('frontend.auth.login')) ]) }}
                @if (config('access.users.registration'))
                    {{ link_to_route('frontend.auth.register', trans('navs.frontend.register'), [], ['class' => active_class(Active::checkRoute('frontend.auth.register')) ]) }}
                @endif
            @else
                <form method="post" action="{{route('frontend.addcomment.post')}}" name="comments" postid="{{$post->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <textarea name="comment" class="form-control"></textarea>
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary">{{ trans('buttons.general.crud.create') }}</button>
                </form>
            @endif
            <ul id="comment-list">
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
        <h1>{{trans('others.empty')}}</h1>
        @endif
    </div>
</div>
@endsection
