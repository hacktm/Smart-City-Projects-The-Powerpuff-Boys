<?php namespace SpreadOut\Repositories\Eloquent;

class AbstractRepository {

    /**
     * @var
     */
    protected $model;

    /**
     * @param array $args
     */
    public function getNew(array $args = [])
    {
        return $this->model->newInstance($args);
    }

    /**
     * Transform the data
     *
     * @param $data
     * @return bool
     */
    public function toArray($data)
    {
        if (is_object($data))
        {
            return $data->toArray();
        }

        if ($data == null)
        {
            return false;
        }

        return $data;
    }
}