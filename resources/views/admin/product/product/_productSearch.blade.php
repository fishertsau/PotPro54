<form action="\admin\product\group\list" method="get" id="productSearch">
    {{csrf_field()}}
    <input type="hidden" name="newSearch" value='1'>

    <div class="row">
        <div class="col-md-4">
            <p>系列產品</p>
            {{--todo: implement group list --}}
            {{--<div style="display: flex">--}}
            {{--{!! Form::select('group_id', $group_list ,null, ['class'=>'form-control selectList','placeholder'=>'系列產品','id'=>'group_id']) !!}--}}
            {{--</div>--}}
        </div>

        <div class="col-md-3">
            <p>狀態</p>
            <div style="display: flex">
                <select name="status_flag" class="form-control" id="status_flag" style="flex: 1">
                    <option value="">所有狀態</option>
                    {{--Todo: implement query term--}}
                    {{--
                                        <option value="1" {{($queryTerm['status_flag']==1)?'selected':''}}>上架</option>
                                        <option value="0" {{($queryTerm['status_flag']==0)?'selected':''}}>下架</option>
                    --}}
                </select>
            </div>
        </div>

        <div class="col-md-5">
            <p style="height: 20px;">查詢依據 &nbsp;
                <button class="btn btn-xs btn-default" id="clear_keyword" style="padding: 0px 5px">清除</button>
            </p>
            <div style="display: flex">
                {{--todo: implement query term--}}
                {{--<select name="keyword_by" class="form-control" style="flex: 1">
                    <option value="product_name" {{($queryTerm['keyword_by']=='product_name')?'selected':''}}>名稱
                    </option>
                    <option value="product_pn" {{($queryTerm['keyword_by']=='product_pn')?'selected':''}}>編號</option>
                </select>
                <input name="keyword" id="keyword" type="text" class="form-control" style="flex: 2"
                       placeholder="輸入關鍵字"
                       @if(isset($queryTerm['keyword']) && $queryTerm['keyword']<>'%')
                       value="{{$queryTerm['keyword']}}"
                        @endif>
                <span style="flex:1">
                        <button type="submit" class="btn btn-sm btn-danger full-width"><span
                                    class="glyphicon glyphicon-search"></span>&nbsp; 查詢
                        </button>
                    </span>--}}
            </div>
        </div>
    </div>
</form>