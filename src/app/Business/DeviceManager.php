<?php


namespace App\Business;


use App\Repositories\DeviceRepository;

class DeviceManager
{
    protected $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function create(array $data)
    {
        if (!$device = $this->deviceRepository->get($data)->first()) {
            $device = $this->deviceRepository->create($data);
        }

        return $device;
    }
}
