<?php

namespace Christhompsontldr\Laraboard\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $table = 'forum_alerts';

    protected $fillable = ['user_id', 'post_id'];

    protected $dates = ['created_at', 'updated_at', 'read_at'];

    /**
     * Get the leagues for this game.
     */
    public function user()
    {
        return $this->belongsTo(config('auth.providers.user.model', 'App\User'));
    }

    public function thread()
    {
        return $this->belongsTo('Christhompsontldr\Laraboard\Models\Thread', 'post_id', 'id');
    }

    public function scopeActive($query)
    {
        $query->whereNull('read_at');
    }
}