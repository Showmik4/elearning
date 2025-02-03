<?php
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CccMeetingAgendaController;
use App\Http\Controllers\CommitmentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\HomePageSettingsController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KpiAssignController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\KpiFeedbackController;
use App\Http\Controllers\KpiSubTypeController;
use App\Http\Controllers\KpiTypeController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyFormController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TrainerController;
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
    Route::get('/', [FrontendController::class, 'homepage'])->name('homepage');
    Route::get('/aboutus', [FrontendController::class, 'aboutus'])->name('aboutus');
    Route::get('/course', [FrontendController::class, 'course'])->name('course');
    Route::get('/course_details/{id}', [FrontendController::class, 'course_details'])->name('course_details');
    Route::get('/checkout/{id}', [FrontendController::class, 'checkout'])->name('checkout');
    Route::post('/submit_order', [FrontendController::class, 'submit_order'])->name('submit_order');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
    Route::post('/submit_contact', [FrontendController::class, 'submit_contact'])->name('submit_contact');
    Route::get('/trainer', [FrontendController::class, 'trainer'])->name('trainer');
    Route::get('/registration_confimation', [HomeController::class, 'registration_confimation'])->name('registration_confimation');
    Route::group(['middleware' => 'auth'], function () {
    Route::get('/index', [HomeController::class, 'index'])->name('index');
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

    //Question
    Route::group(['prefix' => 'trainer', 'as' => 'trainer.'], function () {
        Route::get('/show', [TrainerController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [TrainerController::class, 'list'])->name('list');
        Route::get('create', [TrainerController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [TrainerController::class, 'store'])->name('store');
        Route::get('edit/{id}', [TrainerController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [TrainerController::class, 'update'])->name('update');
        Route::post('delete', [TrainerController::class, 'delete'])->name('delete')->middleware('check.permission');
    });

    //Question
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/show', [CategoryController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [CategoryController::class, 'list'])->name('list');
        Route::get('create', [CategoryController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::post('delete', [CategoryController::class, 'delete'])->name('delete')->middleware('check.permission');
    });

    //Course
    Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
        Route::get('/show', [CourseController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [CourseController::class, 'list'])->name('list');
        Route::get('create', [CourseController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [CourseController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CourseController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [CourseController::class, 'update'])->name('update');
        Route::post('delete', [CourseController::class, 'delete'])->name('delete')->middleware('check.permission');
    });

    //Course
    Route::group(['prefix' => 'course_material', 'as' => 'course_material.'], function () {
        Route::get('/show', [CourseMaterialController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [CourseMaterialController::class, 'list'])->name('list');
        Route::get('create/{id}', [CourseMaterialController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [CourseMaterialController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CourseMaterialController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [CourseMaterialController::class, 'update'])->name('update');
        Route::post('delete', [CourseMaterialController::class, 'delete'])->name('delete')->middleware('check.permission');
    });

    //Course
    Route::group(['prefix' => 'testimonial', 'as' => 'testimonial.'], function () {
        Route::get('/show', [TestimonialController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [TestimonialController::class, 'list'])->name('list');
        Route::get('create', [TestimonialController::class, 'create'])->name('create')->middleware('check.permission');
        Route::post('store', [TestimonialController::class, 'store'])->name('store');
        Route::get('edit/{id}', [TestimonialController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [TestimonialController::class, 'update'])->name('update');
        Route::post('delete', [TestimonialController::class, 'delete'])->name('delete')->middleware('check.permission');
    });

    //homepage settings
    Route::group(['prefix' => 'homepage_settings', 'as' => 'homepage_settings.'], function () {
        Route::get('/show', [HomePageSettingsController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [HomePageSettingsController::class, 'list'])->name('list');     
        Route::get('edit/{id}', [HomePageSettingsController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [HomePageSettingsController::class, 'update'])->name('update');       
    });

    //About
    Route::group(['prefix' => 'about', 'as' => 'about.'], function () {
        Route::get('/show', [AboutController::class, 'show'])->name('show')->middleware('check.permission');
        Route::post('/list', [AboutController::class, 'list'])->name('list');      
        Route::get('edit/{id}', [AboutController::class, 'edit'])->name('edit')->middleware('check.permission');
        Route::post('update/{id}', [AboutController::class, 'update'])->name('update');
        Route::post('delete', [AboutController::class, 'delete'])->name('delete')->middleware('check.permission');
    });

    //Order
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('/show', [OrderController::class, 'show'])->name('show')->middleware('check.permission');
    Route::post('/list', [OrderController::class, 'list'])->name('list'); 
    Route::get('course_details/{id}', [OrderController::class, 'course_details'])->name('course_details')->middleware('check.permission');
    Route::post('course_detailsList', [OrderController::class, 'course_detailsList'])->name('course_detailsList');
    });

});
Auth::routes();
