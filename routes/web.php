<?php

use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\ChapaController;
use App\Livewire\HomePage;
use App\Livewire\Subscriptions\ManualPayment;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ManageCourses;
use App\Livewire\Admin\ManageUsers;
use App\Livewire\Instructor\Course\Index as InstructorCourseIndex;
use App\Livewire\User\Profile;
use App\Livewire\User\Follow;
use App\Livewire\Course\Chat;

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\User\Dashboard;
use App\Livewire\Instructor\Dashboard as InstructorDashboard;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\InstructorApplicationForm;
use App\Livewire\Admin\ManageSubscriptions;
use App\Livewire\Instructor\Course\Create as InstructorCourseCreate;
use App\Livewire\Instructor\Course\Edit as InstructorCourseEdit;
use App\Livewire\Course\Index;
use App\Livewire\Course\Player;
use App\Livewire\Course\Show;
use App\Livewire\Instructor\Course\ManageContent as InstructorCourseManageContent;
use Illuminate\Support\Facades\Auth;

Route::get('/', HomePage::class)->name('home');

Route::get('/courses', Index::class)->name('courses.index');

Route::get('/courses/{course}', Show::class)->name('course.detail');




Route::middleware('instructor')->group(function () {
    Route::get('/instructor/dashboard', InstructorDashboard::class)->name('instructor.dashboard');
    Route::get('/instructor/courses', InstructorCourseIndex::class)->name('instructor.courses.index');
    Route::get('/instructor/courses/create', InstructorCourseCreate::class)->name('instructor.courses.create');
    Route::get('/instructor/courses/edit/{course}', InstructorCourseEdit::class)->name('instructor.courses.edit');
    Route::get('/instructor/courses/{course}/manage-content', InstructorCourseManageContent::class)->name('instructor.courses.manage_content');
});


Route::middleware(['admin'])->group(function () {
    Route::get('user/admin/courses', ManageCourses::class)->name('admin.manage_courses');
    Route::get('user/admin/users', ManageUsers::class)->name('admin.manage_users');
    // Route::get('user/admin/dashboard', AdminDashboard::class)->name('user.admin.dashboard');
    Route::get('user/admin/subscriptions', ManageSubscriptions::class)->name('admin.subscriptions'); // for now.. i will change it to filament in near future

});
Route::get('/subscribe', function () {
    return view('subscribe');
})->middleware('auth')->name('subscribe.index');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('user.dashboard');
    Route::get('/profile/{username}', Profile::class)->name('user.profile');
    Route::get('/follow/{user}', Follow::class)->name('user.follow');
    Route::get('/chat/{course}', Chat::class)->name('user.chat');
    Route::get('/courses/{course}/learn/{lesson?}', Player::class)->name('course-play');
    Route::get('/courses/{course}/chat', Chat::class)->name('course-chat');
    Route::get('/subscribe/manual', ManualPayment::class)->name('subscribe.manual');
    Route::get('/instructor/apply', InstructorApplicationForm::class)->name('instructor.apply');
});

// Route::get('/chapa/callback', [ChapaController::class, 'callback'])->name('chapa.callback');
Route::get('/subscribe/chapa', [ChapaController::class, 'initialize'])->name('chapa.pay');
Route::get('/subscribe/chapa/callback', [ChapaController::class, 'verify'])->name('chapa.verify');


Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/auth/{provider}', [OAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [OAuthController::class, 'callback']);

// Route::fallback(function () {
//     return response('Route not found. Available routes: ' . implode(', ', \Illuminate\Support\Facades\Route::getRoutes()->getRoutesByMethod()['GET']), 404);
// });
