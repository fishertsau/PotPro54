<div class="app-addOnInfo">

    <div class="app-addOnInfo--title">
        <h4 class="title-potmaster">
            <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;{{$add_on->title}}
        </h4>
        <p class="text-danger">{{$add_on->body}}</p>
    </div>

    {{--配件單位數量--}}
    <div class="app-addOnInfo--unitQty">
        <div class="app-addOnInfo--unitQty--title">單位數量</div>
        <div class="app-addOnInfo--unitQty--input">
            <?php $qty = (isset($add_on_unit_qty[$add_on->id])) ? $add_on_unit_qty[$add_on->id] : 1; ?>
            @if($add_on->quantity_change_allowed)
                <input name="add-on-unit-qty[]"
                       type="number"
                       class="form-control"
                       placeholder="單位數量"
                       min="1"
                       value="{{$qty}}" required>
            @else
                <input name="add-on-unit-qty[]"
                       type="hidden"
                       class="form-control" value="1" required>
                <p>1</p>
            @endif
        </div>
    </div>

    {{--配件附註--}}
    <div class="app-addOnInfo--note">
        <input name="add-on-note[]" type="text" class="form-control"
               pattern="[^\(\)]+" placeholder="附註">
    </div>

    <br/>
</div>
