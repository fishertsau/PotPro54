<div class="col-md-4 col-xs-6 col-sm-6 thumbnail"
     style="position:relative"
     id="photoId_{{$photo->id}}">
    <img src="{{URL::asset('assets/images/photos')}}/{{$photo->path}}" width="100%">

    <span class="text-danger deletePhotoBtn"
          style="position: absolute;right:15px;top:10px;background-color: yellow;padding:2px;border: solid 1px red;"
          photoId="{{$photo->id}}">
        <i class="fa fa-trash-o"></i>刪除</span>
</div>
