<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreItem extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'store_items';

    // Mass assignable fields
    protected $fillable = [
        'item_code',
        'barcode',
        'category_id',
        'unit_id',
        'tax_id',
        'item_name',
        'bin_and_rack',
        'quantity',
        'unit_purchase_cost',
        'unit_selling_price',
        'tax_applicable',
        'disabled',
    ];

    /**
     * Relationships
     */

    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(StoreItemCategory::class, 'category_id');
    }

    // Relationship to Unit
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    // Relationship to Tax
    public function tax()
    {
        return $this->belongsTo(StoreTax::class, 'tax_id');
    }

    /**
     * Accessors & Mutators
     */

    // Example accessor to format the item name
    public function getFormattedNameAttribute()
    {
        return strtoupper($this->item_name);
    }

    // Example mutator to sanitize the item name before saving
    public function setItemNameAttribute($value)
    {
        $this->attributes['item_name'] = ucfirst(strtolower($value));
    }

    /**
     * Scopes
     */

    // Scope for active items
    public function scopeActive($query)
    {
        return $query->where('disabled', false);
    }

    // Scope for items with applicable tax
    public function scopeTaxApplicable($query)
    {
        return $query->where('tax_applicable', true);
    }

    /**
     * Additional Methods
     */

    // Calculate total cost with tax
    public function calculateTotalCost()
    {
        if ($this->tax && $this->tax_applicable) {
            $taxAmount = ($this->unit_purchase_cost * $this->tax->percentage) / 100;
            return $this->unit_purchase_cost + $taxAmount;
        }

        return $this->unit_purchase_cost;
    }
}
