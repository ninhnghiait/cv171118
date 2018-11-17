<?php
Route::pattern('id', '([0-9]+)');
Route::pattern('slug', '(.*)');

Route::group(['middleware' => 'localization', 'prefix' => Session::get('locale')], function() {
Route::namespace('Aboutme')->group(function (){
	Route::prefix('aboutme')->group(function (){
		Route::get('','ABMIndexController@index')->name('aboutme.abmindex.index');
		Route::get('works-{id}','ABMIndexController@works')->name('aboutme.abmindex.works');
		Route::get('gallery-{id}','ABMIndexController@gallery')->name('aboutme.abmindex.gallery');

		Route::get('lang','ABMLangController@lang')->name('switchlang');
	    Route::get('lang-close','ABMLangController@langClose')->name('switchlang_close');
    });
	// news
	Route::get('','ABMNewsController@index')->name('aboutme.abmnews.index');
	Route::get('{slug}-{id}','ABMNewsController@cat')->name('aboutme.abmnews.cat');
	Route::get('{slug}-{id}.html','ABMNewsController@detail')->name('aboutme.abmnews.detail');
	Route::get('tag/{slug}','ABMNewsController@tags')->name('aboutme.abmnews.tag');
	Route::get('search','ABMNewsController@search')->name('aboutme.abmnews.search');
	// contact
	Route::post('contact', 'ABMContactController@postContact')->name('aboutme.abmcontact.postContact');
	// dowload CV
	Route::get('cv_vi', 'ABMIndexController@cvvi')->name('aboutme.abmindex.cv_vi');
	Route::get('cv_en', 'ABMIndexController@cven')->name('aboutme.abmindex.cv_en');
});

// login admin
Route::namespace('Auth')->group(function (){
    // send mail register user
    Route::get('user/activation/{token}', 'RegisterController@activateUser')->name('user.activate');
});

//admin
Route::namespace('Admin')->middleware('auth')->prefix('admincp')->group(function (){
	Route::get('', 'ADIndexController@index')->name('admin.adindex.index');
	// myinfo
	Route::namespace('Myinfo')->middleware('abmauth:admin')->group(function (){
		// img
		Route::resource('img_admin','ADImgController');
		Route::prefix('img_admin')->get('add-pic/{id}','ADImgController@getAddPic')->name('img_admin.add_pic');
		Route::prefix('img_admin')->post('add-pic/{id}','ADImgController@postAddPic')->name('img_admin.add_pic');
		Route::prefix('img_admin')->post('delall','ADImgController@delall')->name('img_admin.delall');
		//intro
		Route::resource('intro_admin', 'ADIntroController')->only('index','edit','update');
		//skills
		Route::resource('skills_admin', 'ADSkillsController');
		//project
		Route::resource('project_admin', 'ADProjectController');
		//experiences
		Route::resource('experiences_admin', 'ADExperiencesController');
		//quotations
		Route::resource('quotations_admin', 'ADQuotationsController');
		//quotations
		Route::prefix('cv')->group(function (){
			Route::get('','ADCVController@index')->name('admin.admyinfo.cv.index');
			Route::get('readcv/{id}','ADCVController@readcv')->name('admin.admyinfo.cv.readcv');
			Route::post('edit/{id}','ADCVController@edit')->name('admin.admyinfo.cv.edit');
			Route::post('upload','ADCVController@upload')->name('admin.admyinfo.cv.upload');
		});
	});
	// news
	Route::namespace('News')->middleware('abmauth:admin')->group(function (){
		Route::resource('cat_admin','ADCatController');
		Route::resource('news_admin','ADNewsController');
		Route::prefix('news_admin')->post('destroy_all','ADNewsController@destroy_all')->name('news_admin.destroy_all');
		Route::resource('tags_admin','ADTagController');
		Route::resource('cmt_admin','ADCmtController')->only('index','destroy');
		Route::prefix('cmt_admin')->post('destroy_all','ADCmtController@delmore')->name('cmt_admin.delmore');
	});
	// contact
	Route::resource('contact_admin','Contact\ADContactController')->only('index','destroy');
	// users
	Route::namespace('ADUsers')->middleware('abmauth:admin')->group(function (){
        Route::get('index', 'ADIndexController@index')->name('admin.adusers.index.index');
        // users
        Route::resource('users_admin','ADUsersController');
        Route::prefix('users_admin')->post('delall','ADUsersController@delAll')->name('users_admin.dellall');
        Route::prefix('users_admin')->get('profile/{id}','ADUsersController@getProfile')->name('admin.adusers.users.profile');
        Route::prefix('users_admin')->post('profile/{id}','ADUsersController@postProfile')->name('admin.adusers.users.profile');
		// groups
		Route::resource('groups_admin','ADGroupsController');
	});
});

//FOR AJAX
Route::namespace('Ajax')->group(function (){
	Route::prefix('adintro')->middleware('auth')->group(function (){
		Route::get('confirm', 'ADIntroController@getConfirm')->name('admin.admyinfo.intro.confirm');
	});
	Route::prefix('adnews')->middleware('auth')->group(function (){
		Route::get('confirm', 'ADNewsController@getConfirm')->name('admin.adnews.news.confirm')->middleware('abmauth:admin');
	});
	Route::prefix('adcmt')->middleware('auth')->group(function (){
		Route::get('confirm', 'ADCmtController@getConfirm')->name('admin.adnews.cmt.confirm');
	});
	Route::prefix('abmcmt')->group(function (){
		Route::get('cmtnlog', 'ABMNewsController@cmtNlog')->name('aboutme.abmnews.cmtnlog');
		Route::get('cmtlog', 'ABMNewsController@cmtLog')->name('aboutme.abmnews.cmtlog');
		Route::get('cmtnlognnnn', 'ABMNewsController@cmtNlog2')->name('aboutme.abmnews.cmtnlognnnn');
		Route::get('cmtlog2', 'ABMNewsController@cmtLog2')->name('aboutme.abmnews.cmtlog2');
		Route::get('post', 'ABMNewsController@post')->name('ajax.news.post');
		Route::get('postcat', 'ABMNewsController@postcat')->name('ajax.news.postcat');
	});
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
});