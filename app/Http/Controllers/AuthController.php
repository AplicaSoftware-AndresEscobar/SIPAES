<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Repositories\UserInformationRepository;
use Illuminate\Http\Request;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /** @var UserRepository */
    protected $userRepository;

    /** @var UserInformationRepository */
    protected $userInformationRepository;

    public function __construct(
        UserRepository $userRepository,
        UserInformationRepository $userInformationRepository,
    ) {
        $this->userRepository = $userRepository;
        $this->userInformationRepository = $userInformationRepository;

        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
        $response = ['title' => __('models.user_information.messages.update-error'), 'icon' => 'error'];
        try {
            $data = $request->all();
            $data['user_id'] = current_user()->id;

            $userInformation = $this->userInformationRepository->getById(current_user()->id);
            DB::beginTransaction();
            $this->userInformationRepository->update($userInformation, $data);
            DB::commit();
            $response = ['title' => __('models.user_information.messages.update-success'), 'icon' => 'success'];
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error("@Web/Controllers/AuthController:Update/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/AuthController:Update/Exception: {$e->getMessage()}");
        }
        return response()->json($response);
    }
}
