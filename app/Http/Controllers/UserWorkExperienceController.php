<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;

use App\Http\Requests\UserWorkExperience\StoreRequest;
use App\Repositories\UserRepository;
use App\Repositories\UserWorkExperiencieRepository;
use App\Services\ModelServices\UserModelService;
use Illuminate\Support\Facades\DB;

class UserWorkExperienceController extends Controller
{
    /** @var UserModelService */
    protected $userModelService;

    /** @var UserRepository */
    protected $userRepository;

    /** @var UserWorkExperiencieRepository */
    protected $userWorkExperiencieRepository;

    public function __construct(
        UserModelService $userModelService,
        UserRepository $userRepository,
        UserWorkExperiencieRepository $userWorkExperiencieRepository
    ) {
        $this->userModelService = $userModelService;
        $this->userRepository = $userRepository;
        $this->userWorkExperiencieRepository = $userWorkExperiencieRepository;

        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workExperiences = [];
        try {
            $workExperiences = $this->userWorkExperiencieRepository->search(['user_id' => current_user()->id], ['company'])->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'company' => $item->company->name,
                    'job_title' => $item->job_title,
                    'start_date' => $item->start_date,
                    'end_date' => $item->end_date,
                    'diff' => diffBetweenTwoDates($item->start_date, $item->end_date),
                    'routes' => [
                        'show' => route('profile.work-experiences.show', $item->id),
                        'delete' => route('profile.work-experiences.destroy', $item->id)
                    ]
                ];
            });
        } catch (Exception $e) {
            Log::error("@Web/Controllers/UserWorkExperienceController:Index/Exception: {$e->getMessage()}");
        }
        return response()->json($workExperiences);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $userWorkExperience)
    {
        $userWorkExperience = $this->userWorkExperiencieRepository->search(['id' => $userWorkExperience])->first();

        return response()->json($userWorkExperience);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $response = ['title' => __('Models/UserWorkExperience.save-error'), 'icon' => 'error'];
        try {
            DB::beginTransaction();

            $this->userModelService->attachWorkExperience(current_user(), $request->get('company_id'), $request->only(['job_title', 'start_date', 'end_date']));
            DB::commit();
            $response = ['title' => __('Models/UserWorkExperience.save-success'), 'icon' => 'success'];
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error("@Web/Controllers/UserWorkExperienceController:Store/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/UserWorkExperienceController:Store/Exception: {$e->getMessage()}");
        }

        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
