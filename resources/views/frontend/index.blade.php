@extends('frontend.layouts.app')

@section('content')
    <div class='container'>
        @if(!empty($posts) && count($posts)>0)
            @foreach($posts as $post)
                <div class='content posts-items'>
                    <h2>{{$post->title}}</h2>
                    <p>{{ str_limit(strip_tags($post->content), limit_worlds_posts, end) }}</p>
                    <p class='text-right posts-content'>
                        {{ link_to_route('frontend.post', trans('buttons.general.crud.view'), [$post->id], ['class' => 'btn btn-default pull-left' ]) }}
                        {{trans('labels.backend.access.users.table.created')}} {{date('d-m-Y', strtotime($post->created_at))}}
                    </p>
                </div>
            {{$posts->links()}}
            @endforeach
        @else
        <h1>{{trans('others.empty')}}</h1>
        @endif
    </div>
@endsection