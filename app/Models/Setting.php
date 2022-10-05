<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    const KEY = '_key';
    const VALUE = 'value';
    public $incrementing = false;
    protected $table = "settings";
    protected $primaryKey = self::KEY;
    public $timestamps = false;
    protected $fillable = [
        self::KEY,
        self::VALUE,
    ];
    protected $casts = [
        self::KEY => 'string',
    ];


}
