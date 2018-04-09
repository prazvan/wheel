<?php

use App\Services\ItemSystemService;
use App\Services\WheelService;

/**
 * Class BonusesController
 *
 * Let's say this is the controller
 *
 */
class BonusesController extends Controller
{
    /**
     * @var \App\Services\WheelService
     */
    private $wheelService;

    /**
     * @var \ItemSystemService
     */
    private $itemSystemService;

    /**
     * BonusesController constructor.
     *
     * @param \App\Services\WheelService      $wheelService
     * @param \App\Services\ItemSystemService $itemSystemService
     */
    public function __construct(WheelService $wheelService, ItemSystemService $itemSystemService)
    {
        // Dependency injection
        $this->wheelService = $wheelService;
        $this->itemSystemService = $itemSystemService;
    }

    /**
     * Spin User Wheel
     *
     * When it come to the validation here I would Ether do a middleware to validate the input or
     * Create a validation class where you validate the wheel id or any other input data
     * But for the sake's of the example, i'll do both
     *
     * With a middleware in place the validation will be in the request middleware which will be called before the request hits the controller
     *
     * The second method would be with a Validator class as seen below
     *
     * I've also
     *
     * @param int $wheelId
     */
    public function spinAction($wheelId)
    {
        try
        {
            // so we can do the validation like so where we actually check if the wheel exists and so on.
            $validator = Validator::make(['wheel_id' => $wheelId], [
                'wheel_id' => 'required',
            ]);

            // if the validation will fail we can throw an invalid argument exception for example
            if ($validator->fails()) {
                throw new InvalidArgumentException($validator->errors(), $validator->code());
            }

            // throw an exception if something happens
            $this->wheelService->rewardWheelToUserByWheelId($wheelId);

            // all good :)
            $result = [
                'success' => true,
            ];
        }
        catch (\Exception $ex)
        {
            // error
            $result = [
                'success' => false,
                'errors'  => [$ex->getCode() => $ex->getMessage()] // can be like so or do a error handling class
            ];
        }


        // return result being ether success or not
        return $this->json((array) $result);
    }

    /**
     * I assume that the user has the possibility to select from the UI what he can exchange with what
     * And we do an api call for that
     * Let's say that we have a Endpoint that will return all exchange possibilities
     * And he chooses to exchange a bonus that he has with a different one like in the description
     *
     *
     * @param int $from_id
     * @param int $to_id
     */
    public function exchange($from_id, $to_id)
    {
        try
        {
            // so we can do the validation like so where we actually check if the wheel exists and so on.
            $validator = Validator::make([
                'from_id' => $from_id,
                'to_id' => $to_id
            ], [
                'from_id' => 'required|int', // validation rules
                'to_id' => 'required|int', // validation rules
            ]);

            // if the validation will fail we can throw an invalid argument exception for example
            if ($validator->fails()) {
                throw new InvalidArgumentException($validator->errors(), $validator->code());
            }

            // throw an exception if something happens
            $this->ItemSystemService->exchange($from_id, $to_id);

            // all good :)
            $result = [
                'success' => true,
            ];
        }
        catch (\Exception $ex)
        {
            // error
            $result = [
                'success' => false,
                'errors'  => [$ex->getCode() => $ex->getMessage()] // can be like so or do a error handling class
            ];
        }


        // return result being ether success or not
        return $this->json((array) $result);
    }

}