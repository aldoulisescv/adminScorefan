<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccessoryAPIRequest;
use App\Http\Requests\API\UpdateAccessoryAPIRequest;
use App\Models\Accessory;
use App\Repositories\AccessoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AccessoryController
 * @package App\Http\Controllers\API
 */

class AccessoryAPIController extends AppBaseController
{
    /** @var  AccessoryRepository */
    private $accessoryRepository;

    public function __construct(AccessoryRepository $accessoryRepo)
    {
        $this->accessoryRepository = $accessoryRepo;
    }

    /**
     * Display a listing of the Accessory.
     * GET|HEAD /accessories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $accessories = $this->accessoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $accessories->toArray(),
            __('messages.retrieved', ['model' => __('models/accessories.plural')])
        );
    }

    /**
     * Store a newly created Accessory in storage.
     * POST /accessories
     *
     * @param CreateAccessoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAccessoryAPIRequest $request)
    {
        $input = $request->all();

        $accessory = $this->accessoryRepository->create($input);

        return $this->sendResponse(
            $accessory->toArray(),
            __('messages.saved', ['model' => __('models/accessories.singular')])
        );
    }

    /**
     * Display the specified Accessory.
     * GET|HEAD /accessories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Accessory $accessory */
        $accessory = $this->accessoryRepository->find($id);

        if (empty($accessory)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/accessories.singular')])
            );
        }

        return $this->sendResponse(
            $accessory->toArray(),
            __('messages.retrieved', ['model' => __('models/accessories.singular')])
        );
    }

    /**
     * Update the specified Accessory in storage.
     * PUT/PATCH /accessories/{id}
     *
     * @param int $id
     * @param UpdateAccessoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccessoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Accessory $accessory */
        $accessory = $this->accessoryRepository->find($id);

        if (empty($accessory)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/accessories.singular')])
            );
        }

        $accessory = $this->accessoryRepository->update($input, $id);

        return $this->sendResponse(
            $accessory->toArray(),
            __('messages.updated', ['model' => __('models/accessories.singular')])
        );
    }

    /**
     * Remove the specified Accessory from storage.
     * DELETE /accessories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Accessory $accessory */
        $accessory = $this->accessoryRepository->find($id);

        if (empty($accessory)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/accessories.singular')])
            );
        }

        $accessory->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/accessories.singular')])
        );
    }
}
