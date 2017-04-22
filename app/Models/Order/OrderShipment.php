<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderShipment extends Model
{
    protected $fillable = [
        'shipper',
        'sales_slip_no',
        'tracking_no',
        'shipped_at',
        'note',
        'recorder_id'
    ];


    protected $dates = ['shipped_at'];

    /**
     * setup the relationship between Order and OrderShipment.
     * @retrun App\Category;
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order\Order');
    }

    public function entry_person(){
        return $this->belongsTo('App\User', 'recorder_id');
    }
}
