@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('talk/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- Page content --}}
@section('content')
    @include('admin.talk._contentHeader',
    ['section_title'=> '演講與推廣清單'])

    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"><i class="livicon" data-name="list-ul" data-size="16"
                                                         data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('talk/title.talklist')
                    </h4>

                    <div class="pull-right">
                        @include('admin.talk._talkSearch')
                        <a href="{{ route('admin.talk.create') }}" class="btn btn-sm btn-default"><span
                                    class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <br/>

                <div class="panel-body">
                    @include('admin.talk._talkList')
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')

    @include('admin.partials._delete_confirmModal')

    <script>
        $('div.alert').not('.alert-important').delay(2500).fadeOut(350);
    </script>

@stop
