<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Countrie
 *
 * @property string $code
 * @property string $name
 * @property mixed|null $states
 * @method static \Illuminate\Database\Eloquent\Builder|Countrie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Countrie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Countrie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Countrie whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Countrie whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Countrie whereStates($value)
 * @mixin \Eloquent
 */
class Countrie extends Model
{
    use HasFactory;
}
