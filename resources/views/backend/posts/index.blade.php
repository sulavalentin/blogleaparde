@extends ('backend.layouts.app')
@section('content')
    <script src="{!!asset('/assets/css/summernote.min.css')!!}"></script>

    <script src="{!!asset('/assets/js/summernote.min.js')!!}"></script>
    {{Form::open()}}
        <div class="box-body">
        <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Title'))}}
        </div>
        <div class="form-group">
        {{Form::label('body', 'Content')}}
        {{Form::textarea('body',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'technig'))}}
        </div>
        <div class="form-group">
        {{Form::submit('Publish Post',array('class' => 'btn btn-primary btn-sm'))}} </div>
   {{Form::close()}} 
@endsection
