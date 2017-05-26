@extends ('backend.layouts.app')
@section('content')
    {{Form::open(['id'=>'formeditor','route'=>'admin.addpost.post','back'=>route('admin.dashboard')])}}
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
        {{Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Title','id'=>'title'))}}
        </div>
        <div class="form-group">
        {{Form::textarea('body',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'technig'))}}
        </div>
        <div class="form-group">
            {{Form::submit(trans('buttons.general.save'),array('class' => 'btn btn-primary btn-sm','id'=>'save'))}} 
        </div>
    {{Form::close()}}
@endsection
