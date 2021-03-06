@extends('backend.layouts.app')

@section('content')
    <div class="container">
        @if(!empty($comment) && count($comment)>0)
            <h1 class="text-center">{{trans('buttons.backend.access.users.delete_permanently')}} ?</h1>
            <h1 class="text-center">{{$comment->comment}}</h1>
            <form method="post" action="{{route('admin.deletecomment.post',[$comment->id])}}" class="text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-default">{{trans('labels.general.yes')}}</button>
                {{link_to_route('admin.comments',trans('labels.general.no'),[],['class'=>'btn btn-primary'])}}
            </form>
        @endif
    </div>
@endsection