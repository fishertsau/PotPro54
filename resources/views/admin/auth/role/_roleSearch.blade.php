<form class="navbar-form navbar-left" role="search" style="color: white;margin: 0px;" action="\admin\role">
    <input type="hidden" name="_method" value="GET">

    <div class="form-group">
        <select name="category" id="" title="請選擇類別" class="form-control" style="color: black;">
            <option value="">所有類別</option>

            @foreach(\App\Models\Authorization\Role::getCatList() as $key=> $catName)
                <option value="{{$key}}">{{$catName}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-warning">搜尋</button>
</form>