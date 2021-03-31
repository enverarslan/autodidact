<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';

    protected $fillable = ['author_id', 'title', 'link', 'body', 'last_comment_at'];

    public $timestamps = true;

    public $dates = [
        'last_comment_at'
    ];

    protected $casts = [
        'author_id' => 'int',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'topic_id', 'id');
    }

    public function latest_comment()
    {
        return $this->hasOne(Comment::class, 'topic_id', 'id')->orderBy('created_at', 'desc');
    }

    public static function booted()
    {
        static::creating(function(Topic $topic){
            $topic->identifier = self::randomID();
            $topic->slug = Str::slug($topic->title, '-', 'tr');
            $topic->author_id = Auth::guard('web')->user()->id;
            $topic->last_comment_at = Carbon::now();
        });
    }

    private static function randomID(){
        $random = substr(bin2hex(random_bytes(64)), 0, 8);
        if(self::where('identifier', $random)->count()){
            return self::randomID();
        }
        return $random;
    }

    public function getHostAttribute()
    {
        return (!empty($this->link)) ? parse_url($this->link)['host'] : null;
    }

    public function getTopicSelfUrlAttribute()
    {
        return route('topics.show', ['pid'=>$this->identifier, 'slug'=>$this->slug]);
    }

    /**
     * Find latest comment and update topic updated_at timestamp.
     * Usage: When deleted comment.
     * @param $topic_id
     * @param $comment_date
     */
    public static function updateLatestCommentTimestamp($topic_id, $comment_date)
    {
        $topic = self::with('latest_comment')->find($topic_id);
        if ($topic){
            $topic->timestamps = false;
            if ($topic->latest_comment){
                if (($topic->latest_comment->updated_at < $comment_date)){
                    $topic->last_comment_at = $topic->latest_comment->updated_at;
                }
            }else{
                $topic->last_comment_at = $topic->updated_at;
            }
            $topic->save();
        }
    }

    public static function getLatestTopicList($page=1)
    {
        $key = "latest_topics_$page";
        $topics = null;
        if (Cache::has($key)){
            $topics = Cache::get($key);
            return $topics;
        }else{
            $topics = Topic::select(['title', 'link', 'slug', 'identifier'])
                ->withCount('comments')
                //->where('last_comment_at', '>=', Carbon::now()->subHours(2))
                ->orderBy('comments_count', 'desc')
                ->orderBy('last_comment_at', 'desc')
                ->paginate(10, ['*'], 'p', intval($page));

            $topics->withPath('/i/topics');//->setPageName('p');

            //Cache::put($key, $topics, 60);
        }


        return $topics;
    }
}
