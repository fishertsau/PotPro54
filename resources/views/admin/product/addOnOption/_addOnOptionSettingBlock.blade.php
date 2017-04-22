<div class="input-group add-on-option-setting moreBlock">
    <input type="text"
           class="form-control add-on-option-setting-input"
           placeholder="選項內容" name="setting[]"
           value="{{ ($newItem) ? '' : $setting }}"
           pattern="[^\']+"
           required>
        <span class="input-group-addon">
            <i class="fa fa-minus-square text-danger"
               onclick="fewerBlock(this,'add-on-option-setting')"></i>
        </span>
</div>