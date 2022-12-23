<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/')->namespace('App\Http\Controllers')->group(function () {
 
  Route::middleware('guest')->group(function() {
     Route::get('/', 'HomeController@index')->name('home');
    Route::get('signup', 'RegisterController@signup')->name('signup');
    Route::post('do_register', 'RegisterController@register')->name('register');
    Route::get('signin', 'LoginController@login')->name('signin');
    Route::post('login', 'LoginController@do_login')->name('login');
    Route::get('forgot-password', 'RegisterController@forgotView')->name('forgot-password');
    Route::post('/do-forgot', 'RegisterController@doForgot')->name('do-forgot');
    Route::get('reset-password/{token}', 'RegisterController@showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'RegisterController@submitResetPasswordForm')->name('reset.password.post');
  });
 
Route::post('api/fetch-cities', 'DropdownController@fetchCity');
Route::post('read-notification', 'DropdownController@readNoti')->name('read-notification');
   Route::middleware('auth')->group(function() {
        Route::get('user/dashboard','Dashboard@index')->name('user-dashboard');
        Route::get('profile-dashboard','Dashboard@profileDashboard')->name('profile-dashboard');
        Route::get('user/profile','Dashboard@profile')->name('user-profile');
        Route::post('user/profile_upadate','Dashboard@UpdateProfile')->name('user-update-profile');
        Route::get('user/logout', 'Dashboard@logout')->name('user-logout');
        Route::post('user/lookingfor', 'Dashboard@lookingfor')->name('lookingfor');
        Route::post('user/media-upload', 'Dashboard@mediaUpload')->name('media-upload');
        Route::post('user/show_photos', 'Dashboard@getPhotoBoxes')->name('show_photos');
        Route::post('user/deletePhoto', 'Dashboard@deletePhoto')->name('deletePhoto');
        Route::post('user/setProfile', 'Dashboard@setProfile')->name('setProfile');
        Route::post('user/setCover', 'Dashboard@setCover')->name('setCover');
        Route::get('members/{any}', 'Dashboard@userList' )->name('user-list');
        /*Search-------------------------------*/
        Route::post('do_search', 'SearchMembers@index' )->name('members-search');
        Route::post('member-detail', 'SearchMembers@memberDetails' )->name('member-detail');
        Route::post('pin-user', 'PinController@pinUser' )->name('pin-user');
        Route::post('wink-user', 'WinkController@winkUser' )->name('wink-user');
        Route::post('block-user', 'BlockController@blockUser' )->name('block-user');
        Route::post('unblock-user', 'BlockController@unblockUser' )->name('unblock-user');
        Route::get('blocked-user', 'BlockController@blockedUserList' )->name('blocked-user');
        Route::get('pin-to-user', 'PinController@pinnedToUserList' )->name('pin-to-user');
        Route::get('pin-by-user', 'PinController@pinnedByUserList' )->name('pin-by-user');

        Route::get('wink-to-user', 'WinkController@WinkedToUserList' )->name('wink-to-user');
        Route::get('wink-by-user', 'WinkController@WinkedByUserList' )->name('wink-by-user');
        Route::get('viewed-by-user', 'ViewedController@ViewedByUserList' )->name('viewed-by-user');
        Route::get('viewed-to-user', 'ViewedController@ViewedToUserList' )->name('viewed-to-user');
        
       
    });

});

Route::prefix('/admin')->name('admin.')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::get('/', 'LoginController@login')->name('login');
    Route::get('/login', 'LoginController@login')->name('login');
    Route::post('/login','LoginController@do_login')->name('login');
    Route::get('/logout','LoginController@logout')->name('logout');

    Route::middleware('admin-auth')->group(function() {
       Route::get('/dashboard','Dashboard@index')->name('dashboard');
       Route::get('/profile','Dashboard@profile')->name('profile');
       Route::post('/update_profile','Dashboard@update_profile')->name('update_profile');
       Route::post('/change_password','Dashboard@change_password')->name('change_password');

       Route::get('/occupation','OccupationController@occupation')->name('occupation');
       Route::get('nationality','NationalityController@index')->name('nationality');
        Route::post('add-nationality','NationalityController@addNationality')->name('add-nationality');
        Route::post('update-nationality','NationalityController@updateNationality')->name('update-nationality');
        Route::get('delete-nationality','NationalityController@deleteNationality')->name('delete-nationality');
       Route::get('/edit-user','UserController@edit_user')->name('edit-user');
       Route::get('/add-occupation','OccupationController@addOccupationForm')->name('add-occupation');
       Route::post('/add_occupation','OccupationController@addOccupation')->name('add_occupation');

       Route::get('languages','LanguageController@index')->name('languages');
Route::post('add-languages','LanguageController@addLanguages')->name('add-languages');
Route::post('update-languages','LanguageController@updateLanguages')->name('update-languages');
Route::get('delete-languages','LanguageController@deleteLanguages')->name('delete-languages');
       Route::get('/edit-occupation','OccupationController@editOccupationForm')->name('edit-occupation');
       Route::get('education','EducationController@index')->name('education');
Route::post('add-education','EducationController@addEducation')->name('add-education');
Route::post('update-education','EducationController@updateEducation')->name('update-education');
Route::get('delete-education','EducationController@deleteEducation')->name('delete-education');
Route::post('update-user-profile','Dashboard@update_user_profile')->name('update-user-profile');
        Route::post('/edit_occupation','OccupationController@editOccupation')->name('edit_occupation');
        Route::get('/delete-occupation','OccupationController@deleteOccupation')->name('delete-occupation');
        

        Route::get('/user','UserController@index')->name('user');
        Route::post('/change-status','UserController@change_status')->name('change-status');
        Route::get('/delete-user','UserController@deleteUser')->name('delete-user');

        Route::get('/faqs','FaqController@faq_list')->name('faqs');
        Route::post('/add-faq','FaqController@addfaq')->name('add-faq');
        Route::post('/edit-faq','FaqController@editfaq')->name('edit-faq');
        Route::get('/delete-faq','FaqController@deletefaq')->name('delete-faq');

        Route::get('/blog','BlogController@blog_list')->name('blog');
        Route::post('/add-blog','BlogController@addblog')->name('add-blog');
        Route::post('/edit-blog','BlogController@editblog')->name('edit-blog');
        Route::get('/delete-blog','BlogController@deleteblog')->name('delete-blog');
    });
});

