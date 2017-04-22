<div class="modal fade" id="createExampleForm__modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <form action="" method="post" id="exampleCreateForm"
              @submit.prevent="postExampleCreateForm()">
            {{csrf_field()}}
            <input type="text" class="hidden" name="manager_id" value="{{$sales->id}}">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-flag"
                                                                 aria-hidden="true"></i>&nbsp;<b>建立</b>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <!-- 店面名稱 Form Input -->
                        <div class="form-group">
                            {{Form::label('title','案例名稱',['class'=>'col-sm-3 control-label title-potmaster'])}}
                            <div class="col-sm-9">
                                {!! Form::text('title',null, ['class'=>'form-control','name'=>'title','id'=>'title','placeholder'=>'輸入案例名稱','required'=>true]) !!}
                            </div>
                        </div>

                        <!--  Form Input -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="agreeTerm" required> 您同意案例會由公司協助管理.
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <p class="note">*請填寫完整資料,以便案例會快速地被搜尋到!</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-share" aria-hidden="true"></i>&nbsp;建立店面
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
