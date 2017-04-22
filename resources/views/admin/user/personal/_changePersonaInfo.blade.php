<div class="row">
    <br/>

    <div class="col-md-4">

        <div class="form-horizontal">
            <!--主要圖片-->
            <div class='form-group'>

                <div class="col-sm-12">
                    <?php $path = ($user->avatar == '') ? 'man-icon.jpg' : $user->avatar; ?>
                    @include('partials._coverPhotoDropzone' ,[
                          'id'=>$user->id,
                          'path' =>$path,
                          'associatedTable'=>'users',
                          'fieldName'=>'avatar'])
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        {!! Form::model($user, ['method' => 'POST', 'action' => ['Admin\UserController@updatePersonalInfo', $user->id]]) !!}

        {{--姓名--}}
        <div class="form-group">
            <label for="name"
                   class=" control-label">@lang('user/form.name')</label>

            <div class="">
                {!! Form::text('name', null , ['class'=>'form-control','placeholder'=>'姓名','id'=>'name','required'=>true]) !!}
            </div>
        </div>

        {{--電子郵件--}}
        <div class="form-group">
            <label for="Email"
                   class=" control-label">電子郵件</label>

            <div class="">
                {!! Form::text('email', null , ['class'=>'form-control','placeholder'=>'電子郵件','id'=>'name','required'=>true]) !!}
            </div>
        </div>

        <!-- Address Form Input -->
        <div class="form-group">
            {{Form::label('address','地址',['class'=>'control-label'])}}
            <div class="">
                {!! Form::text('address',null, ['class'=>'form-control','id'=>'address','placeholder'=>'地址']) !!}
            </div>
        </div>


        <!-- Zip Form Input -->
        <div class="form-group">
            {{Form::label('zip','郵遞區號')}}
            {{Form::text('zip',null,['class'=>'form-control','placeholder'=>'郵遞區號'])}}
        </div>

        <!-- Tel Form Input -->
        <div class="form-group">
            {{Form::label('tel','電話')}}
            {{Form::text('tel',null,['class'=>'form-control','placeholder'=>'電話'])}}
        </div>


        <div class="form-group">
            <div class="">
                <button type="submit" class="btn btn-success">
                    @lang('button.save')
                </button>
            </div>
        </div>
        {{Form::close()}}
    </div>

</div>
<br/>
