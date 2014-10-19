<?php namespace SpreadOut\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
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
     * @return mixed
     */
    public function create(array $data)
    {
        $tag = $this->getNew();
        $tag->name = $data['name'];
        $tag->save();

        return $this->toArray($tag);
    }

    /**
     * Get all the tags
     *
     * @return \Illuminate\Database\Eloquent\Collection|mixed|static[]
     */
    public function all()
    {
        return $this->toArray($this->model->all());
    }

    /**
     * Get branches by name
     *
     * @todo: Refactor the method
     *
     * @param array $data
     * @return bool|mixed
     */
    public function search(array $data)
    {
        $find = $this->model->with(array('branches' => function ($query) use ($data)
        {
            if (isset($data['city']))
            {
                $query->where('city_id', $data['city']);
            }
        }));

        if (isset($data['id']))
        {
            $find = $find->where('id', $data['id']);
        }

        if (isset($data['name']))
        {
            $find = $find->where('name', 'LIKE', '%'.$data['name'].'%');
        }

        return $this->toArray($find->get());
    }
}