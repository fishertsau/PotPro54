<div class="form-group">
    {!! Form::label('photo_path', '主要圖片',['class'=>'col-sm-2 control-label']) !!}

    <div class="col-sm-10">
        {{--View--}}
        <div style="position: relative">
            <img id="cover_photo"
                 src="{{URL::asset('assets/images/cover')}}/{{ ( !isset($path) or ($path == '')) ? "coverPhoto.jpg" : $path }}"
                 style="max-width: 968px; margin-bottom:10px;">

            <div id="loading" style="
            position: absolute;
            left:0px;
            top:0px;
            z-index:10;
            display:none;
            background-color:white;
            width: 100%;
            height:100%">
                    <span style="position: absolute;left:30%;top:30%;">
                        <i class="fa fa-spinner fa-pulse fa-5x"></i> <br/>檔案上傳中
                        </span>
            </div>
            <p class="note">尺寸:4:3 建議畫素 400px X 300px</p>

            {{--Input Control--}}
            <input type="file" id="coverPhoto_file" name="coverPhoto_file"
                   style="cursor: pointer;
                          direction: ltr;
                          width: 100%;
                          height: 100%;

                          position: absolute;
                          left: 0;
                          top: 0;

                          opacity: 0;
                          z-index: 4;">


            {{--Contorl Button--}}
            <span class="text-primary" id="delCoverPhotoBtn"
                  style="position: absolute;
                          top:5px;left:5px;
                          z-index:100;
                  @unless( isset($path) and !($path=='')) display:none @endunless
                          ">
                <a class="btn btn-danger" id="delCoverPhoto"
                   belongsTo="{{$associatedTable}}"
                   entryID="{{$id}}">
                    <i class="fa fa-trash-o"></i>&nbsp;刪除圖片
                </a>
            </span>
        </div>

        {{--Controll Data--}}
        <div id="coverPhotoInfo" style="display: none;"
             data-url="/coverPhoto/{{$associatedTable}}/{{$id}}">
        </div>
    </div>
</div>
