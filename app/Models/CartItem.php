<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CartItem
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereUserId($value)
 * @mixin \Eloquent
 */
class CartItem extends Model
{
    use HasFactory;
}
