<?php

namespace App\Traits\Comment;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Comment;
use App\Models\User;

trait HasComments
{

    /**
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @param string $comment
     * @param bool $confirmed
     * @return Comment
     */
    public function comment(string $comment, bool $confirmed = false): Comment
    {
        /**
         * @var User $user
         */
        $user = \auth()->user();
        return $this->commentAsUser($user, $comment, $confirmed);
    }

    /**
     * @param User $user
     * @param string $markdown
     * @param bool $confirmed
     * @return Comment
     */
    public function commentAsUser(User $user, string $markdown, bool $confirmed = false): Comment
    {
        return Comment::create([
            'user_id' => $user->getKey(),
            'commentable_id' => $this->getKey(),
            'commentable_type' => static::class,
            'markdown' => $markdown,
            'confirmed' => $confirmed,
        ]);
    }

}
