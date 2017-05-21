@extends ('backend.layouts.app')
@section('content')
    <div class="container" style='color:black;'>
        @if(!empty($post) && count($post)>0)
            <h1 class="text-center">{{trans('buttons.backend.access.users.delete_permanently')}}?</h1>
            <h1 class="text-center">{{$post->title}}</h1>
            <form method="post" action="{{route('admin.delete.post',[$post->id])}}" class="text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-default">{{trans('labels.general.yes')}}</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">{{trans('labels.general.no')}}</a>
            </form>
        @endif
    </div>
@endsection