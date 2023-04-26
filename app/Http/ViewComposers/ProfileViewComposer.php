<?php

namespace App\Http\ViewComposers;

use App\Repositories\CompanyRepository;
use Illuminate\View\View;

class ProfileViewComposer
{
    /** @var CompanyRepository */
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function compose(View $view)
    {
        $userWorkExperiencies = current_user()->work_experiencies;

        $companies = $this->companyRepository->all()->pluck('name', 'id')->prepend('---Seleccione una ', -1);

        $view->with(compact('companies', 'userWorkExperiencies'));
    }
}
