<div class="app-filterBlock">
    <div style="display: flex;">
        <button class="btn btn-warning full-width" style="flex: 1;margin-right: 0.5em;"
        @click="orderFilterShow=!orderFilterShow">

        查詢條件&nbsp;
        <i class="fa fa-plus" aria-hidden="true" v-show="!orderFilterShow"></i>
        <i class="fa fa-minus" aria-hidden="true" v-show="orderFilterShow"></i>
        </button>

        <button class="btn btn-danger full-width" style="flex: 1;margin-left: 0.5em"
                @click.prevent="doNewOrderSearch">
            訂單查詢&nbsp;<i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </div>


    {{Form::open(['method'=>'get', 'id'=>'orderSearchForm'])}}
    {{csrf_field()}}
    <input type="hidden" name="newSearch" value='1'>

    <div class="app-filterBlock__form" v-show="orderFilterShow">
        <div class="row">
            <div class="col-md-3 app-filterBlock__form__inputItem">
                <p class="title-potmaster app-filterBlock__form__inputItem__title">訂單狀態&nbsp;
                    <button class="btn btn-default btn-xs"
                            @click.prevent="clearStatus">所有狀態
                    </button>
                </p>

                <div style="display: flex">
                    <select name="status_flag"
                            id="status_flag"
                            class="form-control"
                            style="flex: 1">
                        <option value="">狀態</option>
                        @foreach(App\Models\Order\Order::getStatusTextList() as $statusChar=>$title)
                            <option value="{{$statusChar}}"
                                    {{--{{($queryTerm['status_flag']==$statusChar)?'selected':''}}--}}>
                                {{$title}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 app-filterBlock__form__inputItem">
                <p class="title-potmaster app-filterBlock__form__inputItem__title">訂購日期&nbsp;
                    <button class="btn btn-default btn-xs"
                    @click.prevent="clearBeginAndEnd">
                    所有日期
                    </button>
                </p>

                <div style="display: flex;align-items: center">
                    <input name="begin_since"
                           id="begin_since"
                           type="date"
                           class="form-control"
                           style="flex: 4"
                           @if(isset($salesOrderQueryTerm['begin_since']))
                           value="{{$salesOrderQueryTerm['begin_since']}}"
                            @endif>

                    <span class="text-center" style="flex: 1">~</span>
                    <input name="end_until"
                           id="end_until"
                           type="date"
                           class="form-control"
                           style="flex: 4"
                           @if(isset($salesOrderQueryTerm['end_until']))
                           value="{{$salesOrderQueryTerm['end_until']}}"
                            @endif>
                </div>
            </div>
            <div class="col-md-3 app-filterBlock__form__inputItem">
                <p class="title-potmaster app-filterBlock__form__inputItem__title">訂單號碼&nbsp;
                    <button class="btn btn-default btn-xs"
                    @click.prevent="clearKeyword"
                    >
                    清除訂單號碼</button>
                </p>
                <input type="text" class="hidden" name="keyword_by" value="po_no">
                <input name="keyword"
                       id="keyword"
                       type="text"
                       class="form-control"
                       style="flex: 3"
                       placeholder="訂單號碼"
                       @if(isset($salesOrderQueryTerm['keyword']))
                       value="{{$salesOrderQueryTerm['keyword']}}"
                        @endif>
            </div>
        </div>


    </div>

    {{Form::close()}}

</div>