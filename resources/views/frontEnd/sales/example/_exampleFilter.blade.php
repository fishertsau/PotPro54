<div class="app-filterBlock">
    <div style="display: flex;">
        <button class="btn btn-warning full-width" style="flex: 1;margin-right: 0.5em;"
        @click="exampleFilterShow=!exampleFilterShow">

        查詢條件&nbsp;
        <i class="fa fa-plus" aria-hidden="true" v-show="!exampleFilterShow"></i>
        <i class="fa fa-minus" aria-hidden="true" v-show="exampleFilterShow"></i>
        </button>

        <button class="btn btn-danger full-width" style="flex: 1;margin-left: 0.5em"
                @click.prevent="doNewExampleSearch">
            案例查詢&nbsp;<i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </div>

    {{Form::open(['method'=>'get', 'id'=>'exampleSearchForm'])}}
    {{csrf_field()}}
    <input type="hidden" name="newSearch" value='1'>

    <div class="app-filterBlock__form" v-show="exampleFilterShow">
        <div class="row">
            <div class="col-md-6 app-filterBlock__form__inputItem">
                <p class="title-potmaster app-filterBlock__form__inputItem__title">狀態</p>

                <div style="display: flex">
                    <select name="activated"
                            id="activated"
                            class="form-control"
                            style="flex: 1">
                        <option value="">所有</option>
                        <option value="1">開通</option>
                        <option value="0">未開通</option>
                    </select>

                    <select name="published"
                            id="published"
                            class="form-control"
                            style="flex: 1">
                        <option value="">所有</option>
                        <option value="1">公開</option>
                        <option value="0">未公開</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 app-filterBlock__form__inputItem">
                <p class="title-potmaster app-filterBlock__form__inputItem__title">案例名稱&nbsp;
                    <button class="btn btn-default btn-xs pull-right" type="reset">
                        清除設定
                    </button>
                </p>
                <input type="text" class="hidden"
                       name="keyword_by"
                       value="example_title">
                <input name="keyword"
                       id="keyword"
                       type="text"
                       class="form-control"
                       style="flex: 3"
                       placeholder="案例名稱">
            </div>
        </div>

    </div>

    {{Form::close()}}
</div>