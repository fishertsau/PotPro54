@if($example->sales->count()>0)
    <div class="form-horizontal">
        <div class="form-group">
            <label for="" class="col-sm-3 control-label title-potmaster">姓名</label>
            <div class="col-sm-9">
                <p class="form-control-static title-potmaster">{{$example->sales->name}}</p>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-3 control-label title-potmaster">電話</label>
            <div class="col-sm-9">
                <p class="form-control-static title-potmaster">{{$example->sales->tel}}</p>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-3 control-label title-potmaster">電子郵件</label>
            <div class="col-sm-9">
                <p class="form-control-static title-potmaster">{{$example->sales->email}}</p>
            </div>
        </div>
    </div>
@else
    您尚未有任何服務人員!
    <div>
        <a href="">
            <button class="btn btn-success text-center full-width">自行設定服務人員</button>
        </a>
        <br/>
        <a href="">
            <button class="btn btn-warning text-center full-width">申請服務人員設定</button>
        </a>
    </div>
@endif