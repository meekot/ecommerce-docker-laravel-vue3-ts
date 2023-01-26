<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerAddresse
 *
 * @property int $id
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string|null $state
 * @property string $postal_code
 * @property string $country_code
 * @property int $customer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAddresse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomerAddresse extends Model
{
    use HasFactory;
}
