<?php namespace Modules\Phone\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\ActivityLog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use LogsActivity;
    use SoftDeletes;

    public $table = 'phone_list';

    public $fillable = [
        "title",
        "description",
        "phone_number",
        "status",
        "find_counts",
        "added_by",
        "updated_by"
    ];

    protected static $logAttributes = [
        "title",
        "description",
        "phone_number",
        "status",
        "find_counts",
        "added_by",
        "updated_by"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var  array
     */
    protected $casts = [
        'title'        => 'string',
        'description'  => 'string',
        'phone_number' => 'string',
        'status'       => 'integer',
        'find_counts'  => 'integer',
        'added_by'     => 'integer',
        'updated_by'   => 'integer',
    ];
    protected $dates = ['deleted_at'];

    /**
     * Validation rules
     *
     * @var  array
     */
    public static $rules = [
        'title'        => 'required',
        'description'  => '',
        'phone_number' => 'required',
        'status'       => '',
        'find_counts'  => '',
        'added_by'     => '',
        'updated_by'   => '',
    ];

    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo('Modules\User\Models\User', 'added_by', 'id');
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user_1()
    {
        return $this->belongsTo('Modules\User\Models\User', 'updated_by', 'id');
    }
}
