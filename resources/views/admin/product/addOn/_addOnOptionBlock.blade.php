<tr class="add-on-option" id="{{ ($newItem) ? 'add-on-option' : 'add-on-option_'.$selected_option->id }}">
    <input type="hidden" class="add-on-option-input" name="add_on_selected_option_id[]"
           value="{{ ($newItem) ? 0 : $selected_option->pivot->id }}">
    <td>
        {!! Form::select('optionable[]', ['1'=>"是",'0'=>"否"], ($newItem) ? '' : $selected_option->pivot->optionable ,
        ['class'=>'add-on-option-input form-control']) !!}
    </td>
    <td>
        <input type="text" name="no[]" class="form-control add-on-option-input add-on-no"
               value="{{($newItem) ? '' : $selected_option->pivot->no}}"
               pattern="[^\[\]]+"
               required>
    </td>
    <td>
        {{--todo: implement this--}}
{{--
        {!! Form::select('add_on_option_id[]', $add_on_option_list, ($newItem) ? '' : $selected_option->pivot->add_on_option_id ,
        ['class'=>'add-on-option-input add-on-option-selection form-control','onChange'=>'updateSetting(this,"add-on-option");']) !!}
--}}
    </td>
    <td class="text-left">
        <p class="add-on-option-setting add-on-option-text">
            {!! ($newItem) ? '' : $selected_option->readable_settings !!}
        </p>

    </td>
    <td class="visible-desktop-cell">
        <input type="text" name="note[]" class="form-control add-on-option-input add-on-no"
               value="{{($newItem) ? '' : $selected_option->pivot->note}}"
               placeholder="輸入附註">

        <p class="text-primary add-on-option-body">
            {{($newItem) ? '' : $selected_option->body}}
        </p>
    </td>

    <td><i class="fa fa-minus-square text-danger"
           onclick="fewerBlock(this,'add-on-option')"></i></td>
</tr>