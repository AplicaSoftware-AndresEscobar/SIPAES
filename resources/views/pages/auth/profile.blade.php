@extends('layout.app')

@section('title', __('title.profile'))

@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('assets/adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ current_user_information()->fullname }}</h3>

                        <p class="text-muted text-center">{{ current_user()->roles->first()->title }}</p>

                        <a href="#" class="btn btn-primary btn-block"><b>@lang('button.edit-profile')</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang('title.title-user-information')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-user mr-1"></i>@lang('field.name')</strong>

                        <p class="text-muted">{{ current_user_information()->fullname }}</p>

                        <hr>

                        <strong><i class="fas fa-at mr-1"></i>@lang('field.email_fesc')</strong>

                        <p class="text-muted">{!! getModelAttribute(current_user_information(), 'email_fesc') !!}</p>

                        <hr>

                        <strong><i class="fas fa-at mr-1"></i>@lang('field.email')</strong>

                        <p class="text-muted">{{ current_user()->email }}</p>

                        <hr>

                        <strong><i class="fas fa-id-card mr-1"></i>@lang('field.document_type')</strong>

                        <p class="text-muted">{{ current_user_information()->document_type->name }}</p>

                        <hr>

                        <strong><i class="far fa-id-card mr-1"></i>@lang('field.document')</strong>

                        <p class="text-muted">{{ current_user_information()->document }}</p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i>@lang('field.birthdate')</strong>

                        <p class="text-muted">{{ current_user_information()->birthdate->format('d/m/Y') }}</p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i>@lang('field.birthday_place')</strong>

                        <p class="text-muted">{{ current_user_information()->birthday_place->getLocation() }}</p>

                        <hr>

                        <strong><i class="far fa-id-card mr-1"></i>@lang('field.address')</strong>

                        <p class="text-muted">{!! getModelAttribute(current_user_information(), 'address') !!}</p>

                        <hr>

                        <strong><i class="fas fa-mobile mr-1"></i>@lang('field.phone')</strong>

                        <p class="text-muted">{!! getModelAttribute(current_user_information(), 'phone') !!}</p>

                        <hr>

                        <strong><i class="fas fa-phone mr-1"></i>@lang('field.telephone')</strong>

                        <p class="text-muted">{!! getModelAttribute(current_user_information(), 'telephone') !!}</p>

                        <hr>

                        <strong><i class="fas fa-venus-mars mr-1"></i>@lang('field.gender')</strong>

                        <p class="text-muted">{{ current_user_information()->gender->name }}</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./About Me Box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#user-work-experiencie"
                                    data-toggle="tab">@lang('title.title-user-work-experiencie')</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#user-academic-study"
                                    data-toggle="tab">@lang('title.title-user-academic-study')</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings"
                                    data-toggle="tab">@lang('title.settings')</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="user-work-experiencie">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered">
                                        <thead>
                                            <th>@lang('field.company')</th>
                                            <th>@lang('field.job-title')</th>
                                            <th>@lang('field.start_date')</th>
                                            <th>@lang('field.end_date')</th>
                                            <th>@lang('field.duration')</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @forelse (current_user()->work_experiencies as $item)
                                                <tr>
                                                    <td>{!! $item->name !!}</td>
                                                    <td>{!! $item->pivot->job_title !!}</td>
                                                    <td>{!! $item->pivot->start_date !!}</td>
                                                    <td>{!! $item->pivot->end_date !!}</td>
                                                    <td>{!! diffBetweenTwoDates($item->pivot->start_date, $item->pivot->end_date) !!}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <form action="" id="form-delete-{{ $item->id }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-xs btn-danger"
                                                                    onclick="destroy(event, {{ $item->id }})">
                                                                    <i class="fas fa-sm fa-sm fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                                <a href="" class="btn btn-primary btn-sm btn-outline">Agregar</a>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="user-academic-study">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered">
                                        <thead>
                                            <th>@lang('field.educational_institute')</th>
                                            <th>@lang('field.academic_study_level')</th>
                                            <th>@lang('field.name')</th>
                                            <th>@lang('field.year')</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @forelse (current_user()->academic_studies as $item)
                                                <tr>
                                                    <td>{!! $item->name !!}</td>
                                                    <td>{!! $item->pivot->academic_study_level->name !!}</td>
                                                    <td>{!! $item->pivot->name !!}</td>
                                                    <td>{!! $item->pivot->year !!}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <form action="" id="form-delete-{{ $item->id }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-xs btn-danger"
                                                                    onclick="destroy(event, {{ $item->id }})">
                                                                    <i class="fas fa-sm fa-sm fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName2"
                                                placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputSkills"
                                                placeholder="Skills">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> I agree to the <a href="#">terms and
                                                        conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
