<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;

use App\Http\Requests\UserWorkExperience\StoreRequest;

use App\Repositories\UserWorkExperiencieRepository;
use Illuminate\Support\Facades\DB;

class UserWorkExperienceController extends Controller
{
    /** @var UserWorkExperiencieRepository */
    protected $userWorkExperiencieRepository;

    public function __construct(UserWorkExperiencieRepository $userWorkExperiencieRepository)
    {
        $this->userWorkExperiencieRepository = $userWorkExperiencieRepository;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            if ($request->isJson()) {
                return response()->json($request->all());
            }
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/UserWorkExperienceController:Store/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/UserWorkExperienceController:Store/Exception: {$e->getMessage()}");
        }
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
