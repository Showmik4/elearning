<?php
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CccMeetingAgendaController;
use App\Http\Controllers\CommitmentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KpiAssignController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\KpiFeedbackController;
use App\Http\Controllers\KpiSubTypeController;
use App\Http\Controllers\KpiTypeController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyFormController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\RolePermissionController;
use App\Models\CEOCommitMentLetter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    Route::get('/registration_confimation', [HomeController::class, 'registration_confimation'])->name('registration_confimation');
    Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/pie_chart', [HomeController::class, 'pie_chart'])->name('pie_chart');
    Route::post('ckeditor/upload', [HomeController::class, 'upload'])->name('ckeditor.upload');   

    //Settings
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::get('/show', [SettingController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [SettingController::class, 'list'])->name('list');
        Route::get('create', [SettingController::class, 'create'])->name('create');
        Route::post('store', [SettingController::class, 'store'])->name('store');
        Route::get('edit/{id}', [SettingController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [SettingController::class, 'update'])->name('update');
        Route::post('delete', [SettingController::class, 'delete'])->name('delete');
    });

    //User
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('user-profile', [UserController::class, 'userProfile'])->name('profile');
        Route::post('update-user-profile', [UserController::class, 'updateUserProfile'])->name('updateProfile');
        Route::post('customer/search', [UserController::class, 'customerSearch'])->name('customer.search');
        Route::post('customer-data', [UserController::class, 'customerData'])->name('customer.data');
        Route::post('customer-store', [UserController::class, 'customerStore'])->name('customer.store');
        Route::get('view-employee', [UserController::class, 'viewEmployee'])->name('view-employee')->middleware('check.permission');
        Route::post('employee-list', [UserController::class, 'employeeList'])->name('employee-list');
        Route::get('create-employee', [UserController::class, 'createEmployee'])->name('create-employee')->middleware('check.permission');
        Route::post('employee-store', [UserController::class, 'employeeStore'])->name('employee-store');
        Route::get('editEmployee/{id}', [UserController::class, 'editEmployee'])->name('editEmployee')->middleware('check.permission');
        Route::post('updateEmployee/{id}', [UserController::class, 'updateEmployee'])->name('updateEmployee');
        Route::post('delete', [UserController::class, 'deleteEmployee'])->name('delete');
    });

    //User Type
    Route::group(['prefix' => 'userType', 'as' => 'userType.'], function () {
        Route::get('/show', [UserTypeController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [UserTypeController::class, 'list'])->name('list');
        Route::get('create', [UserTypeController::class, 'create'])->name('create');
        Route::post('store', [UserTypeController::class, 'store'])->name('store');
        Route::get('edit/{id}', [UserTypeController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [UserTypeController::class, 'update'])->name('update');
        Route::post('delete', [UserTypeController::class, 'delete'])->name('delete');
        Route::post('role-update', [UserTypeController::class, 'role_update'])->name('role-update');
    });

    //Role Permission
    Route::group(['prefix' => 'role_permission', 'as' => 'role_permission.'], function () {
        Route::get('/show', [RolePermissionController::class, 'show'])->name('show');
        Route::post('/list', [RolePermissionController::class, 'list'])->name('list');
        Route::get('create', [RolePermissionController::class, 'create'])->name('create');
        Route::post('store', [RolePermissionController::class, 'store'])->name('store');
        Route::get('edit/{id}', [RolePermissionController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [RolePermissionController::class, 'update'])->name('update');
        Route::post('delete', [RolePermissionController::class, 'delete'])->name('delete');
    }); 

     //Team
     Route::group(['prefix' => 'team', 'as' => 'team.'], function () {
        Route::get('/show', [TeamController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [TeamController::class, 'list'])->name('list');
        Route::get('create', [TeamController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [TeamController::class, 'store'])->name('store');
        Route::get('edit/{id}', [TeamController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [TeamController::class, 'update'])->name('update');
        Route::post('delete', [TeamController::class, 'delete'])->name('delete')->middleware('check.permission');
    });

    //Survey
      Route::group(['prefix' => 'survey', 'as' => 'survey.'], function () {
        Route::get('/show', [SurveyController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [SurveyController::class, 'list'])->name('list');
        Route::get('create', [SurveyController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [SurveyController::class, 'store'])->name('store');
        Route::get('edit/{id}', [SurveyController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [SurveyController::class, 'update'])->name('update');
        Route::post('delete', [SurveyController::class, 'delete'])->name('delete')->middleware('check.permission');
        Route::get('details/{id}', [SurveyFormController::class, 'survey_form'])->name('details')->middleware('check.permission');
        Route::post('submit_survey', [SurveyFormController::class, 'submit_survey_form'])->name('submit_survey');
        Route::get('complete_survey', [SurveyFormController::class, 'complete_survey'])->name('complete_survey')->middleware('check.permission');
        Route::post('complete_survey_list', [SurveyFormController::class, 'complete_survey_list'])->name('complete_survey_list');
        Route::get('view_complete_survey_answer/{reference_no}', [SurveyFormController::class, 'view_complete_survey_answer'])->name('view_complete_survey_answer')->middleware('check.permission');
    });

    //Question
    Route::group(['prefix' => 'question', 'as' => 'question.'], function () {
        Route::get('/show', [QuestionController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [QuestionController::class, 'list'])->name('list');
        Route::get('create', [QuestionController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [QuestionController::class, 'store'])->name('store');
        Route::get('edit/{id}', [QuestionController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [QuestionController::class, 'update'])->name('update');
        Route::post('delete', [QuestionController::class, 'delete'])->name('delete');
    });

    //Question
    Route::group(['prefix' => 'answer', 'as' => 'answer.'], function () {
        Route::get('/show', [AnswerController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [AnswerController::class, 'list'])->name('list');
        Route::get('create/{id}', [AnswerController::class, 'create'])->name('create');
        Route::get('add', [AnswerController::class, 'add'])->name('add');
        Route::post('store', [AnswerController::class, 'store'])->name('store');
        Route::get('edit/{id}', [AnswerController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [QuestionController::class, 'update'])->name('update');
        Route::post('delete', [AnswerController::class, 'delete'])->name('delete');
    });
  
    //Kpi Type
    Route::group(['prefix' => 'kpi_type', 'as' => 'kpi_type.'], function () {
        Route::get('/show', [KpiTypeController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [KpiTypeController::class, 'list'])->name('list');
        Route::get('create', [KpiTypeController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [KpiTypeController::class, 'store'])->name('store');
        Route::get('edit/{id}', [KpiTypeController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [KpiTypeController::class, 'update'])->name('update');
        Route::post('delete', [KpiTypeController::class, 'delete'])->name('delete')->middleware('check.permission');
    });

    //Kpi SubType
    Route::group(['prefix' => 'kpi_subtype', 'as' => 'kpi_subtype.'], function () {
        Route::get('/show', [KpiSubTypeController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [KpiSubTypeController::class, 'list'])->name('list');
        Route::get('create', [KpiSubTypeController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [KpiSubTypeController::class, 'store'])->name('store');
        Route::get('edit/{id}', [KpiSubTypeController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [KpiSubTypeController::class, 'update'])->name('update');
        Route::post('delete', [KpiSubTypeController::class, 'delete'])->name('delete');
        Route::post('/subtype_topic_list', [KpiSubTypeController::class, 'subtype_topic_list'])->name('subtype_topic_list');
    });

    //Kpi SubType Topic
    Route::group(['prefix' => 'topic', 'as' => 'topic.'], function () {
        Route::get('/show', [TopicController::class, 'show'])->name('show');
        Route::post('/list', [TopicController::class, 'list'])->name('list');
        Route::get('create', [TopicController::class, 'create'])->name('create');
        Route::post('store', [TopicController::class, 'store'])->name('store');
        Route::get('edit/{id}', [TopicController::class, 'edit'])->name('edit');
        Route::post('delete', [TopicController::class, 'delete'])->name('delete');
        Route::post('update/{id}', [KpiSubTypeController::class, 'update'])->name('update');        
        Route::post('/subtype_topic_list', [KpiSubTypeController::class, 'subtype_topic_list'])->name('subtype_topic_list');
    });

    //Kpi
    Route::group(['prefix' => 'kpi', 'as' => 'kpi.'], function () {
        Route::get('/show', [KpiController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [KpiController::class, 'list'])->name('list');
        Route::get('create', [KpiController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [KpiController::class, 'store'])->name('store');
        Route::get('edit/{id}', [KpiController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [KpiController::class, 'update'])->name('update');
        Route::post('delete', [KpiController::class, 'delete'])->name('delete');
        Route::post('findSubType', [KpiController::class, 'findSubType'])->name('findSubType');
        Route::post('findSubTypeTopic', [KpiController::class, 'findSubTypeTopic'])->name('findSubTypeTopic');
        Route::get('assign/{id}', [KpiAssignController::class, 'assign'])->name('assign')->middleware('check.permission');
        Route::post('assign_submit', [KpiAssignController::class, 'assign_submit'])->name('assign_submit');
        Route::post('assignList', [KpiAssignController::class, 'assignList'])->name('assignList');
        Route::get('all_assigned_kpi', [KpiAssignController::class, 'all_kpi'])->name('all_assigned_kpi')->middleware('check.permission');
        Route::post('all_assigned_kpi_list', [KpiAssignController::class, 'all_assigned_kpi_list'])->name('all_assigned_kpi_list');
        Route::get('kpi_feedback/{id}', [KpiFeedbackController::class, 'kpi_feedback'])->name('kpi_feedback')->middleware('check.permission');
        Route::post('kpi_feedback_submit/{id}', [KpiFeedbackController::class, 'kpi_feedback_submit'])->name('kpi_feedback_submit');
        Route::get('complete_kpi/{id}', [KpiFeedbackController::class, 'complete_kpi'])->name('complete_kpi')->middleware('check.permission');
        Route::post('complete_kpi_submit/{id}', [KpiFeedbackController::class, 'complete_kpi_submit'])->name('complete_kpi_submit');
    });
      
    //Meta
    Route::group(['prefix' => 'meta', 'as' => 'meta.'], function () {
        Route::get('/show', [MetaController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [MetaController::class, 'list'])->name('list');
        Route::get('create', [MetaController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [MetaController::class, 'store'])->name('store');
        Route::get('edit/{id}', [MetaController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [MetaController::class, 'update'])->name('update');
        Route::post('delete', [MetaController::class, 'delete'])->name('delete');
    });

    //Customer
    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::get('/show', [CustomerController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [CustomerController::class, 'list'])->name('list');
        Route::get('create', [CustomerController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [CustomerController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [CustomerController::class, 'update'])->name('update');
        Route::post('delete', [CustomerController::class, 'delete'])->name('delete');
        Route::post('findlocation', [CustomerController::class, 'findLocation'])->name('findlocation');
        Route::post('statusUpdate', [CustomerController::class, 'statusUpdate'])->name('statusUpdate');
    });

    //Customer
    Route::group(['prefix' => 'survey_form', 'as' => 'survey_form.'], function () {
        Route::get('/show', [SurveyFormController::class, 'show'])->name('show');     
      
    });

});
Auth::routes();
