@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit a system_config
    @parent
@stop

@section('content')
    @include('admin.system_configs._contentHeader',
    ['section_title'=> '修改內容'])

    <!-- Main content -->
    {!! Form::model($system_config,
                        ['method' => 'POST',
                        'action' => ['Admin\System_configsController@update', $system_config->id],
                        'files'=>'true'
                        ]) !!}
    <section class="content">
        <div class="row">
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="col-lg-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-success form-control">@lang('systemConfig/form.save')</button>
                </div>
            </div>

            {{--公司基本資料--}}
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="edit" data-size="16" data-loop="true"
                               data-c="#fff" data-hc="white"></i>
                            公司基本資料</h4>
                         <span class="pull-right">
                            <i class="glyphicon glyphicon-chevron-up clickable"></i>
                         </span>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <!--名稱-->
                            <div class="form-group">
                                {!! Form::label('com_name', '公司名稱',['class'=>'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('com_name',null, ['class'=>'form-control','id'=>'com_name','placeholder'=>'公司名稱']) !!}
                                </div>
                            </div>

                            <!--地址-->
                            <div class="form-group">
                                {!! Form::label('com_address', '地址',['class'=>'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('com_address',null, ['class'=>'form-control','id'=>'com_address','placeholder'=>'地址']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('com_tel', '電話',['class'=>'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    {!! Form::text('com_tel',null, ['class'=>'form-control','id'=>'com_tel','placeholder'=>'電話']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('com_fax', '傳真',['class'=>'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('com_fax',null, ['class'=>'form-control','id'=>'com_fax','placeholder'=>'傳真號碼']) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{--系統聯絡人--}}
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i> 系統聯絡人</h4>
                         <span class="pull-right">
                            <i class="glyphicon glyphicon-chevron-up clickable"></i>
                         </span>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">


                            <!--系統聯絡人-->
                            <div class="form-group">
                                {!! Form::label('sys_contact', '系統聯絡人',['class'=>'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    {!! Form::text('sys_contact',null, ['class'=>'form-control','id'=>'sys_contact','placeholder'=>'系統聯絡人']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('sys_contact_tel', '聯絡電話',['class'=>'col-sm-offset-1 col-sm-3 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('sys_contact_tel',null, ['class'=>'form-control','id'=>'sys_contact_tel','placeholder'=>'聯絡電話']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('sys_contact_email', '電子信箱',['class'=>'col-sm-offset-1 col-sm-3 control-label']) !!}

                                <div class="col-sm-8">
                                    {!! Form::email('sys_contact_email',null, ['class'=>'form-control','id'=>'sys_contact_email','placeholder'=>'電子信箱']) !!}

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{--行銷資料--}}
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i> 行銷資料</h4>
                         <span class="pull-right">
                            <i class="glyphicon glyphicon-chevron-up clickable"></i>
                         </span>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">

                            <!--list number per page-->
                            <div class="form-group">
                                {!! Form::label('number_per_page', '每頁顯示筆數',['class'=>'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    {!! Form::number('number_per_page',null, ['class'=>'form-control','id'=>'number_per_page','placeholder'=>'每頁顯示筆數']) !!}
                                </div>
                            </div>

                            <!--關鍵字-->
                            <div class="form-group">
                                {!! Form::label('seo', '關鍵字',['class'=>'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    {!! Form::text('seo',null, ['class'=>'form-control','id'=>'seo','placeholder'=>'關鍵字']) !!}
                                    (*關鍵字之間以逗號隔開)
                                </div>
                            </div>

                            <!--網站聯絡人-->
                            <div class="form-group">
                                {!! Form::label('site_contact_email', '網站聯絡人Email(主要)',['class'=>'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    {!! Form::email('site_contact_email',null, ['class'=>'form-control','id'=>'site_contact_email','placeholder'=>'網站聯絡人Email']) !!}
                                </div>
                            </div>


                            <!-- Site_contact_email_backup1 Form Input -->
                            <div class="form-group">
                                {{Form::label('site_contact_email_backup1','網站聯絡人Email(次要):',['class'=>'col-sm-3 control-label'])}}
                                <div class="col-sm-9">
                                    {!! Form::email('site_contact_email_backup1',null, ['class'=>'form-control','id'=>'site_contact_email_backup1','placeholder'=>'Email']) !!}
                                </div>
                            </div>

                            <!-- Site_contact_email_backup2 Form Input -->
                            <div class="form-group">
                                {{Form::label('site_contact_email_backup2','網站聯絡人Email(次要):',['class'=>'col-sm-3 control-label'])}}
                                <div class="col-sm-9">
                                    {!! Form::email('site_contact_email_backup2',null, ['class'=>'form-control','id'=>'site_contact_email_backup2','placeholder'=>'Email']) !!}
                                </div>
                            </div>

                            <!--部落格連結-->
                            <div class="form-group">
                                {!! Form::label('blog_link', '部落格連結',['class'=>'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    {!! Form::url('blog_link',null, ['class'=>'form-control','id'=>'blog_link','placeholder'=>'部落格連結']) !!}

                                </div>
                            </div>

                            <!--粉絲頁連結-->
                            <div class="form-group">
                                {!! Form::label('fb_link', '粉絲頁連結',['class'=>'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    {!! Form::url('fb_link',null, ['class'=>'form-control','id'=>'fb_link','placeholder'=>'粉絲頁連結']) !!}

                                </div>
                            </div>

                            <!--Google+連結-->
                            <div class="form-group">
                                {!! Form::label('gPlus_link', 'Google+連結',['class'=>'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    {!! Form::url('gPlus_link',null, ['class'=>'form-control','id'=>'gPlus_link','placeholder'=>'Google+連結']) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="image" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i> 品牌Logo</h4>
                         <span class="pull-right">
                            <i class="glyphicon glyphicon-chevron-up clickable"></i>
                         </span>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <p><i class="fa fa-check"></i><span class="text-danger">更換圖片 須先將舊有圖片刪除</span></p>

                            <p><i class="fa fa-check"></i>圖片格式:<span class="text-danger"> png</span></p>

                            <hr/>
                            <!--公司Logo-->
                            <div class="form-group">
                                {!! Form::label('logo_filename', '公司Logo',['class'=>'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    <img src="{{URL::asset('assets/images/companyInfo/brandLogo.png')}}"
                                         class="table-full-width">
                                    {!! Form::file('logo_filename',null, ['id'=>'logo_filename'] )!!}
                                    <p class="text-primary"><i class="fa fa-trash-o"></i>&nbsp;刪除圖片</p>

                                    <p><i class="fa fa-check"></i><span class="note">圖片寬度240pixels</span></p>
                                </div>
                            </div>

                            <!--內頁icon-->
                            <div class="form-group">
                                {!! Form::label('page_titleIcon_filename', '頁籤icon',['class'=>'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    <img src="{{URL::asset('assets/images/companyInfo/iconLogo-2.png')}}"
                                         style="width: 10%; max-width: 240px;">
                                    {!! Form::file('page_titleIcon_filename',null, ['id'=>'page_titleIcon_filename'] )!!}

                                    <p class="text-primary"><i class="fa fa-trash-o"></i>&nbsp;刪除圖片</p>

                                    <p><i class="fa fa-check"></i><span class="note">圖片寬度25pixels 高度25</span></p>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('icon_filename', '內頁icon',['class'=>'col-sm-3 control-label']) !!}

                                <div class="col-sm-9">
                                    <img src="{{URL::asset('assets/images/companyInfo/iconLogo.png')}}"
                                         style="width: 30%; max-width: 240px;">
                                    {!! Form::file('icon_filename',null, ['id'=>'icon_filename'] )!!}
                                    <p class="text-primary"><i class="fa fa-trash-o"></i>&nbsp;刪除圖片</p>

                                    <p><i class="fa fa-check"></i><span class="note">圖片寬度25pixels 高度25</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-success form-control">@lang('systemConfig/form.save')</button>
                </div>
            </div>
        {!! Form::close() !!}
    </section>
@stop