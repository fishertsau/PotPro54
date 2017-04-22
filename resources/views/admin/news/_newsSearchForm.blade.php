<form action="/admin/news" method="get" id="newsSearch">
    {{csrf_field()}}
    <input type="hidden" name="newSearch" value='1'>

    <div class="row">
        <div class="col-md-2">
            <p>位置&nbsp;
                <button class="btn btn-default btn-xs" id="all_location">全部</button>
            </p>
            <div style="display: flex">
                <select name="location" class="news-selection news-location-input" id="location" style="flex: 1">
                    <option value="">全部</option>
                    @foreach(App\Models\Marketing\News::getLocationList() as $location=>$title)
                        <option value="{{$location}}"
                                {{($queryTerm['location']==$location)?'selected':''}}>
                            {{$title}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <p>狀態&nbsp;
                <button class="btn btn-default btn-xs" id="all_status">全部</button>
            </p>
            <div style="display: flex">
                <select name="status_flag" class="news-selection news-status-input" id="status_flag" style="flex: 1">
                    <option value="">所有</option>
                    <option value="1" {{($queryTerm['status_flag']==1)?'selected':''}}>上架</option>
                    <option value="0" {{($queryTerm['status_flag']==0)?'selected':''}}>下架</option>
                </select>
            </div>
        </div>


        <div class="col-md-4">
            <p>上架區間&nbsp;
                <button class="btn btn-default btn-xs" id="all_date">全部</button>
            </p>

            <div style="display: flex">
                <input name="begin_since" type="date" class="news-selection date-input" style="flex: 4"
                       @if(isset($queryTerm['begin_since']))
                       value="{{$queryTerm['begin_since']}}"
                        @endif>
                <span class="text-center" style="flex: 1">~</span>
                <input name="end_until" type="date" class="news-selection date-input" style="flex: 4"
                       @if(isset($queryTerm['end_until']))
                       value="{{$queryTerm['end_until']}}"
                        @endif>
            </div>
        </div>


        <div class="col-md-3">
            <p>標題&nbsp;
                <button class="btn btn-default btn-xs" id="clear_keyword">清除</button>
            </p>

            <div style="display: flex">

                <input name="keyword" id="keyword" type="text" class="news-selection" style="flex: 2"
                       placeholder="輸入標題關鍵字"
                       @if(isset($queryTerm['keyword']) && !$queryTerm['keyword']=='%')
                       value="{{$queryTerm['keyword']}}"
                        @endif>
                    <span style="flex:1">
                        <button type="submit" class="btn btn-sm btn-danger full-width"><span
                                    class="glyphicon glyphicon-search"></span>&nbsp; 查詢
                        </button>
                    </span>
            </div>
        </div>
    </div>
</form>