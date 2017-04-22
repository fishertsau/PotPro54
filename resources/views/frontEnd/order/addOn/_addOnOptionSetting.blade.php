<div class="app-addOnOptionSetting">
    {{--名稱--}}
    <div class="addOnOptionSetting--title">
        <input type="hidden"
               name="settingTitle-for-addOnId-{{$add_on->id}}[]"
               value="{{$option->title}}">
        <h5 class="{{--title-potmaster--}} text-primary">{{$option->title}}:&nbsp;</h5>
    </div>

    {{--設定值--}}
    <div class="app-addOnOptionSetting--value">
        <?php $value = isset($add_on_setting[$add_on->id][$option->pivot->no]) ?
                $add_on_setting[$add_on->id][$option->pivot->no]['setting'] :
                1;
        ?>
        <input type="hidden"
               name="setting-for-addOnId-{{$add_on->id}}[]"
               value="{{$value}}"
               id="setting-input-{{$add_on->id}}-{{$option->pivot->no}}">


        @if($option->quantity_change_allowed)
            <div class="input-group input-group-sm">
                <input type="number"
                       class="form-control setting-input"
                       placeholder="數量"
                       target-setting="setting-input-{{$add_on->id}}-{{$option->pivot->no}}"
                       value="{{(isset($value))?$value:1}}">
                                                        <span class="input-group-addon"
                                                              style="font-size: small;background-color: black">{{$option->setting_unit}}</span>
            </div>
        @else
            @foreach($option->settings_array as $setting)
                <input type="radio" class="setting-input"
                       value="{{$setting}}"
                       target-setting="setting-input-{{$add_on->id}}-{{$option->pivot->no}}"
                       name="setting-input-{{$add_on->id}}-{{$option->pivot->no}}"
                       @if($setting == $value)
                       checked
                        @endif
                        > {{$setting}}<br>
            @endforeach
        @endif
    </div>

    {{--設定附註--}}
    <div class="app-addOnOptionSetting--note">

        <?php $note = isset($add_on_setting[$add_on->id][$option->pivot->no]) ?
                $add_on_setting[$add_on->id][$option->pivot->no]['note'] :
                '';
        ?>
        <input type="text" placeholder="附註" class="form-control"
               name="settingNote-for-addOnId-{{$add_on->id}}[]"
               value="{{$note}}"
               pattern="[^\(\)]+">
    </div>
</div>