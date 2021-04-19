<?php


namespace App\Repositories;


use App\Models\Device;

class DeviceRepository
{
    protected $model;

    public function __construct(Device $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function get(array $data = [])
    {
        $query = $this->model;
        if (isset($data['user_id'])) {
            $query = $query->where('user_id',$data['user_id']);
        }

        if (isset($data['uid'])) {
            $query = $query->where('uid',$data['uid']);
        }

        if (isset($data['app_id'])) {
            $query = $query->where('app_id',$data['app_id']);
        }

        if (isset($data['language'])) {
            $query = $query->where('language',$data['language']);
        }

        if (isset($data['operation_system'])) {
            $query = $query->where('operation_system',$data['operation_system']);
        }

        return $query->get();
    }
}
