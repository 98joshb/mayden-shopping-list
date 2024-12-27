<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $table = 'shopping_lists';
    protected $fillable = ['user_id', 'created_by'];

    public function items()
    {
        return $this->hasMany(ShoppingListItem::class);
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
