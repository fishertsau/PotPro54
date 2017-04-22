<div class="col-md-12" style="border:1px solid lightgrey;">
    <h4 class="title-potmaster"><i class="fa fa-folder-open-o" aria-hidden="true"></i>&nbsp;案例管理</h4>

    <div class="form-horizontal">
        <!-- 開通 Form Input -->
        <div class="form-group">
            {{Form::label('activated','開通',['class'=>'col-sm-2 control-label'])}}
            <div class="col-sm-10">
                {!! Form::radio('activated', '1',true) !!} 開通 &nbsp;&nbsp;&nbsp;&nbsp;
                {!! Form::radio('activated', '0',true) !!} 關閉
            </div>
        </div>

        <!-- 熱門 Form Input -->
        <div class="form-group">
            {{Form::label('hot','熱門',['class'=>'col-sm-2 control-label'])}}
            <div class="col-sm-10">
                {!! Form::radio('hot', '1',true) !!} <i class="fa fa-star" aria-hidden="true"></i>是&nbsp;&nbsp;&nbsp;&nbsp;
                {!! Form::radio('hot', '0',true) !!} <i class="fa fa-star-o" aria-hidden="true"></i>否
            </div>
        </div>

        <hr>
        <!-- 管理者 Form Input -->
        <div class="form-group">
            {{Form::label('manager_id','管理者',['class'=>'col-sm-2 control-label'])}}
            <div class="col-sm-3">
                <input type="text" class="hidden"
                       v-model="manager.id"
                       name="manager_id">

                <p class="form-control-static" v-show="hasManager">
                    @{{ manager.name }}
                </p>

                <p v-show="!hasManager" class="text-danger">尚未設定</p>


            </div>
            <div class="col-sm-3">
                <button class="btn btn-warning form-control-static"
                        @click.prevent="popupManagerSelectionList">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;
                    新增/更新管理者
                </button>
                <p class="text-danger">*由通路中選擇</p>
            </div>
            <div class="col-sm-3">
                <button class="btn btn-danger"
                        @click.prevent="deleteManager">
                    <i class="fa fa-user-times" aria-hidden="true"></i>&nbsp;
                    刪除管理者
                </button>
            </div>
        </div>
    </div>
</div>



