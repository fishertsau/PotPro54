<div class="form-horizontal">



    @include('admin.channel.sales._salesInfo')

    <hr>
    <!--帳號開通或關閉-->
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">開通</label>

        <div class="col-sm-8">
            {!! Form::radio('activated', '1',true) !!}開通
            {!! Form::radio('activated', '0') !!}關閉
        </div>
    </div>

    <!--價格折數-->
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">折數</label>

        <div class="col-sm-3">

            <div class="input-group">
                {!! Form::number('discount_rate',$sales->discount_rate,
           ['class'=>'form-control','min'=>0, 'max'=>100, 'required'=>true]) !!}
                <span class="input-group-addon">%</span>
            </div>
        </div>
    </div>

    <!--身分-->
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">身分</label>

        <div class="col-sm-3">
            <div class="input-group">
                {{Form::select('role',
                ['公司業務' => '公司業務',
                '經銷商' => '經銷商',
                '代理商' => '代理商'
                ],
                '公司業務',['class'=>'form-control']) }}
            </div>
        </div>
    </div>

    <hr>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
            <button id="SubmitBtn" class="btn btn-success full-width" type="submit"><span
                        class="glyphicon glyphicon-ok-sign"></span>&nbsp;送出儲存
            </button>
        </div>
    </div>
</div>