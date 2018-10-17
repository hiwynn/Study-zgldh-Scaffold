<?php namespace Modules\Phone\Controllers;

use Modules\Phone\Requests\CreatePhoneRequest;
use Modules\Phone\Requests\UpdatePhoneRequest;
use Modules\Phone\Repositories\PhoneRepository;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\ShowRequest;
use Illuminate\Http\JsonResponse;
use App\Scaffold\AppBaseController;

class PhoneController extends AppBaseController
{

    public function __construct(PhoneRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware("auth:api");
        $this->middleware("permission.auto");
    }

    /**
     * Display a listing of the Phone.
     *
     * @param  IndexRequest $request
     * @return  Response
     */
    public function index(IndexRequest $request)
    {
        $with = $request->getWith();
        $data = $this->repository->datatables(null, $with);

        return $data;
    }

    /**
     * Store a newly created Phone in storage.
     *
     * @param  CreatePhoneRequest $request
     * @return  JsonResponse
     */
    public function store(CreatePhoneRequest $request)
    {
        $input = $request->all();

        $item = $this->repository->create($input);
        $item->load($request->getWith());

        return $this->sendResponse($item, 'Phone saved successfully.');
    }

    /**
     * Display the specified Phone.
     *
     * @param    int $id
     *
     * @return  JsonResponse
     */
    public function show($id, ShowRequest $request)
    {
        $item = $this->repository->findWithoutFail($id);
        $item->load($request->getWith());

        if (empty($item)) {
            return $this->sendError('Phone not found');
        }

        return $this->sendResponse($item, '');
    }

    /**
     * Update the specified Phone in storage.
     *
     * @param    int $id
     * @param  UpdatePhoneRequest $request
     *
     * @return  JsonResponse
     */
    public function update($id, UpdatePhoneRequest $request)
    {
        $item = $this->repository->findWithoutFail($id);

        if (empty($item)) {
            return $this->sendError('Phone not found');
        }

        $item = $this->repository->update($request->all(), $id);
        $item->load($request->getWith());

        return $this->sendResponse($item, 'Phone updated successfully.');
    }

    /**
     * Remove the specified Phone from storage.
     *
     * @param    int $id
     *
     * @return  JsonResponse
     */
    public function destroy($id)
    {
        $item = $this->repository->findWithoutFail($id);

        if (empty($item)) {
            return $this->sendError('Phone not found');
        }

        $this->repository->delete($id);

        return $this->sendResponse($item, 'Phone deleted successfully.');
    }
}
