<div class="row exampleServiceBlock" id="{{ ($newItem) ? 'example_service_ini' : 'example_service_'.$service->id }}">
    <input type="hidden" class="serviceInput" name="exampleServiceId[]"
           value="{{ ($newItem) ? 0 : $service->id }}">
    <!--服務項目-->
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="form-group" style="margin-bottom: 5px;">

            <label class="title-potmaster">服務項目-<span class="exampleServiceRank"></span></label>
						<span class="pull-right">
							<span class="text-primary" onclick="moreExampleService(this)">
                                <i class="fa fa-plus-circle "></i>新增</span>&nbsp;&nbsp;
							<span class="text-danger" onclick="fewerItem(this,'exampleService')">
                                <i class="fa fa-trash-o "></i>刪除</span>
						</span>
            <input type="text" class="form-control serviceInput" id="" name="serviceTitle[]"
                   value="{{ ($newItem) ? '' : $service->title }}" placeholder="輸入服務項目"
                   required>
            <span>剩餘10個字</span>
        </div>
    </div>

    <!--服務內容 -->
    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="form-group" style="margin-bottom: 5px;">
            <label class="title-potmaster">服務內容&nbsp;&nbsp;</label>
            <textarea class="form-control serviceInput" id="" cols="50" rows="2"
                      name="serviceContent[]" placeholder="請輸入服務內容">
                                {{ ($newItem) ? '' : $service->body }}</textarea>
            <span>剩餘30個字</span>
        </div>
    </div>
    <p style="clear: both"></p>

    <hr style="border: 1px solid #ddd;"/>
</div>