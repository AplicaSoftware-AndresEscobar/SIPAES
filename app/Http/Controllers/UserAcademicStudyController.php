<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAcademicStudy\StoreRequest;
use App\Http\Requests\UserAcademicStudy\UpdateRequest;
use App\Repositories\UserAcademicStudyRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserAcademicStudyController extends Controller
{
    /** @var UserAcademicStudyRepository */
    protected $userAcademicStudyRepository;

    public function __construct(
        UserAcademicStudyRepository $userAcademicStudyRepository
    ) {
        $this->userAcademicStudyRepository = $userAcademicStudyRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param ClientRequest $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $workExperiences = [];

        $params = $request->all();
        $params['user_id'] = current_user()->id;
        try {
            $workExperiences = $this->userAcademicStudyRepository->search($params, ['educational_institute', 'academic_study_level'])->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'educational_institute' => $item->educational_institute->name,
                    'academic_study_level' => $item->academic_study_level->name,
                    'degree' => $item->degree,
                    'year' => $item->year,
                    'routes' => [
                        'show' => route('profile.academic-studies.show', $item->id),
                        'update' => route('profile.academic-studies.update', $item->id),
                        'delete' => route('profile.academic-studies.destroy', $item->id)
                    ]
                ];
            });
        } catch (Exception $e) {
            Log::error("@Web/Controllers/UserAcademicStudyController:Index/Exception: {$e->getMessage()}");
        }
        return response()->json($workExperiences);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $response = ['title' => __('models.user_academic_studies.messages.save-error'), 'icon' => 'error'];
        try {
            $data = $request->all();
            $data['user_id'] = current_user()->id;
            DB::beginTransaction();
            $this->userAcademicStudyRepository->create($data);
            DB::commit();
            $response = ['title' => __('models.user_academic_studies.messages.save-success'), 'icon' => 'success'];
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error("@Web/Controllers/UserAcademicStudyController:Store/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/UserAcademicStudyController:Store/Exception: {$e->getMessage()}");
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     */
    public function show($id)
    {
        $academicStudy = [];
        try {
            $academicStudy = $this->userAcademicStudyRepository->search(['id' => $id])->first();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/UserAcademicStudyController:Show/Exception: {$e->getMessage()}");
        }
        return response()->json($academicStudy);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $response = ['title' => __('models.user_academic_studies.messages.update-error'), 'icon' => 'error'];
        try {
            $data = $request->all();
            $data['user_id'] = current_user()->id;

            $academicStudy = $this->userAcademicStudyRepository->getById($id);
            DB::beginTransaction();
            $this->userAcademicStudyRepository->update($academicStudy, $data);
            DB::commit();
            $response = ['title' => __('models.user_academic_studies.messages.update-success'), 'icon' => 'success'];
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error("@Web/Controllers/UserAcademicStudyController:Update/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/UserAcademicStudyController:Update/Exception: {$e->getMessage()}");
        }
        return response()->json($response);
    }


   /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     */
    public function destroy($id)
    {
        $response = ['title' => __('models.user_academic_studies.messages.delete-error'), 'icon' => 'error'];
        try {
            DB::beginTransaction();
            $academicStudy = $this->userAcademicStudyRepository->getById($id);
            $this->userAcademicStudyRepository->delete($academicStudy);
            DB::commit();
            $response = ['title' => __('models.user_academic_studies.messages.delete-success'), 'icon' => 'success'];
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error("@Web/Controllers/UserAcademicStudyController:Destroy/QueryException: {$qe->getMessage()}");
        }
        return response()->json($response);
    }
}
