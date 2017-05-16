@extends('backend.layouts.app')

@section('content')
    <div class="container" style='color:black;'>
        @if(!empty($comment) && count($comment)>0)
            <h1 class="text-center">Sigur doresti sa stergi acest comentariu?</h1>
            <h1 class="text-center">{{$comment->comment}}</h1>
            <form method="post" action="{{URL('admin/deletecomment/'.$comment->id)}}" class="text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-default">Da</button>
                <a href="{{URL("/admin/comments")}}" class="btn btn-primary">Nu</a>
            </form>
        @endif
    </div>
@endsection