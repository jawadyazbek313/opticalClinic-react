<?php

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AdminPanel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Codedge\Updater\UpdaterManager;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
Route::resource('/patient', PatientController::class);
Route::resource('/appointment', AppointmentController::class);

Route::post('/appointment/{id}/MarkDone', [AppointmentController::class, 'MarkDone'])->name('MarkDone');
Route::get('/go/fetch_data', [App\Http\Controllers\HomeController::class, 'fetch_data'])->name('Fetch_data');
Route::get('/appointments/trashlist', [App\Http\Controllers\AppointmentController::class, 'trashlist'])->name('appointment.trashlist');
Route::get('/appointment/{id}/restore', [App\Http\Controllers\AppointmentController::class, 'restore'])->name('appointment.Restore');
Route::get('/appointments/trashlistrefresh', [App\Http\Controllers\AppointmentController::class, 'trashlistrefresh'])->name('appointment.trashlistrefresh');
Route::post('/appointment/trash', [App\Http\Controllers\AppointmentController::class, 'trash'])->name('appointment.trash');
Route::view('/chat', 'chats.chat');

// Route::group(, function () {

//     Route::resource('permissions', 'Admin\PermissionsController');
//     Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
//     Route::resource('roles', 'Admin\RolesController');
//     Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
//     Route::resource('users', 'Admin\UsersController');
//     Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
// });
// Route::group([['middleware' => , 'prefix' => 'admin', 'as' => 'admin.']], function () {
//     Route::resource('permissions', PermissionsController::class);
//     Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
//     Route::resource('roles', RolesController::class);
//     Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
//     Route::resource('users', UsersController::class);
//     Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
// });
Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::resource('permissions', PermissionsController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
});

Route::middleware('auth')->get('setRole', function () {
    $user = User::Find(Auth::user()->id);
    $user->assignRole('admin');
    return Redirect::route('home');
});


// Route to Update The program Via the button
Route::get('/UpdateApplication', function (UpdaterManager $updater) {
    $response="";
    function is_connected()
    {
        $connected = @fsockopen('www.google.com', 80);
        //website, port  (try 80 or 443)
        if ($connected) {
            $is_conn = true; //action when connected
            fclose($connected);
        } else {
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }
    // echo $versionAvailable = $updater->source()->getVersionAvailable();
    // echo $updater->source()->getVersionInstalled();
    // Get the new version available
    if(!is_connected()){
        $response='connectionError'; 
        $version= $updater->source()->getVersionInstalled();
           
        return view('updatePage',compact('response','version'));
}
    // Check if new version is available
    if ($updater->source()->isNewVersionAvailable()) {

        // Get the current installed version
        $updater->source()->getVersionInstalled();
        // Get the new version available
        $versionAvailable = $updater->source()->getVersionAvailable();
        // Create a release
        $release = $updater->source()->fetch($versionAvailable);

        // Run the update process

        $updater->source()->update($release);
        $path = base_path('.env');

        if (file_exists($path)) {
            if (file_put_contents($path, str_replace(
                'SELF_UPDATER_VERSION_INSTALLED=' . $updater->source()->getVersionInstalled(),
                'SELF_UPDATER_VERSION_INSTALLED=' . $versionAvailable = $updater->source()->getVersionAvailable(),
                file_get_contents($path)
            ))) {
                // Change Value Using It
                Artisan::call('optimize:clear');
                Artisan::call('config:cache');
                Artisan::call('storage:link');
                if (file_exists(storage_path('app/self-updater-new-version')))
                    File::delete(storage_path('app/self-updater-new-version'));
                $response="updated";
                $version= $updater->source()->getVersionInstalled();
                return view('updatePage',compact('response','version'));
            }
        }
    } else {
        // Comment to test update 
        $response="latest";
        $version= $updater->source()->getVersionInstalled();
        return view('updatePage',compact('response','version'));
        
    }
})->name('UpdateApp')->middleware('auth');

// Route to Update The program Via the button
Route::get('/findDuplicateMembers',[App\Http\Controllers\PatientController::class, 'findSimilarPatients']
)->name("findDuplicateMembers");