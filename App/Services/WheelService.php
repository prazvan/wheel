<?php

namespace App\Services;


use App\Repositories\DB\WheelRepository;
use App\Services\Validator\Validator;

class WheelService
{

    /**
     * @var \App\Services\Validator\Validator
     */
    private $validator;

    /**
     * @var \App\Repositories\DB\WheelRepository
     */
    private $wheelRepository;

    /**
     * WheelService constructor.
     *
     * @param \App\Services\Validator\Validator $validator
     */
    public function __construct(Validator $validator, WheelRepository $wheelRepository)
    {
        $this->validator = $validator;

        $this->wheelRepository = $wheelRepository;
    }

    public function rewardWheelToUserByWheelId($id)
    {
        try
        {
            // get current user
            $user = getUser();

            $wheel = $this->wheelRepository->getById($id);

            // validate that the user has the wheel
            $this->validator->validateUserWheel($user,  $wheel);

            // where we reward the user
            $this->wheelRepository->rewardUser($id);
        }
        catch (\Exception $ex)
        {
            throw $ex;
        }
    }
}