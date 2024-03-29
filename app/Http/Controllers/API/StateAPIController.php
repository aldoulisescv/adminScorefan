<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStateAPIRequest;
use App\Http\Requests\API\UpdateStateAPIRequest;
use App\Models\State;
use App\Repositories\StateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class StateController
 * @package App\Http\Controllers\API
 */

class StateAPIController extends AppBaseController
{
    /** @var  StateRepository */
    private $stateRepository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->stateRepository = $stateRepo;
    }

    /**
     * Display a listing of the State.
     * GET|HEAD /states
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $states = $this->stateRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $states->toArray(),
            __('messages.retrieved', ['model' => __('models/states.plural')])
        );
    }

    /**
     * Store a newly created State in storage.
     * POST /states
     *
     * @param CreateStateAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStateAPIRequest $request)
    {
        $input = $request->all();

        $state = $this->stateRepository->create($input);

        return $this->sendResponse(
            $state->toArray(),
            __('messages.saved', ['model' => __('models/states.singular')])
        );
    }

    /**
     * Display the specified State.
     * GET|HEAD /states/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var State $state */
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/states.singular')])
            );
        }

        return $this->sendResponse(
            $state->toArray(),
            __('messages.retrieved', ['model' => __('models/states.singular')])
        );
    }

    /**
     * Update the specified State in storage.
     * PUT/PATCH /states/{id}
     *
     * @param int $id
     * @param UpdateStateAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStateAPIRequest $request)
    {
        $input = $request->all();

        /** @var State $state */
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/states.singular')])
            );
        }

        $state = $this->stateRepository->update($input, $id);

        return $this->sendResponse(
            $state->toArray(),
            __('messages.updated', ['model' => __('models/states.singular')])
        );
    }

    /**
     * Remove the specified State from storage.
     * DELETE /states/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var State $state */
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/states.singular')])
            );
        }

        $state->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/states.singular')])
        );
    }
}
