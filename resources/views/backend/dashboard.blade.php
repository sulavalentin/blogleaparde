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
            <a href="{{URL('admin/newpost')}}" class="btn btn-primary pull-right">{{trans('buttons.general.crud.create')}}</a>
            <div class="clearfix" style='margin-bottom:15px;'></div>
            @if(!empty($posts) && count($posts)>0)
                @foreach($posts as $i)
                <div class='content' style='width:100%; float:left; border'>
                    <h2>{{$i->title}}</h2>
                    <p>{!! str_limit(strip_tags($i->content), $limit = 1000, $end = '...') !!}</p>
                    <p class='text-right'>{{date('d-m-Y H:i', strtotime($i->created_at))}}</p>
                    <a href='{{URL("/post/".$i->id)}}' class='btn btn-default' target='_blank'>{{trans('buttons.general.crud.view')}}</a>
                    <a href='{{URL("/admin/edit/".$i->id)}}' class='btn btn-primary'>{{trans('buttons.general.crud.edit')}}</a>
                    <a href='{{URL("/admin/delete/".$i->id)}}' class='btn btn-danger'>{{trans('buttons.general.crud.delete')}}</a>
                </div>
                @endforeach
                {{$posts->links()}} 
            @else
            <h1>Nu sunt bloguri</h1>
            @endif
            
        </div><!-- /.box-body -->
    </div><!--box box-success-->

@endsection