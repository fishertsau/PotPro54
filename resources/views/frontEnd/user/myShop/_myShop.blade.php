<input type="text" class="hidden"
       v-model="example"
       value="{{$example}}">

<div class="row">
    <div class="col-md-8">
        <h5 class="title-potmaster">
            <i class="fa fa-flag" aria-hidden="true"></i>&nbsp;網路店面:</h5>
        <ul class="title-potmaster" style="list-style: circle">
            <li>您可以成為我們的節能案例,同時擁有一個網路店面.</li>
            <li>建立您的網路店面,透過網路與手機輕鬆快速地做宣傳.</li>
        </ul>

        <h5 class="title-potmaster">
            <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;使用說明</h5>
        <ul class="title-potmaster" style="list-style: circle">
            <li class="text-danger">若您需要建立您的網路店面,請與您的服務人員聯絡.</li>
            {{--<li class="text-danger">網路店面若有不當內容,本公司可能會將您的商店關閉.</li>--}}
            {{--<li>您需要將您的電子郵件認證後,才能使用此功能</li>--}}
        </ul>

        @if(isset($example)&&(!$example->activated))
            <h5 class="text-danger">
                <i class="fa fa-exclamation-circle" aria-hidden="true">
                </i>&nbsp;您的店面目前關閉中,有任何問題請聯絡我們.</h5>
        @endif
    </div>
    <div class="col-md-4" style="display: none">
        <div style="border: 2px solid white">
            <h5 class="title-potmaster text-center">相關功能</h5>

            <div>
                <button class="btn btn-danger text-center full-width"
                @click="popupCreateFormModal" v-show='!hasExample'>
                <i class="fa fa-flag" aria-hidden="true"></i>&nbsp;
                建立我的網路店面
                </button>
            </div>

            <div style="margin-bottom: 5px">
                <button class="btn btn-success text-center full-width"
                        v-show="hasExample"
                @click="popupShareExampleFormModal">
                <i class="fa fa-bullhorn" aria-hidden="true"></i>&nbsp;
                分享我的網路店面
                </button>
            </div>

            <div style="margin-bottom: 5px">
                <button class="btn btn-warning text-center full-width">
                <i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;
                我需要協助
                </button>
            </div>
        </div>
    </div>
</div>