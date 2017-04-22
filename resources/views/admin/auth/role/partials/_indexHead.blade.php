<h4 class="panel-title pull-left"><i class="livicon" data-name="list" data-size="16"
                                     data-loop="true" data-c="#fff" data-hc="white"></i>
    @lang('role/title.groupslist')
</h4>

<div class="pull-right">
    @include('admin.auth.role._roleSearch')

    <a href="{{ url('admin/role/create') }}" class="btn btn-sm btn-default"><span
                class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    <a href="{{ url('admin/role/listByCat') }}" class="btn btn-sm btn-success">類別清單</a>
    <form method="post" action="{{route('storeRoleList')}}" style="display: inline">
        {{csrf_field()}}
        <button class="btn btn-sm btn-danger" type="submit">儲存清單</button>
    </form>
</div>