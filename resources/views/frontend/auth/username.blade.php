@extends('frontend.layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Set Username</div>

                <div class="panel-body">

                    <form action="{{route('username.post')}}" method="post" id="save">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="form-group">
                            <label class='col-md-4 control-label'>Username</label>
                            <div class="col-md-6">
                                <input type='text' name="username" class="form-control"/>
                            </div><!--col-md-6-->
                        </div><!--form-group-->
                        <div class="form-group">
                            <label class='col-md-4 control-label'></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" style="margin-top:15px;">Save</button>
                            </div><!--col-md-6-->
                        </div>
                    </form>
                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->
    
@endsection

@section('after-scripts')
    @if (config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@endsection