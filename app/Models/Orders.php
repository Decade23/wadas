<?php

namespace App\Models;

use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'order_date', 'customer_id', 'type', 'type', 'total_price', 'payment_status', 'paid_at', 'bank_id','due_date', 'agent_id'
    ];

    /**
     * Show Order Details Data
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(){
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }

    public function shipping(){
        return $this->hasMany(Shipping::class, 'order_id', 'id');
    }

    public function media(){
        return $this->hasMany(Media::class, 'item_id', 'id')->where('model', 'Order');
    }

    /**
     * Get Customers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent(){
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank(){
        return $this->belongsTo(Bank::class);
    }

    /**
     * Show Complain Data
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complains(){
        return $this->hasMany(Complains::class, 'order_id', 'id');
    }

    /**
     * Filter By Agent ID
     *
     * @param $query
     * @param $agentId
     *
     * @return mixed
     */
    public function scopeByAgentId($query, $agentId){
        if($agentId !== null){
            return $query->where('agent_id', $agentId);
        }
        return $query;
    }

    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeByPaymentStatus($query, $status){
        if($status !== null){
            return $query->where('payment_status', $status);
        }
        return $query;
    }

    public function scopePrice($query){
        return $query->where('total_price','>', 0);
    }

    public function scopeIsPriceNull($query){
        return $query->where('total_price','<', 1);
    }

    /**
     * Filter By Order Date
     * @param $query
     * @param $orderDate
     *
     * @return mixed
     */
    public function scopeOrderDate($query, $orderDate) {
        if($orderDate != null) {
            return $query->where('order_date', $orderDate);
        }

        return $query;
    }

    /**
     * Filter By Paid At
     * @param $query
     * @param $paidAt
     *
     * @return mixed
     */
    public function scopePaidAt($query, $paidAt) {
        if($paidAt != null) {
            return $query->where('paid_at', $paidAt);
        }

        return $query;
    }

    /**
     * Filter By Due Date
     *
     * @param $query
     * @param $dueDate
     *
     * @return mixed
     */
    public function scopeDueDate($query, $dueDate) {
        if($dueDate != null) {
            return $query->where('due_date', $dueDate);
        }

        return $query;
    }

    /**
     * Filter By Type
     * @param $query
     * @param $type
     *
     * @return mixed
     */
    public function scopeType($query, $type) {
        if($type != null){
            return $query->where('type', $type);
        }

        return $query;
    }

    /**
     * Filter By Seller
     * @param $query
     * @param $seller
     *
     * @return mixed
     */
    public function scopeSeller($query, $seller) {
        if($seller != null) {
            return $query->whereIn('agent_id', $seller);
        }

        return $query;
    }

    public function getDueDateOrderAttribute()
    {
        //return Carbon::parse($this->due_date)->format('d M Y, h:i:s');
        return date('d M Y, h:i:s', strtotime($this->due_date));
    }

    public function getCreatedAtOrderAttribute()
    {
        //return Carbon::parse($this->created_at)->format('d M Y, h:i:s');
        return date('d M Y, h:i:s', strtotime($this->created_at));
    }

    public function getCreatedAtAttribute($value){
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function GetPaymentStatusViewAttribute() {
        $baseValue = strtolower($this->payment_status);
        $res = '';

        switch ($baseValue) {
            case 'paid':
                $res = sprintf('<span class="kt-badge kt-badge--inline kt-badge--success">%s</span>', strtoupper($this->payment_status));
            break;

            case 'unpaid':
                $res = sprintf('<span class="kt-badge kt-badge--inline kt-badge--warning">%s</span>', strtoupper($this->payment_status));
                break;

            case 'cancel':
                $res = sprintf('<span class="kt-badge kt-badge--inline kt-badge--danger">%s</span>', strtoupper($this->payment_status));
                break;

            default:
                $res;
        }

        return $res;
    }
}
