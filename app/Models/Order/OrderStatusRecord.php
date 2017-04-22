<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderStatusRecord extends Model
{
    protected $dates = ['created_at'];

    protected $fillable = [
        'auditor_id',
        'action',
        'comments',
        'created_at'
    ];

    public $timestamps = false;

    /**
     * setup the relationship between Order and Order Status Record.
     * @retrun App\Models\Order\Order;
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order\Order');
    }


    public function auditor()
    {
        return $this->belongsTo('App\User', 'auditor_id');
    }

}
