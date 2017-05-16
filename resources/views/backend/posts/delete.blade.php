@extends ('backend.layouts.app')
@section('content')

    <div class="container" style='color:black;'>
        @if(!empty($post) && count($post)>0)
            <h1 class="text-center">Sigur doresti sa stergi acest post?</h1>
            <h1 class="text-center">{{$post->title}}</h1>
            <form method="post" action="{{URL('admin/delete/'.$post->id)}}" class="text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-default">Da</button>
                <a href="{{URL("/admin")}}" class="btn btn-primary">Nu</a>
            </form>
        @endif
    </div>
@endsection