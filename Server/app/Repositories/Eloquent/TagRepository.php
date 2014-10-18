<?php namespace SpreadOut\Repositories\Eloquent;

use SpreadOut\Repositories\TagContract;
use SpreadOut\Tag;

class TagRepository extends AbstractRepository implements TagContract {

    /**
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    /**
     * Create tags
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $tag = $this->getNew();
        $tag->name = $data['name'];
        $tag->save();
    }
}