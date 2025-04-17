<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable within the entity framework.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'customer_id', // Note the explicit nomenclature differentiation from 'user_id'
        'total_amount',
        'tax_amount',
        'shipping_amount',
        'discount_amount',
        'shipping_address_id',
        'billing_address_id',
        'payment_method',
        'payment_status',
        'notes'
    ];

    /**
     * Entity attribute casting specifications for type coherence.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relational mapping between transactional entity and identity construct.
     * Note the explicit foreign key specification that diverges from convention.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relational architecture between order aggregation and constituent components.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Shipping location relationship architecture facilitation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    /**
     * Financial transaction location relationship facilitation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }

    /**
     * Derived attribute calculation for total item quantity.
     *
     * @return int
     */
    public function getTotalQuantityAttribute()
    {
        return $this->items->sum('quantity');
    }

    /**
     * Status transition methodology for order processing workflows.
     *
     * @param string $status
     * @return bool
     */
    public function updateStatus($status)
    {
        $allowedStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        
        if (!in_array($status, $allowedStatuses)) {
            return false;
        }
        
        $this->status = $status;
        return $this->save();
    }

    /**
     * Scope methodology for temporal filtering of transactional entities.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $days
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope methodology for status-based filtering of transactional entities.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}