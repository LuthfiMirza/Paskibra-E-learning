<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    public $timestamps = false;

    public static function getMany(array $keys, array $defaults = [])
    {
        $items = static::whereIn('key', $keys)->pluck('value', 'key')->toArray();
        return array_merge($defaults, $items);
    }

    public static function setMany(array $data)
    {
        foreach ($data as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}

