<?php

namespace App\Services;
use App\Repositories\DB\UserRepository;

/**
 * Class ItemSystemService
 * @package App\Services
 */
class ItemSystemService
{
    /**
     * @var \App\Repositories\DB\UserRepository
     */
    private $userRepository;
    /**
     * @var \App\Services\BonusRepository
     */
    private $bonusRepository;

    /**
     * ItemSystemService constructor.
     *
     * @param \App\Repositories\DB\UserRepository $userRepository
     * @param \App\Services\BonusRepository       $bonusRepository
     */
    public function __construct(UserRepository $userRepository, BonusRepository $bonusRepository)
    {
        $this->userRepository = $userRepository;
        $this->bonusRepository = $bonusRepository;
    }

    /**
     * @param $from_id
     * @param $to_id
     *
     * @throws \Exception
     */
    public function exchange($from_id, $to_id)
    {
        try
        {
            // get current user
            $user = getUser();

            // get bonuses let's assume there objects
            $from_bonus = $this->userRepository->getUserBonusById($from_id);
            $to_bonus = $this->bonusRepository->getBonusById($to_id);

            // user dosen't have the bonus
            // ether way this validation can be done here or in the controller or even as a middle ware again
            // yeah i love them. since it's simple to implement in layers
            // in the sanse that if you are already where in the service, repo or model you don't care about the validation of the input
            // since it's done a layer above :)
            if (!$from_bonus or !$to_bonus) throw new BonusNotFoundException;

            /**
             * Basically i would just keep it simple
             * Just have the exchange bonuses as entries in the db and just delete the old one and insert the new
             * When getting the "to bonuses" in the UI just do a select ... from bonuses where bonus_type = upgrade or whatever
             *
             */
            $this->userRepository->deleteUserBonusByid($from_bonus->id);
            $this->userRepository->insertUserBonus($to_bonus);
        }
        catch (\Exception $ex)
        {
            throw $ex;
        }
    }

}