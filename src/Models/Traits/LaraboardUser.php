<?php
namespace Christhompsontldr\Laraboard\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait LaraboardUser
{
    public function forumThreadSubscriptions()
    {
        return $this->hasMany('Christhompsontldr\Laraboard\Models\Subscription');
    }

    public function forumSubscriptionAlerts()
    {
        return $this->hasMany('Christhompsontldr\Laraboard\Models\Alert')->active();
    }

    public function forumThreads()
    {
        return $this->hasMany('Christhompsontldr\Laraboard\Models\Thread');
    }

    public function forumReplies()
    {
        return $this->hasMany('Christhompsontldr\Laraboard\Models\Reply');
    }

    //  includes threads and reply
    public function forumPosts()
    {
        return $this->hasMany('Christhompsontldr\Laraboard\Models\Post')->whereIn('type', ['Reply', 'Thread']);
    }

    public function getDisplayNameAttribute()
    {
        $display_name = config('laraboard.user.display_name');
        return $this->{$display_name};
    }

    public function getSlugAttribute()
    {
        $slug = config('laraboard.user.slug');
        return $this->{$slug};
    }

    public function getPostCountAttribute()
    {
        return number_format($this->forumPosts->count());
    }
}