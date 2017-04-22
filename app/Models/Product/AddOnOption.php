<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class AddOnOption extends Model
{

    protected $fillable = [
        'title',
        'body',
        'setting_choices',
        'quantity_change_allowed' //是否可以設定數量
    ];

    /**
     * One AddOn Option can belong to  many AddOns.
     * */
    public function add_ons()
    {
        return $this->belongsToMany('App\Models\Product\AddOn', 'add_on_selected_option', 'add_on_option_id', 'add_on_id')
            ->withPivot('no', 'id', 'optionable','note')
            ->withTimestamps();
    }


    public function getSettingsArrayAttribute()
    {
        $settings = json_decode($this->attributes['setting_choices']);
        return $settings;
    }

    public function getReadableSettingsAttribute()
    {
        $settings = collect(json_decode($this->attributes['setting_choices']));

        $readableSettings = '';

        foreach ($settings as $setting) {
            $readableSettings .= "<i class='fa fa-square-o'></i>" . $setting . "&nbsp;";
        }
        return $readableSettings;
    }

    public function getSettingsStringAttribute()
    {
        $settings = collect(json_decode($this->attributes['setting_choices']));

        $settingsString = '';

        foreach ($settings as $setting) {
            $settingsString .= "-" . $setting . "&nbsp;";
        }
        return $settingsString;
    }


    /**
     * Retrieve the setting unit
     *Only useful to the setting which is allowed to change quantity.
     * @return mixed
     */
    public function getSettingUnitAttribute()
    {
        return json_decode($this->attributes['setting_choices'])[0];
    }
}
