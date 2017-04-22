<div class="col-md-12 col-xs-12">

    <!--狀態-->
    <div>
        <button id="SubmitBtn" class="btn btn-success full-width" type="submit"><span
                    class="glyphicon glyphicon-ok-sign"></span>&nbsp;送出儲存
        </button>
    </div>
    <hr>
    <div>
        <p>建立日期:{{ isset($noteText) ? $noteText : $example->created_at}}</p>
    </div>


    <h4 class="title-potmaster"><i class="fa fa-info-circle"></i>&nbsp;公開店面</h4>
    <label class="radio-inline">
        {!! Form::radio('published', '1',true) !!} <span class="title-potmaster"><i
                    class="fa fa-unlock-alt"></i>公開</span>
    </label>
    <label class="radio-inline">
        {!! Form::radio('published', '0') !!} <span class="title-potmaster"><i class="fa fa-lock"></i>還不要公開</span>
    </label>

    <hr style="border: 1px solid black "/>

    <!--基本資訊-->
    <div class="form-horizontal">
        <h4 class="title-potmaster"><i class="fa fa-caret-right"></i>&nbsp;基本資訊</h4>

        <!--名稱-->
        <div class="form-group">
            <label for="" class="col-sm-2 control-label title-potmaster">名稱</label>

            <div class="col-sm-10">
                {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'名稱','id'=>'title']) !!}
                <span>剩餘<span></span>個字</span>
            </div>
        </div>

        <!-- 地址 Form Input -->
        <div class="form-group">
            {{Form::label('Address','地址',['class'=>'col-sm-2 control-label title-potmaster'])}}
            <div class="col-sm-10">
                {!! Form::textarea('address', null , ['class'=>'form-control','id'=>'body','cols'=>'50','rows'=>'2']) !!}
                <span>剩餘50個字</span>
                {{--                    {!! Form::text('Address',null, ['class'=>'form-control','id'=>'Address','placeholder'=>'輸入地址']) !!}--}}
            </div>
        </div>

        <!-- 電話 Form Input -->
        <div class="form-group">
            {{Form::label('tel','電話',['class'=>'col-sm-2 control-label title-potmaster'])}}
            <div class="col-sm-10">
                {!! Form::text('tel',null, ['class'=>'form-control','id'=>'tel','placeholder'=>'輸入電話']) !!}
            </div>
        </div>

        <p style="clear: both"></p>
    </div>

    <hr class="black-horizontal-line"/>

    <!--商店主圖 與 基本資料-->
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('', '主要圖片',['class'=>'control-label title-potmaster']) !!}
                <div class="full-width">
                    <!--主要圖片-->
                    @include('partials._coverPhotoDropzone',[
                            'id'=>$example->id,
                            'path' =>$example->coverPhoto_path,
                            'associatedTable'=>'examples'])
                </div>
            </div>
        </div>

        <!--主要產品-->
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                <label for="" class="RWDText-20 title-potmaster">簡介</label>
                {!! Form::textarea('body', null , ['class'=>'form-control','id'=>'body','cols'=>'50','rows'=>'4']) !!}
                <span>剩餘150個字</span>
            </div>

            <div class="form-group">
                <label class="title-potmaster">主要產品</label>
                {!! Form::textarea('main_product', null , ['class'=>'form-control','id'=>'body','cols'=>'50','rows'=>'2','placeholder'=>'輸入主要販售產品,例如: 牛肉麵, 肉絲炒飯, 酸辣湯']) !!}
                <span>剩餘50個字</span>
            </div>
        </div>

    </div>

    <hr style="border: 1px solid black "/>

    <!--相關連結-->
    <h4 class="title-potmaster"><i class="fa fa-caret-right"></i>&nbsp;相關連結</h4>

    <div class="form-horizontal">
        <div class="form-group">
            <label for="web_url" class="col-sm-2 control-label title-potmaster">官網網址/部落格</label>

            <div class="col-sm-10">
                {!! Form::text('web_url', null , ['class'=>'form-control','placeholder'=>'官網/部落格網址','id'=>'web_url']) !!}
            </div>
        </div>
        {{--<p style="clear: both"></p>--}}
        <!--粉絲頁連結-->
        <div class="form-group">
            <label for="fb_url" class="col-sm-2 control-label title-potmaster">粉絲頁連結</label>

            <div class="col-sm-10">
                {!! Form::text('fb_url', null , ['class'=>'form-control','placeholder'=>'粉絲頁連結','id'=>'fb_url']) !!}
            </div>
        </div>
        {{--<p style="clear: both"></p>--}}
        <!--Google+連結-->
        <div class="form-group">
            <label for="" class="col-sm-2 control-label title-potmaster">Google+</label>

            <div class="col-sm-10">
                {!! Form::text('gplus_url', null , ['class'=>'form-control','placeholder'=>'Google+連結','id'=>'gplus_url']) !!}
            </div>
        </div>
        {{--<p style="clear: both"></p>--}}
    </div>
    <!--官網/部落格網址-->


    <hr style="border: 1px solid black "/>

    <!--產品介紹-->
    <div>
        <h4 class="title-potmaster"><i class="fa fa-caret-right"></i>&nbsp;產品介紹&nbsp;&nbsp;
            <span class="small">可以一次上傳多張產品照,建議圖片長寬要一致</span>
        </h4>

        @if (count($example->product_list) < 1)
            @include('admin.example.partials._productBlock',['newItem' => true])
        @else
            @foreach($example->product_list as $product)
                @include('admin.example.partials._productBlock', ['newItem' => false])
            @endforeach
        @endif
    </div>
    <hr style="border: 1px solid black "/>

    <!--服務項目-->
    <div>
        <h4 class="title-potmaster"><i class="fa fa-caret-right"></i>&nbsp;服務項目&nbsp;<span>最多10項</span></h4>

        @if ( count($example->service_list) < 1)
            @include('admin.example.partials._serviceBlock', ['newItem' => true])
        @else
            @foreach($example->service_list as $service)
                @include('admin.example.partials._serviceBlock', ['newItem' => false])
            @endforeach
        @endif

    </div>

    <hr style="border: 1px solid black "/>

    <!--使用狀況-->
    <div class="form-horizontal">
        <h4 class="title-potmaster"><i class="fa fa-caret-right"></i>&nbsp;使用狀況</h4>

        <!--使用設備-->
        <div class="form-group">
            <label class="title-potmaster">使用設備</label>
            {!! Form::text('use_gear', null ,
            ['class'=>'form-control',
            'placeholder'=>'使用鍋教授設備的設備,例如"單把手鍋,節能魯桶,節能湯鍋"']) !!}
            {{--<span>剩餘150個字</span>--}}
        </div>

        <!--使用效果-->
        <div class="form-group">
            <label class="title-potmaster">使用效果</label>
            {!! Form::textarea('use_result', null ,
            ['class'=>'form-control',
            'id'=>'use_result', 'required'=>true,
            'cols'=>'50','rows'=>'4',
            'placeholder'=>'使用鍋教授設備後的效果,例如"我每個月節省1萬元的瓦斯"']) !!}
            {{--<span>剩餘150個字</span>--}}
        </div>
    </div>


    <!--現場圖片-->
    <div class="form-group">
        <label class="title-potmaster">現場圖片&nbsp;&nbsp;&nbsp;
                <span class="text-primary fileinput-button" style="cursor: pointer">
                    <i class="fa fa-plus-circle "></i>新增</span>&nbsp;&nbsp;
            <span class="small" style="font-weight: normal">建議圖片比例 長寬=4:3</span>
        </label>

        <div class="row">
            <div id="dropZoneUpload"
                 data-url="/photos/Example/{{$example->id}}"
                 class="dropzone">
            </div>
            @foreach($example->photos as $photo)
                @include('partials._photo')
            @endforeach
        </div>
    </div>

    <div>

        <button id="SubmitBtn" class="btn btn-success full-width" type="submit"><span
                    class="glyphicon glyphicon-ok-sign"></span>&nbsp;送出儲存
        </button>
    </div>
    <br/>
</div>


