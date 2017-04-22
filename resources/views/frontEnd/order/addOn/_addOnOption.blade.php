<div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12">
        <img src="{{URL::asset('assets/images/cover')}}/{{ $add_on->coverPhoto_path=='' ? 'coverPhoto.jpg' : $add_on->coverPhoto_path}}"
             style="width: 100%">
    </div>

    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="form-horizontal">
            {{--配件設定內容--}}
            <table class="full-width table table-bordered">
                <thead>
                <tr>
                    <th style="width:10%" class="text-center">選擇</th>
                    <th style="width:10%" class="text-center">編號</th>
                    <th style="width:80%" class="text-center">設定</th>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($add_on->options as $option)
                    <tr>
                        <input type="hidden" name="settingOptionId-for-addOnId-{{$add_on->id}}[]"
                               value="{{$option->id}}">
                        {{--選擇--}}
                        <td class="text-center">
                            @if($option->pivot->optionable)
                                <input type="checkbox"
                                       name="settingNoChosen-for-addOnId-{{$add_on->id}}[]"
                                       value="{{$option->pivot->no}}"
                                        {{isset($add_on_setting[$add_on->id][$option->pivot->no]) ?
                                                    'checked':''}}>
                            @else
                                <input type="hidden"
                                       name="settingNoChosen-for-addOnId-{{$add_on->id}}[]"
                                       value="{{$option->pivot->no}}">
                                <span>-</span>
                            @endif
                        </td>

                        {{--設定編號--}}
                        <td class="text-center">
                            <input type="hidden" name="settingNo-for-addOnId-{{$add_on->id}}[]"
                                   value="{{$option->pivot->no}}">
                            {{$option->pivot->no}}
                        </td>

                        <td>
                            @include('frontEnd.order.addOn._addOnOptionSetting')
                            <span class="text-danger">
                                {{$option->pivot->note}}/{{$option->body}}
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>