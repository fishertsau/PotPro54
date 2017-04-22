<div class="row">
    <div class="col-lg-12">

        <h4 class="title-potmaster"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;基本資料</h4>

        <div class="row">

            <div class="col-md-12">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>@lang('user/title.name')</td>
                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>

                            <tr>
                                <td>@lang('user/title.email')</td>
                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @lang('user/title.gender')
                                </td>
                                <td>
                                    {{ $user->gender }}
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('user/title.dob')</td>
                                <td>
                                    {{ $user->dob }}
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('user/title.country')</td>
                                <td>
                                    {{ $user->country }}
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('user/title.state')</td>
                                <td>
                                    {{ $user->state }}
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('user/title.city')</td>
                                <td>
                                    {{ $user->city }}
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('user/title.address')</td>
                                <td>
                                    {{ $user->address }}
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('user/title.postal')</td>
                                <td>
                                    {{ $user->postal }}
                                </td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>
        </div>

        <hr/>
        <h4 class="title-potmaster"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;系統資料</h4>
        <br/>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <td>狀態</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>建立時間</td>
                        <td>
                            {{ $user->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <td>登入次數</td>
                        <td>
                            {{ $user->login_count }}
                        </td>
                    </tr>
                    <tr>
                        <td>上次登入時間</td>
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td>所屬群組</td>
                        <td>
                            <ul>
                                @foreach($user->roles as $role)
                                    <li>{{$role->name}}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td>擁有權限</td>
                        <td>
                            <ul>
                                @foreach($user->ownsPermission() as $permission)
                                    <li>{{$permission->description}}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>