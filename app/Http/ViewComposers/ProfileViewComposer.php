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
        $companies = $this->companyRepository->all()->pluck('name', 'id')->prepend('---Seleccione una ');

        $view->with(compact('companies'));
    }
    
}
