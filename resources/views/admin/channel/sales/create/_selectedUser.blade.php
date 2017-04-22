<h4>選定使用者資訊</h4>

{{--<img src="" style="height:120px;width:100%;background: lightgoldenrodyellow"--}}
{{--alt="personal photo">--}}

{{--<br>--}}
{{--<br>--}}

<div>
    <div class="form-group">
        <label for="" class="RWDText-20">名稱</label>

        <p class="form-control-static text-primary RWDText-20">@{{ selectedUser.name }}</p>
        <span class="text-danger" v-show="salesDuplicateWarning">*已是通路,無需再加入!</span>
    </div>
    <div class="form-group">
        <label for="" class="RWDText-20">電話</label>

        <p class="form-control-static text-primary RWDText-20">@{{ selectedUser.tel }}</p>
    </div>
    <div class="form-group">
        <label for="" class="RWDText-20">電子信箱</label>

        <p class="form-control-static text-primary RWDText-20">@{{ selectedUser.email }}</p>
    </div>

    <div class="form-group">
        <label for="" class="RWDText-20">地址</label>

        <p class="form-control-static text-primary RWDText-20">@{{ selectedUser.address }}</p>
    </div>
</div>
