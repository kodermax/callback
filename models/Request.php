<?php namespace Kodermax\CallBack\Models;

use Model;

/**
 * Request Model
 */
class Request extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kodermax_callback_requests';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public static function add($data)
    {
        $entry = new static;
        $entry->phone = array_get($data, 'phone');
        $entry->save();
        return $entry;
    }

}