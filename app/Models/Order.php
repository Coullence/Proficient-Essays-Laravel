<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

class Order extends Model
{

    use HasRoleAndPermission;
    use Notifiable;
    use SoftDeletes;
        const default = 1;

    
       protected $fillable = [
     
            'OUID',
            'user_id',
            'name',
            'email',
            'phone',
            'category',
            'topic',
            'question',
            'instructions',
            'file',
            'pages',
            'format',
            'due',
            'duration',
            'pricing',
            'order_ip_address',
            'admin_ip_address',
            'updated_ip_address',
            'deleted_ip_address',
            'status',


    ];


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',

    ];

  

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
       

            'OUID'                        => 'string',
            'name'                        => 'string',
            'email'                       => 'string',
            'phone'                       => 'string',
            'category'                    => 'string',
            'topic'                       => 'string',
            'question'                    => 'string',
            'instructions'                => 'string',
            'file'                        => 'string',
            'pages'                       => 'string',
            'format'                      => 'string',
            'duration'                    => 'string',
            'pricing'                     => 'float',
            'order_ip_address'            => 'string',
            'admin_ip_address'            => 'string',
            'updated_ip_address'          => 'string',
            'deleted_ip_address'          => 'string',
            'status'                      => 'string',
            'user_id'                     => 'string',

    ];

    /**
 * A order has a user.
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function order()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

}
