<?php


namespace App\Business;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthManager
{
    protected $userRepository;
    protected $deviceManager;

    public function __construct(UserRepository $userRepository,DeviceManager $deviceManager)
    {
        $this->userRepository = $userRepository;
        $this->deviceManager = $deviceManager;
    }

    public function register(array $data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ];

        $deviceData = [
            'uid' => $data['uid'],
            'app_id' => $data['app_id'],
            'language' => $data['language'],
            'operation_system' => $data['operation_system']
        ];

        if (!$user = $this->userRepository->get($userData)->first()){
            $user = $this->userRepository->create($userData);
        }

        $deviceData['user_id'] = $user->id;

        $device = $this->deviceManager->create($deviceData);

        return auth()->login($user);
    }

    public function login(array $credentials)
    {
        if (! $token = auth()->attempt($credentials)) {
            throw new CustomException(__('The provided credentials are incorrect.'), 401);
        }

        return $token;
    }
}
