@extends ('backend.layouts.app')
@section('content')
@if(!empty($post) && count($post)>0)
    {{Form::open(['id'=>'formeditormod','route'=>'admin.edit.post','back'=>route('admin.dashboard'),'idpost'=>$post->id])}}
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            {{Form::text('title',$post->title,array('class' => 'form-control', 'placeholder'=>'Title','id'=>'title'))}}
        </div>
        <div class="form-group">
            {{Form::textarea('body',$post->content,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'technig'))}}
            </div>
        <div class="form-group">
            {{Form::submit(trans('buttons.general.crud.update'),array('class' => 'btn btn-primary btn-sm','id'=>'save'))}} 
        </div>
    {{Form::close()}}
@else
    <h1>{{trans('strings.emails.auth.error')}}</h1>
@endif
@endsection