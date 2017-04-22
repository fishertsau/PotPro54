<?php

namespace App\Models\Order;

use DB;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    private $PONoFormat = "%s-%s";

    /** 訂單狀態**/
    protected static $statusList = [
        'normal' => 'n',
        'finished' => 'f',
        'rejected' => 'r',
        'cancelled' => 'c',
        'on-hold' => 'o'
    ];

    protected static $statusTextList = [
        'n' => '正常',
        'r' => '退件',
        'c' => '取消',
        'o' => '暫停',
        'f' => '完成',
    ];


    /** 訂單階段****/
    protected static $phaseList = [
        'start' => 's',
        'auditing' => 'a',
        'production' => 'p',
        'stocking' => 'k',
        'shipping' => 'i',
        'finished' => 'f'
    ];

    protected static $phaseTextList = [
        's' => '訂購',
        'a' => '審核',
        'p' => '生產',
        'k' => '入庫',
        'i' => '出貨',
        'f' => '完成'
    ];

    /** 階段狀態**/
    protected static $phaseStatusList = [
        'TBP' => 't',
        'processing' => 'p',
        'finished' => 'f',
        'on-hold' => 'o',
        'cancelled' => 'c'
    ];

    protected static $phaseStatusTextList = [
        't' => '待處理',
        'p' => '處理中',
        'f' => '完成',
        'o' => '暫停',
        'c' => '取消'
    ];


    protected $fillable = [
        'po_no',
        'amount',
        'qty',

        'status_flag',
        'phase',
        'phase_status_flag',

        'buyer_id',
        'entry_user_id'
    ];

    protected $appends = [
        'status_text',
        'phase_text',
        'phase_status_text',
        'cancellable_by_sales'];


    protected $casts = [
        'cancellable_by_sales' => 'boolean',
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(
            function ($order) {
                $order->po_no = $order->createPONo();
            });
    }


    public function ownedBy(User $user)
    {
        return $this->buyer_id == $user->id;
    }

    /**
     * setup the relationship between Orders and Buyer.
     * @retrun App\User;
     */
    public function buyer()
    {
        return $this->belongsTo('App\User', 'buyer_id');
    }

    /**
     * setup the relationship between Orders and entry_person.
     * The person who places the order
     * @retrun App\User;
     */
    public function entry_person()
    {
        return $this->belongsTo('App\User', 'entry_user_id');
    }

    /**
     * setup the relationship between Orders and  OrderItems.
     * @retrun App\User;
     */
    public function items()
    {
        return $this->hasMany('App\Models\Order\OrderItem');
    }

    /**
     * setup the relationship between Order and  OrderStatusRecord
     * @retrun App\User;
     */
    public function auditRecords()
    {
        return $this->hasMany('App\Models\Order\OrderStatusRecord');
    }

    /**
     * setup the relationship between Group and SubCategory.
     * @retrun App\Category;
     */
    public function shipment()
    {
        return $this->hasOne('App\Models\Order\OrderShipment');
    }


    /****   訂單狀態  Start*******/
    /**
     *  get the Category for News
     * @return array
     */
    public static function getStatusList()
    {
        return self::$statusList;
    }

    /**
     *  get the Category for News
     * @return array
     */
    public static function getStatusTextList()
    {
        return static::$statusTextList;
    }

    public static function getStatusChar($status)
    {
        return static::$statusList[$status];
    }

    public function getStatusTextAttribute()
    {
        return static::$statusTextList[$this->status_flag];
    }

    /****   訂單狀態  End*******/


    /****   進行階段  Start*******/
    public static function getPhaseChar($phase)
    {
        return self::$phaseList[$phase];
    }


    public static function getPhaseStatusChar($phaseStatus)
    {
        return self::$phaseStatusList[$phaseStatus];
    }

    /**
     *  get the Category for News
     * @return array
     */
    public static function getPhaseTextList()
    {
        return self::$phaseTextList;
    }

    public function getPhaseTextAttribute()
    {
        return self::$phaseTextList[$this->phase];
    }

    /****   進行階段  End*******/


    public function getCancellableBySalesAttribute()
    {
        return $this->cancellableBySales();
    }


    /****   階段狀態  Start*******/
    public function getPhaseStatusTextAttribute()
    {
        return self::$phaseStatusTextList[$this->phase_status_flag];
    }


    public static function getPhaseStatusTextList()
    {
        return self::$phaseStatusTextList;
    }

    /****   階段狀態  End*******/


    public function scopePlacedBetween($query, $begin_since, $end_until)
    {
        if ($begin_since == "%") {
            return $query;
        }

        //日期區間
        return $query->whereBetween((DB::raw('CAST(orders.created_at as DATE)')), [$begin_since, $end_until]);
//        return $query->whereBetween( 'created_at', [$begin_since, $end_until]);
    }


    public function scopeKeywordBy($query, $keyword_by, $keyword)
    {
        //add wildcard before and after keyword
        $keyword = '%' . $keyword . '%';

        if ($keyword_by == 'po_no') {
            return $query->where('po_no', 'like', $keyword);
        }

        if ($keyword_by == 'buyer_name') {
            return $query->join('users', 'orders.buyer_id', '=', 'users.id')
                ->select('orders.*', 'users.name')
                ->where('name', 'like', $keyword);
        }

    }

    public function scopeTargetStatus($query, $status_flag, $phase, $phase_status_flag)
    {
        return $query->
        where('status_flag', 'like', $status_flag)->
        where('phase', 'like', $phase)->
        where('phase_status_flag', 'like', $phase_status_flag);
    }

    public function cancellableBySales()
    {
        return (
            $this->status_flag == 'n' &&
            $this->phase == 'a' &&
            $this->phase_status_flag == 't');
    }


    /**
     * Generate new PO No for this PO
     * @return string
     */
    protected function createPONo()
    {
        $todayString = getTodayString();
        $serial = $this->generateNewPOSerial($todayString);

        return
            sprintf(
                $this->PONoFormat,
                $todayString,
                $serial
            );
    }


    protected function generateNewPOSerial($todayString)
    {
        $latestOrder =
            Order::where('po_no', 'like', $todayString . '%')
                ->orderBy('id', 'desc')
                ->first();

        if ($latestOrder == null) {
            return '001';
        }

        $lastSerial = hexdec(substr($latestOrder->po_no, -3));

        $newSerial = dechex($lastSerial + 1);

        return normalizeTo3LetterSN($newSerial);
    }
}
