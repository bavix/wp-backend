<?php

namespace App\Http\Api;

use App\Http\Resources\CommentResource;
use App\Http\Resources\Comments;
use App\Traits\Comment\HasComments;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\QueryBuilder\QueryBuilder;

abstract class Commentable extends Controller
{

    /**
     * @param FormRequest $request
     * @param int $id
     * @return Comments
     */
    public function comments(FormRequest $request, int $id): Comments
    {
        return new Comments($this->commentResource($id)->paginate());
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return CommentResource
     */
    public function storeComment(FormRequest $request, int $id): CommentResource
    {
        /**
         * @var HasComments $model
         */
        $model = $this->simpleQuery()->findOrFail($id);

        return new CommentResource(
            $model->comment($request->input('markdown'))
        );
    }

    /**
     * @param int $id
     * @return QueryBuilder
     */
    protected function commentResource(int $id): QueryBuilder
    {
        /**
         * @var HasComments $model
         */
        $model = $this->simpleQuery()->findOrFail($id);

        return QueryBuilder::for($model->comments())
            ->defaultSort('-id')
            ->allowedIncludes('user')
            ->allowedSorts('id');
    }

    /**
     * @return Builder
     */
    abstract protected function simpleQuery(): Builder;

}
