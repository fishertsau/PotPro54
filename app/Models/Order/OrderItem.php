<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'group_id',
        'product_id',
        'type',
        'qty',
        'price',
        'subtotal',
        'options',
        'note'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
    ];

    /**
     * setup the relationship between order and OrderItem.
     * @retrun App\Category;
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order\Order');
    }

    /**
     * setup the relationship between order shipment and  Recorder.
     * @retrun App\User;
     */
    public function recorder()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    /**
     * setup the relationship between OrderItem and Product/AddOn.
     * @retrun App\Category;
     */
    public function item()
    {
        switch ($this->type) {
            case 'add_on':
                return $this->belongsTo('App\Models\Product\AddOn', 'product_id');
                break;
            case 'product':
                return $this->belongsTo('App\Models\Product\Product', 'product_id');
                break;
        }
    }

    public function getTypeTextAttribute()
    {
        switch ($this->type) {
            case 'add_on':
                $typeText = '加工';
                break;
            case 'product':
                $typeText = '產品';
                break;
        }

        return $typeText;
    }


    public function getSettingAttribute()
    {
        return isset($this->options['setting']) ?
            $this->options['setting'] : '';
    }
}
