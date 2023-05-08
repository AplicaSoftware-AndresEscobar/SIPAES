@extends('layout.app')

@section('title', __('title.profile'))

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('custom-css')
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: red;
            color: white;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-danger card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('assets/adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ current_user_information()->fullname }}</h3>

                        <p class="text-muted text-center">{{ current_user()->roles->first()->title }}</p>

                        <button href="#" class="btn btn-outline-danger btn-block"
                            onclick="openProfile()"><b>@lang('button.edit-profile')</b></button>
                        <button href="#" class="btn btn-outline-danger btn-block"
                            onclick="openPassword()"><b>@lang('button.change-password')</b></button>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">@lang('title.title-user-information')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-user mr-1"></i>@lang('field.name')</strong>

                        <p id="profile-fullname" class="text-muted">{{ current_user_information()->fullname }}</p>

                        <hr>

                        <strong><i class="fas fa-at mr-1"></i>@lang('field.email_personal')</strong>

                        <p id="profile-" class="text-muted">{!! getModelAttribute(current_user_information(), 'email_personal') !!}</p>

                        <hr>

                        <strong><i class="fas fa-at mr-1"></i>@lang('field.email')</strong>

                        <p id="profile-" class="text-muted">{{ current_user()->email }}</p>

                        <hr>

                        <strong><i class="fas fa-id-card mr-1"></i>@lang('field.document_type')</strong>

                        <p id="profile-" class="text-muted">{{ current_user_information()->document_type->name }}</p>

                        <hr>

                        <strong><i class="far fa-id-card mr-1"></i>@lang('field.document')</strong>

                        <p id="profile-" class="text-muted">{{ current_user_information()->document }}</p>

                        <hr>

                        <strong><i class="fas fa-calendar-alt mr-1"></i>@lang('field.birthdate')</strong>

                        <p id="profile-" class="text-muted">{{ current_user_information()->birthdate }}</p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i>@lang('field.birthday_place')</strong>

                        <p id="profile-" class="text-muted">
                            {{ current_user_information()->birthday_place->getLocation() }}</p>

                        <hr>

                        <strong><i class="fas fa-home mr-1"></i>@lang('field.address')</strong>

                        <p id="profile-" class="text-muted">{!! getModelAttribute(current_user_information(), 'address') !!}</p>

                        <hr>

                        <strong><i class="fas fa-mobile mr-1"></i>@lang('field.phone')</strong>

                        <p id="profile-" class="text-muted">{!! getModelAttribute(current_user_information(), 'phone') !!}</p>

                        <hr>

                        <strong><i class="fas fa-phone mr-1"></i>@lang('field.telephone')</strong>

                        <p id="profile-" class="text-muted">{!! getModelAttribute(current_user_information(), 'telephone') !!}</p>

                        <hr>

                        <strong><i class="fas fa-venus-mars mr-1"></i>@lang('field.gender')</strong>

                        <p id="profile-" class="text-muted">{{ current_user_information()->gender->name }}</p>
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
                                <button class="btn btn-sm btn-outline-danger"
                                onclick="openWorkExperienceModal()">@lang('button.add')</button>
                                <div class="table-responsive mt-2">
                                    <table class="table table-sm table-hover table-bordered" id="table-work-experiencie"
                                        data-route="{{ route('profile.work-experiences.index') }}">
                                        <thead>
                                            <tr class="bg-danger text-white">
                                                <th>@lang('field.company')</th>
                                                <th>@lang('field.job_title')</th>
                                                <th>@lang('field.start_date')</th>
                                                <th>@lang('field.end_date')</th>
                                                <th>@lang('field.duration')</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($userWorkExperiencies as $item)
                                                <tr id="tr-work-experience-{!! $item->pivot->id !!}">
                                                    <td>{!! $item->name !!}</td>
                                                    <td>{!! $item->pivot->job_title !!}</td>
                                                    <td>{!! $item->pivot->start_date !!}</td>
                                                    <td>{!! $item->pivot->end_date !!}</td>
                                                    <td>{!! diffBetweenTwoDates($item->pivot->start_date, $item->pivot->end_date) !!}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="dropdown-toggle btn btn-xs btn-block btn-danger"
                                                                data-toggle="dropdown">
                                                                <span class="fas fa-cog fa-xs"></span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button type="button"
                                                                    onclick="openWorkExperienceModal(true, '{{ route('profile.work-experiences.show', $item->pivot->id) }}',
                                                                    '{{ route('profile.work-experiences.update', $item->pivot->id) }}')"
                                                                    class="dropdown-item">
                                                                    <i class="fas fa-sm fa-sm fa-edit"></i>
                                                                    @lang('button.edit')
                                                                </button>
                                                                <form
                                                                    action="{{ route('profile.work-experiences.destroy', $item->pivot->id) }}"
                                                                    id="form-work-experience-delete-{{ $item->pivot->id }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="deleteWorkExperience(event, {{ $item->pivot->id }})">
                                                                        <i class="fas fa-sm fa-sm fa-trash"></i>
                                                                        @lang('button.delete')
                                                                    </button>
                                                                </form>
                                                            </div>
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
                            <div class="tab-pane" id="user-academic-study">
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="openAcademicStudyModal()">@lang('button.add')</button>
                                <div class="table-responsive mt-2">
                                    <table class="table table-sm table-hover table-bordered" id="table-academic-study"
                                        data-route="{{ route('profile.academic-studies.index') }}">
                                        <thead>
                                            <tr class="bg-danger text-white">
                                                <th>@lang('field.educational_institute')</th>
                                                <th>@lang('field.academic_study_level')</th>
                                                <th>@lang('field.degree')</th>
                                                <th>@lang('field.year')</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse (current_user()->academic_studies as $item)
                                                <tr id="tr-academic-study-{!! $item->pivot->id !!}">
                                                    <td>{!! $item->name !!}</td>
                                                    <td>{!! $item->pivot->academic_study_level->name !!}</td>
                                                    <td>{!! $item->pivot->degree !!}</td>
                                                    <td>{!! $item->pivot->year !!}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="dropdown-toggle btn btn-xs btn-block btn-danger"
                                                                data-toggle="dropdown">
                                                                <span class="fas fa-cog fa-xs"></span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button type="button"
                                                                    onclick="openAcademicStudyModal(true, '{{ route('profile.academic-studies.show', $item->pivot->id) }}',
                                                                    '{{ route('profile.academic-studies.update', $item->pivot->id) }}')"
                                                                    class="dropdown-item">
                                                                    <i class="fas fa-sm fa-sm fa-edit"></i>
                                                                    @lang('button.edit')
                                                                </button>
                                                                <form
                                                                    action="{{ route('profile.academic-studies.destroy', $item->pivot->id) }}"
                                                                    id="form-academic-study-delete-{{ $item->pivot->id }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="deleteAcademicStudy(event, {{ $item->pivot->id }})">
                                                                        <i class="fas fa-sm fa-sm fa-trash"></i>
                                                                        @lang('button.delete')
                                                                    </button>
                                                                </form>
                                                            </div>
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

    <!-- User Profile Modal -->
    <div class="modal fade" id="modal-profile">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">@lang('title.title-user-information')</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.user-information.update') }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div id="errors-profile"></div>

                        <!-- Username -->
                        <div class="form-group">
                            <label>@lang('field.username')</label>
                            <input type="text" class="form-control form-control-sm" name="username" id="username"
                                value="{{ current_user()->username }}">
                        </div>
                        <!-- ./Username -->

                        <!-- Email -->
                        <div class="form-group">
                            <label>@lang('field.email')</label>
                            <input type="text" class="form-control form-control-sm" name="email" id="email"
                                value="{{ current_user()->email }}">
                        </div>
                        <!-- ./Email -->

                        <!-- Name -->
                        <div class="form-group">
                            <label>@lang('field.name')</label>
                            <input type="text" class="form-control form-control-sm" name="fullname" id="fullname"
                                value="{{ current_user_information()->fullname }}">
                        </div>
                        <!-- ./Name -->

                        <!-- Email Personal -->
                        <div class="form-group">
                            <label>@lang('field.email_personal')</label>
                            <input type="text" class="form-control form-control-sm" name="email_personal"
                                id="email_personal" value="{{ current_user_information()->email_personal }}">
                        </div>
                        <!-- . Email Personal -->

                        <!-- Document Type -->
                        <div class="form-group">
                            <label>@lang('field.document_type')</label>
                            <select name="document_type_id" id="document_type_id" class="form-control select2bs4"
                                data-dropdown-css-class="select2-danger" style="width: 100%">
                                @forelse ($documentTypes as $key => $value)
                                    <option value="{{ $key }}" {!! optionIsSelected($key, current_user_information()->document_type_id) !!}>{{ $value }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <!-- ./Document Type -->

                        <!-- Document -->
                        <div class="form-group">
                            <label>@lang('field.document')</label>
                            <input type="text" class="form-control form-control-sm" name="document" id="document"
                                value="{{ current_user_information()->document }}">
                        </div>
                        <!-- ./Document -->

                        <!-- Birthdate -->
                        <div class="form-group">
                            <label>@lang('field.birthdate')</label>
                            <input type="date" class="form-control form-control-sm" name="birthdate" id="birthdate"
                                value="{{ current_user_information()->birthdate }}">
                        </div>
                        <!-- ./Birthdate -->

                        <!-- Birthdate Place -->
                        <div class="form-group">
                            <label>@lang('field.birthday_place')</label>
                            <select name="birthday_place_id" id="birthday_place_id" class="form-control select2bs4"
                                data-dropdown-css-class="select2-danger" style="width: 100%">
                                @forelse ($cities as $key => $value)
                                    <option value="{{ $key }}" {!! optionIsSelected($key, current_user_information()->birthday_place_id) !!}>{{ $value }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <!-- ./Birthdate Place -->

                        <!-- Address -->
                        <div class="form-group">
                            <label>@lang('field.address')</label>
                            <input type="text" class="form-control form-control-sm" name="address" id="address"
                                value="{{ current_user_information()->address }}">
                        </div>
                        <!-- ./Address -->

                        <!-- Phone -->
                        <div class="form-group">
                            <label>@lang('field.phone')</label>
                            <input type="text" class="form-control form-control-sm" name="phone" id="phone"
                                value="{{ current_user_information()->phone }}">
                        </div>
                        <!-- ./Phone -->

                        <!-- Telephone -->
                        <div class="form-group">
                            <label>@lang('field.telephone')</label>
                            <input type="text" class="form-control form-control-sm" name="telephone" id="telephone"
                                value="{{ current_user_information()->telephone }}">
                        </div>
                        <!-- ./Telephone -->

                        <!-- Gender -->
                        <div class="form-group">
                            <label>@lang('field.gender')</label>
                            <select name="gender_id" id="gender_id" class="form-control select2bs4"
                                data-dropdown-css-class="select2-danger" style="width: 100%">
                                @forelse ($genders as $key => $value)
                                    <option value="{{ $key }}" {!! optionIsSelected($key, current_user_information()->gender_id) !!}>{{ $value }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <!-- ./Gender -->

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                        onclick="closeProfileModal()">@lang('button.close')</button>
                    <button type="button" class="btn btn-danger"
                        onclick="submitProfileForm(event)">@lang('button.save')</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ./User Profile Modal -->

    <!-- User Password Modal -->
    <div class="modal fade" id="modal-password">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">@lang('title.title-user-information')</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.user-password.update') }}" method="POST">

                        @csrf
                        @method('PATCH')

                        <div id="errors-password"></div>

                        <!-- Password -->
                        <div class="form-group">
                            <label>@lang('field.password')</label>
                            <input type="password" class="form-control form-control-sm" name="password" id="password">
                        </div>
                        <!-- ./Password -->

                        <!-- Password -->
                        <div class="form-group">
                            <label>@lang('field.password_confirmation')</label>
                            <input type="password" class="form-control form-control-sm" name="password_confirmation"
                                id="password_confirmation">
                        </div>
                        <!-- ./Password -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                        onclick="closePasswordModal()">@lang('button.close')</button>
                    <button type="button" class="btn btn-danger"
                        onclick="submitPasswordForm(event)">@lang('button.save')</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ./User Password Modal -->

    <!-- User Work Experience Modal -->
    <div class="modal fade" id="modal-work-experience">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">@lang('models.user_work_experience.forms.create')</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-user-work-experience">

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
                    <button type="button" class="btn btn-default"
                        onclick="closeWorkExperienceModal()">@lang('button.close')</button>
                    <button type="button" class="btn btn-danger"
                        onclick="submitWorkExperienceForm(event)">@lang('button.save')</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ./User Work Experience Modal -->

    <!-- User Academic Studies Modal -->
    <div class="modal fade" id="modal-academic-study">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">@lang('models.user_academic_studies.forms.create')</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-user-academic-study">

                        @csrf

                        <div id="errors-academic-study"></div>

                        <!-- Institute -->
                        <div class="form-group">
                            <label>@lang('field.educational_institute')</label>
                            <select name="educational_institute_id" id="educational_institute_id"
                                class="custom-select form-control-sm select2bs4">
                                @forelse ($institutes as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <!-- ./Institute -->

                        <!-- Academic Study Level -->
                        <div class="form-group">
                            <label>@lang('field.academic_study_level')</label>
                            <select name="academic_study_level_id" id="academic_study_level_id"
                                class="custom-select form-control-sm select2bs4">
                                @forelse ($studyLevels as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <!-- ./Academic Study Level -->

                        <!-- Degree -->
                        <div class="form-group">
                            <label>@lang('field.degree')</label>
                            <input type="text" class="form-control form-control-sm" name="degree" id="degree">
                        </div>
                        <!-- ./Degree -->

                        <!-- Year -->
                        <div class="form-group">
                            <label>@lang('field.year')</label>
                            <input type="text" class="form-control form-control-sm" name="year" id="year"
                                min="1900" max="{{ now()->format('Y') }}" minlength="4" maxlength="4">
                        </div>
                        <!-- ./Year -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                        onclick="closeAcademicStudyModal()">@lang('button.close')</button>
                    <button type="button" class="btn btn-danger"
                        onclick="submitAcademicStudyForm(event)">@lang('button.save')</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ./User Academic Studies Modal -->
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('assets/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('custom-js')
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>

    <!-- Profile Modal -->
    <script>
        /** Estructura para abrir el modal de perfil **/
        function openProfile(routeUpdate = null) {
            const modal = $('#modal-profile');
            openModal(modal);
        }
        /** ./Estructura para abrir el modal de perfil **/

        /** Estructura para cerrar el modal de Perfil **/
        function closeProfileModal() {
            const modal = $('#modal-profile');
            const form = modal.find('form');
            const errorDiv = $('#errors-profile');
            clearErrorInputs(form);
            removeErrorsDiv(errorDiv);
            closeModal(modal);
        }
        /** ./Estructura para cerrar el modal de Perfil **/

        /** Estructura para guardar el formulario dentro del modal de Perfil **/
        function submitProfileForm(e) {
            e.preventDefault();
            const modal = $('#modal-profile');
            const errorDiv = $('#errors-profile');
            const table = $('#table-work-experiencie');
            const saved = saveProfileForm(modal, errorDiv);
        }
        /** ./Estructura para guardar el formulario dentro del modal de Perfil **/

        /** Funcionalidad para guardar específicamente la información del perfil de usuario **/
        function saveProfileForm(modal, errorDiv) {
            const form = modal.find("form");
            const formAction = form.attr("action");
            const formMethod = form.attr("method");
            const formData = form.serializeArray();

            $.ajax({
                url: formAction,
                type: formMethod,
                data: formData,
                async: false,
                success: function(response) {
                    showMessageAlert(response.icon, response.title);
                    clearErrorInputs(form);
                    clearInputs(form);
                    removeErrorsDiv(errorDiv);
                    removeInputMethod(form);
                    closeModal(modal);
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    clearErrorInputs(form);
                    showErrors(errors, errorDiv);
                },
            });

        }
        /** ./Funcionalidad para guardar específicamente la información del perfil de usuario **/

        function resetUserInformation() {
            const authUserInfoData = json_encode("{{ current_user_information() }}");
        }
    </script>
    <!-- ./Profile Modal -->

    <!-- Password Modal -->
    <script>
        /** Estructura para abrir el modal de perfil **/
        function openPassword(routeUpdate = null) {
            const modal = $('#modal-password');
            openModal(modal);
        }
        /** ./Estructura para abrir el modal de perfil **/

        /** Estructura para cerrar el modal de Perfil **/
        function closePasswordModal() {
            const modal = $('#modal-password');
            const form = modal.find('form');
            const errorDiv = $('#errors-password');
            clearErrorInputs(form);
            removeErrorsDiv(errorDiv);
            closeModal(modal);
        }
        /** ./Estructura para cerrar el modal de Perfil **/

        /** Estructura para guardar el formulario dentro del modal de Perfil **/
        function submitPasswordForm(e) {
            e.preventDefault();
            const modal = $('#modal-password');
            const errorDiv = $('#errors-password');
            const table = $('#table-work-experiencie');
            const saved = savePasswordForm(modal, errorDiv);
        }
        /** ./Estructura para guardar el formulario dentro del modal de Perfil **/

        /** Funcionalidad para guardar específicamente la información del perfil de usuario **/
        function savePasswordForm(modal, errorDiv) {
            const form = modal.find("form");
            const formAction = form.attr("action");
            const formMethod = form.attr("method");
            const formData = form.serializeArray();

            $.ajax({
                url: formAction,
                type: formMethod,
                data: formData,
                async: false,
                success: function(response) {
                    showMessageAlert(response.icon, response.title);
                    clearErrorInputs(form);
                    clearInputs(form);
                    removeErrorsDiv(errorDiv);
                    removeInputMethod(form);
                    closeModal(modal);
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    clearErrorInputs(form);
                    showErrors(errors, errorDiv);
                },
            });

        }
    </script>
    <!-- ./Password Modal -->

    <!-- User Work Experiences -->
    <script>
        /** Estructura para abrir el modal de Experiencias Laborales **/
        function openWorkExperienceModal(editMode = false, routeShow = null, routeUpdate = null) {
            const modal = $('#modal-work-experience');
            const title = modal.find('h5');
            const form = modal.find('form');

            if (editMode) {
                form.attr('action', routeUpdate);
                title.text(window.translations_models.user_work_experience.forms.edit);
                editFormMode(modal, routeShow);
                addInputMethod(form, 'PUT');
            } else {
                form.attr('action', "{{ route('profile.work-experiences.store') }}");
                title.text(window.translations_models.user_work_experience.forms.create);
            }

            openModal(modal);
        }
        /** ./Estructura para abrir el modal de Experiencias Laborales **/

        /** Estructura para cerrar el modal de Experiencias Laborales **/
        function closeWorkExperienceModal() {
            const modal = $('#modal-work-experience');
            const form = modal.find('form');
            const errorDiv = $('#errors-work-experience');
            clearErrorInputs(form);
            clearInputs(form);
            removeErrorsDiv(errorDiv);
            removeInputMethod(form);
            closeModal(modal);
        }
        /** ./Estructura para cerrar el modal de Experiencias Laborales **/

        /** Estructura para guardar el formulario dentro del modal de Experiencias Laborales **/
        function submitWorkExperienceForm(e) {
            e.preventDefault();
            const modal = $('#modal-work-experience');

            const errorDiv = $('#errors-work-experience');
            const table = $('#table-work-experiencie');
            const saved = saveForm(modal, errorDiv);
            if (saved) {
                resetTableBodyWorkExperience(table);
            }
        }

        /** Estructura para actualizar el formulario dentro del modal de Experiencias Laborales **/
        function updateWorkExperience(e) {
            e.preventDefault();
            const modal = $('#modal-work-experience');
            const errorDiv = $('#errors-work-experience');
            const table = $('#table-work-experiencie');
            const updated = saveForm(modal, errorDiv, table);
            if (updated) {
                resetTableBodyWorkExperience(table);
            }
        }
        /** ./Estructura para actualizar el formulario dentro del modal de Experiencias Laborales **/

        /** Estructura para eliminar la Experiencia Laboral **/
        function deleteWorkExperience(e, id) {
            e.preventDefault();
            const form = $(`#form-work-experience-delete-${id}`);
            const tr = $(`#tr-work-experience-${id}`);
            deleteItem(form, tr);
        }
        /** ./Estructura para eliminar la Experiencia Laboral **/

        /** Reseteo de la tabla **/
        function resetTableBodyWorkExperience(table) {
            const route = table.data("route");
            const tbody = table.find("tbody").empty();
            $.ajax({
                url: route,
                type: "GET",
                success: function(response) {
                    var htmlTd = "";
                    response.forEach((item) => {
                        htmlTd += `
                    <tr id="tr-work-experience-${item.id}">
                        <td>${item.company}</td>
                        <td>${item.job_title}</td>
                        <td>${item.start_date}</td>
                        <td>${item.end_date}</td>
                        <td>${item.diff}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button"
                                    class="dropdown-toggle btn btn-sm btn-block btn-danger"
                                    data-toggle="dropdown">
                                    <span class="fas fa-cog"></span>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button"
                                        onclick="openWorkExperienceModal(true, '${item.routes.show}', '${item.routes.update}')"
                                        class="dropdown-item">
                                        <i class="fas fa-sm fa-sm fa-edit"></i>
                                        ${window.translations_button["edit"]}
                                    </button>
                                    <form action="${item.routes.delete}"
                                        id="form-work-experience-delete-${item.id}"
                                        method="post">
                                        <input type="hidden" name="_token" value="${window.csrf}">
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="dropdown-item"
                                            onclick="deleteWorkExperience(event, ${item.id})">
                                            <i class="fas fa-sm fa-sm fa-trash"></i>
                                            ${window.translations_button["delete"]}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
                    });
                    tbody.html(htmlTd);
                },
            });
        }
        /** ./Reseteo de la tabla **/
    </script>
    <!-- ./User Work Experiences -->

    <!-- User Academy Study -->
    <script>
        /** Estructura para abrir el modal de Historial Académico **/
        function openAcademicStudyModal(editMode = false, routeShow = null, routeUpdate = null) {
            const modal = $('#modal-academic-study');
            const errorDiv = $('#errors-academic-study');
            const title = modal.find('h5');
            const form = modal.find('form');

            if (editMode) {
                form.attr('action', routeUpdate);
                title.text(window.translations_models.user_academic_studies.forms.edit);
                editFormMode(modal, routeShow);
                addInputMethod(form, 'PUT');
            } else {
                form.attr('action', "{{ route('profile.academic-studies.store') }}");
                title.text(window.translations_models.user_academic_studies.forms.create);
            }

            openModal(modal);
        }
        /** ./Estructura para abrir el modal de Historial Académico **/

        /** Estructura para cerrar el modal de Historial Académico **/
        function closeAcademicStudyModal() {
            const modal = $('#modal-academic-study');
            const form = modal.find('form');
            const errorDiv = $('#errors-academic-study');
            clearErrorInputs(form);
            clearInputs(form);
            removeErrorsDiv(errorDiv);
            removeInputMethod(form);
            closeModal(modal);
        }
        /** ./Estructura para cerrar el modal de Historial Académico **/

        /** Estructura para guardar el formulario dentro del modal de Historial Académico **/
        function submitAcademicStudyForm(e) {
            e.preventDefault();
            const modal = $('#modal-academic-study');

            const errorDiv = $('#errors-academic-study');
            const table = $('#table-academic-study');
            const saved = saveForm(modal, errorDiv);
            if (saved) {
                resetTableBodyAcademicStudy(table);
            }
        }

        /** Estructura para actualizar el formulario dentro del modal de Historial Académico **/
        function updateAcademicStudy(e) {
            e.preventDefault();
            const modal = $('#modal-academic-study');
            const errorDiv = $('#errors-academic-study');
            const table = $('#table-academic-study');
            const updated = saveForm(modal, errorDiv, table);
            if (updated) {
                resetTableBodyAcademicStudy(table);
            }
        }
        /** ./Estructura para actualizar el formulario dentro del modal de Historial Académico **/

        /** Estructura para eliminar la Experiencia Laboral **/
        function deleteAcademicStudy(e, id) {
            e.preventDefault();
            const form = $(`#form-academic-study-delete-${id}`);
            const tr = $(`#tr-academic-study-${id}`);
            deleteItem(form, tr);
        }
        /** ./Estructura para eliminar la Experiencia Laboral **/

        /** Reseteo de la tabla **/
        function resetTableBodyAcademicStudy(table) {
            const route = table.data("route");
            const tbody = table.find("tbody").empty();
            $.ajax({
                url: route,
                type: "GET",
                success: function(response) {
                    var htmlTd = "";
                    response.forEach((item) => {
                        htmlTd += `
                <tr id="tr-academic-study-${item.id}">
                    <td>${item.educational_institute}</td>
                    <td>${item.academic_study_level}</td>
                    <td>${item.degree}</td>
                    <td>${item.year}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button"
                                class="dropdown-toggle btn btn-sm btn-block btn-danger"
                                data-toggle="dropdown">
                                <span class="fas fa-cog"></span>
                            </button>
                            <div class="dropdown-menu">
                                <button type="button"
                                    onclick="openAcademicStudyModal(true, '${item.routes.show}', '${item.routes.update}')"
                                    class="dropdown-item">
                                    <i class="fas fa-sm fa-sm fa-edit"></i>
                                    ${window.translations_button["edit"]}
                                </button>
                                <form action="${item.routes.delete}"
                                    id="form-academic-study-delete-${item.id}"
                                    method="post">
                                    <input type="hidden" name="_token" value="${window.csrf}">
                                    <input type="hidden" name="_method" value="DELETE">

                                    <button type="submit" class="dropdown-item"
                                        onclick="deleteAcademicStudy(event, ${item.id})">
                                        <i class="fas fa-sm fa-sm fa-trash"></i>
                                        ${window.translations_button["delete"]}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
                    });
                    tbody.html(htmlTd);
                },
            });
        }
        /** ./Reseteo de la tabla **/
    </script>
    <!-- ./User Academy Study -->
@endsection
