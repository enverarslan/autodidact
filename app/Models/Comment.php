<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = ['topic_id', 'author_id', 'body'];

    public $timestamps = true;

    protected $casts = [
        'author_id' => 'int',
        'topic_id' => 'int',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public static function booted()
    {
        static::creating(function(Model $model){
            $model->identifier = self::randomID();
            $model->author_id = Auth::guard('web')->user()->id;

            Cache::forget("latest_topics");
        });
    }

    private static function randomID(){
        $random = substr(bin2hex(random_bytes(64)), 0, 8);
        if(self::where('identifier', $random)->count()){
            return self::randomID();
        }
        return $random;
    }
}
