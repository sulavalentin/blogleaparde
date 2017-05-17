@extends('frontend.layouts.app')

@section('content')
    <div class='container'>
        @if(!empty($posts) && count($posts)>0)
            @foreach($posts as $i)
                <div class='content' style='width:100%; float:left; margin-bottom:15px; border-bottom:1px solid gray; padding-bottom:15px;'>
                    <h2>{{$i->title}}</h2>
                    <p>{{ str_limit(strip_tags($i->content), $limit = 1000, $end = '...') }}</p>
                    <p class='text-right' style="margin-top:15px;">
                        <a href='{{URL('post/'.$i->id)}}' class='btn btn-default pull-left'>{{trans('buttons.general.crud.view')}}</a>
                        {{ link_to_route('frontend.user.dashboard', trans('buttons.general.crud.view'), [], ['class' => 'btn btn-default pull-left' ]) }}
                        {{date('d-m-Y', strtotime($i->created_at))}}
                    </p>
                </div>
            {{$posts->links()}}
            @endforeach
        @else
            <h1 class='text-center'>Nu sunt bloguri</h1>
        @endif
    </div>
@endsection