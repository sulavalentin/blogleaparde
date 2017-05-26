@extends('backend.layouts.app')

@section('content')
    <div class="container">
        @if(!empty($comments) && count($comments)>0)
            @foreach($comments as $i)
            <div class='content comments-content'>
                <h2>{{$i->title}}</h2>
                <h3>{{$i->comment}}</h3>
                <p>{{date('d-m-Y H:i', strtotime($i->created_at))}}</p>
                @if($i->hidden==false)
                    <form method="post" action="{{route("admin.acceptcomment.post",[$i->id])}}" class="btn-commnets-accept-refuse">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token"/>
                        <button type="submit" class='btn btn-primary'>{{trans('buttons.backend.access.users.activate')}}</button>
                    </form>
                @else
                    <form method="post" action="{{route("admin.refusecomment.post",[$i->id])}}" class="btn-commnets-accept-refuse">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token"/>
                        <button type="submit" class='btn btn-default'>{{trans('buttons.backend.access.users.deactivate')}}</button>
                    </form>
                @endif
                {{link_to_route('admin.deletecomment.get',trans('buttons.general.crud.delete'),[$i->id],['class'=>'btn btn-danger'])}}
            </div>
            @endforeach
            {{$comments->links()}}
        @else
        <h1>{{trans('others.empty')}}</h1>
        @endif
    </div>
@endsection