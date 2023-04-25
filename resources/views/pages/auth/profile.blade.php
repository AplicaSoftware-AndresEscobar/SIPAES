@extends('layout.app')

@section('title', __('title.profile'))

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

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
                                    <table class="table table-sm table-hover table-bordered"
                                        id="user-work-experiencie-table"
                                        data-route="{{ route('profile.work-experiences.index') }}">
                                        <thead>
                                            <th>@lang('field.company')</th>
                                            <th>@lang('field.job_title')</th>
                                            <th>@lang('field.start_date')</th>
                                            <th>@lang('field.end_date')</th>
                                            <th>@lang('field.duration')</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @forelse ($userWorkExperiencies as $item)
                                                <tr>
                                                    <td>{!! $item->name !!}</td>
                                                    <td>{!! $item->pivot->job_title !!}</td>
                                                    <td>{!! $item->pivot->start_date !!}</td>
                                                    <td>{!! $item->pivot->end_date !!}</td>
                                                    <td>{!! diffBetweenTwoDates($item->pivot->start_date, $item->pivot->end_date) !!}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="dropdown-toggle btn btn-sm btn-block btn-danger"
                                                                data-toggle="dropdown">
                                                                <span class="fas fa-cog"></span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button type="button"
                                                                    onclick="editWorkExperience(event, '{{ route('profile.work-experiences.show', $item->pivot->id) }}')"
                                                                    class="dropdown-item">
                                                                    <i class="fas fa-sm fa-sm fa-edit"></i>
                                                                    @lang('button.edit')
                                                                </button>
                                                                <form action=""
                                                                    id="form-work-experience-delete-{{ $item->id }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="destroy(event, {{ $item->pivot->id }}, 'form-work-experience-delete-')">
                                                                        <i class="fas fa-sm fa-sm fa-trash"></i>
                                                                        @lang('button.delete')
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="btn-group btn-group-sm">

                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-primary btn-sm btn-outline" data-toggle="modal"
                                    data-target="#create-work-experience-modal">@lang('button.add')</button>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="user-academic-study">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered">
                                        <thead>
                                            <th>@lang('field.educational_institute')</th>
                                            <th>@lang('field.academic_study_level')</th>
                                            <th>@lang('field.degree')</th>
                                            <th>@lang('field.year')</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @forelse (current_user()->academic_studies as $item)
                                                <tr>
                                                    <td>{!! $item->name !!}</td>
                                                    <td>{!! $item->pivot->academic_study_level->name !!}</td>
                                                    <td>{!! $item->pivot->degree !!}</td>
                                                    <td>{!! $item->pivot->year !!}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs btn-danger">
                                                                <i class="fas fa-sm fa-sm fa-edit"></i>
                                                            </button>
                                                            <form action="{{ route('home') }}"
                                                                id="form-academic-study-delete-{{ $item->id }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-xs btn-danger"
                                                                    onclick="destroy(event, {{ $item->id }}, 'form-academic-study-delete-')">
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
                                <div id="userSetting"></div>
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
    </div>

    <!-- Create User Work Experience Modal -->
    <div class="modal fade" id="create-work-experience-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">@lang('title.form.user-work-experience')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.work-experiences.store') }}" method="POST"
                        id="form-user-work-experience" data-table="user-work-experiencie-table">
                        @csrf

                        <div id="errors-work-experience"></div>

                        <!-- Company -->
                        <div class="form-group">
                            <label>@lang('field.company')</label>
                            <select name="company_id" id="company_id" class="custom-select form-control-sm select2bs4">
                                @forelse ($companies as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <!-- ./Company -->

                        <!-- Job Title -->
                        <div class="form-group">
                            <label>@lang('field.job_title')</label>
                            <input type="text" class="form-control form-control-sm" name="job_title" id="job_title">
                        </div>
                        <!-- ./Job Title -->

                        <!-- Start Date -->
                        <div class="form-group">
                            <label>@lang('field.start_date')</label>
                            <input type="date" class="form-control form-control-sm" name="start_date"
                                id="start_date">
                        </div>
                        <!-- ./Start Date -->

                        <!-- End Date -->
                        <div class="form-group">
                            <label>@lang('field.end_date')</label>
                            <input type="date" class="form-control form-control-sm" name="end_date", id="end_date">
                        </div>
                        <!-- ./End Date -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('button.close')</button>
                    <button type="button" class="btn btn-primary"
                        onclick="saveWorkExperience(event)">@lang('button.save')</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ./Create User Work Experience Modal -->
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('assets/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('custom-js')
    @include('partials.messages.delete_item');

    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>

    <!-- Create Form User Work Experience -->
    <script>
        function saveWorkExperience(e) {
            e.preventDefault();
            saveForm('#create-work-experience-modal', '#errors-work-experience', '#user-work-experiencie-table');
        }

        function editWorkExperience(e, route) {
            e.preventDefault();
            editForm('#create-work-experience-modal', route);
        }

        function saveAcademicStudy(e) {
            e.preventDefault();
        }
    </script>
    <!-- ./Create Form User Work Experience -->
@endsection
