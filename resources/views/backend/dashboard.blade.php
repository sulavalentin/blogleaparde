@extends('backend.layouts.app')

@section('page-header')
    <h1>
        {{ app_name() }}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{ link_to_route('admin.newpost', trans('buttons.general.crud.create'), [], ['class' => 'btn btn-primary pull-right' ]) }}
            <div class="clearfix" style='margin-bottom:15px;'></div>
            @if(!empty($posts) && count($posts)>0)
                @foreach($posts as $i)
                <div class='content' style='width:100%; float:left; border'>
                    <h2>{{$i->title}}</h2>
                    <p>{{ str_limit(strip_tags($i->content), Config::get('constants.limit_worlds_posts'), Config::get('constants.end')) }}</p>
                    <p class='text-right'>{{date('d-m-Y H:i', strtotime($i->created_at))}}</p>
                    {{ link_to_route('frontend.post', trans('buttons.general.crud.view'), [$i->id], ['class' => 'btn btn-default','target'=>'_blank' ]) }}
                    {{ link_to_route('admin.edit.get', trans('buttons.general.crud.edit'), [$i->id], ['class' => 'btn btn-primary' ]) }}
                    {{ link_to_route('admin.delete.get', trans('buttons.general.crud.delete'), [$i->id], ['class' => 'btn btn-danger' ]) }}
                </div>
                @endforeach
                {{$posts->links()}} 
            @else
            <h1>Nu sunt bloguri</h1>
            @endif
            
        </div><!-- /.box-body -->
    </div><!--box box-success-->

@endsection