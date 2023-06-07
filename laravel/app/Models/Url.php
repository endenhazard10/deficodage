<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    protected $fillable=['url','shortened','url_final'];

    public static function getUniqueShortUrl(){
        $shortened=Str::random(5);
        if(static::whereShortened($shortened)->count()!=0){
            return static::getUniqueShortUrl();
        }
        return $shortened;
    }
}
