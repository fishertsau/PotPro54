{{--How to Use--}}

{{--css--}}
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css" rel="stylesheet">--}}

{{--js}}
<!-- DropZone js-->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone4.2.0.js"></script>--}}
{{--<script type="text/javascript" src="{{ asset('assets/js/admin/myDropZoneControl.js')}}"></script>--}}

{{--Usage--}}
{{--@include('partials._coverPhotoDropzone' ,[--}}
{{--'id'=>$user->id,--}}
{{--'path' =>$user->avatar,--}}
{{--'associatedTable'=>'users',--}}
{{--'fieldName'=>'avatar'])--}}
{{--'fieldName':  The photoPath for the corresponding table--}}

<?php $hasPhoto = (isset($path) and ($path != ''));
$path = !$hasPhoto ? "coverPhoto.jpg" : $path; ?>

<div class="dz-photo_block full-width"
     id="dz-photo_block-{{$associatedTable}}{{$id}}"
     style="position: relative;">

    {{--View--}}
    <img class="dz-photo"
         id="dz-photo-{{$associatedTable}}{{$id}}"
         src="{{URL::asset('assets/images/cover')}}/{{ $path }}"
         style="max-width: 100%; margin-bottom:10px;">

    <div class="dz-loading"
         id="dz-loading-{{$associatedTable}}{{$id}}"
         style="position: absolute;left:0px; top:0px; width: 100%;height:100%;
            display:none;
            background-color:white;
            z-index:10">
        <span style="position: absolute;left:30%;top:30%;">
            <i class="fa fa-spinner fa-pulse fa-5x"></i> <br/>檔案上傳中
        </span>
    </div>

    {{--Dropzone Input Control--}}
    <div class="dropzone dz-SingleUpload"
         id="dz-SingleUpload-{{$associatedTable}}{{$id}}"
         style="
         position: absolute;
         left:0px;top:0px;z-index:400;
         width: 100%; height:100%;
         opacity:0;"
            >
    </div>

    {{--Control Button--}}
    <span class="dz-deleteBtn btn btn-danger"
          id="dz-deleteBtn-{{$associatedTable}}{{$id}}"
          onclick="deleteCoverPhoto(this)"
          style="position: absolute;
                  top:5px;left:5px; z-index:500;
          {{--                  {{ (isset($path) and !($path!='')) ? :'display:none'}}">--}}
          {{  !$hasPhoto ?'display:none' :''}}">
                    <i class="fa fa-trash-o"></i>&nbsp;刪除圖片
    </span>

    {{--Control Data--}}
    <div class="dz-nodeInfo hidden"
         id="coverPhotoInfo"
         data-url="/coverPhoto/{{$associatedTable}}/{{$id}}"
         belongsTo="{{$associatedTable}}"
         entryId="{{$id}}"
         foreignTable="{{(isset($foreignTable))?$foreignTable:''}}"
         foreignKey="{{(isset($foreignKey))?$foreignKey:0}}"
         fieldName="{{(isset($fieldName))?$fieldName:''}}">
    </div>
</div>

