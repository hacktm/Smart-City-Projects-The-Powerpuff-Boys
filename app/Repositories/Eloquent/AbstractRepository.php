<?php namespace SpreadOut\Repositories\Eloquent;

class AbstractRepository {

    public function __construct()
    {

    }

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