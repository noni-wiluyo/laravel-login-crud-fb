<?php
// Home

Route::get('/',
	array(
		'as' => 'home',
		'uses' => 'HomeController@showWelcome'
	)
);
	
// get Add Article

Route::get('article/read/{id?}', 
	array(
		'uses' => 'ArticleController@readAddArticle'
		)
	);

// Unauthenticated group

Route::group(array('before' => 'guest'), function() {

	// CSRF protection group

	Route::group(array('before' => 'csrf'), function() {

		// Sign In post

		Route::post('account/sign-in',
			array(
				'as' => 'sign-in-post',
				'uses' => 'AccountController@postSignIn'
			)
		);

		// Sign Up post

		Route::post('account/sign-up',
			array(
				'as' => 'sign-up-post',
				'uses' => 'AccountController@postSignUp'
			)
		);

		// Forgot password post

		Route::post('account/forgot-password',
			array(
				'as' => 'forgot-password-post',
				'uses' => 'AccountController@postForgotPassword'
			)
		);

	});

	// Sign In

	Route::get('account/sign-in',
		array(
			'as' => 'sign-in',
			'uses' => 'AccountController@getSignIn'
		)
	);

	// Sign Up

	Route::get('account/sign-up',
		array(
			'as' => 'sign-up',
			'uses' => 'AccountController@getSignUp'
		)
	);


	// Forgot password

	Route::get('account/forgot-password',
		array(
			'as' => 'forgot-password',
			'uses' => 'AccountController@getForgotPassword'
		)
	);

	Route::get('login/fb', function() {
	    $facebook = new Facebook(Config::get('facebook'));
	    $params = array(
	        'redirect_uri' => url('/login/fb/callback'),
	        'scope' => 'email',
	    );
	    return Redirect::to($facebook->getLoginUrl($params));
	});


	Route::get('login/fb/callback', function() {
	    $code = Input::get('code');
	    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

	    $facebook = new Facebook(Config::get('facebook'));
	    $uid = $facebook->getUser();

	    if ($uid == 0) return Redirect::to('/')->with('error', 'There was an error');

	    $me = $facebook->api('/me');

	    $user = User::where('facebook_id', '=', $me['id']);
		$user = $user->first();
	    if (!$user) {
			$user = array(
				'name' => $me['name'],
				'email' => $me['email'],
				'facebook_id' => $me['id']
			);			
			User::create($user);
	    }

	    $user = User::where('facebook_id', '=', $me['id']);
		$user = $user->first();
	    // print_r($user);
	    Auth::login($user);

	    return Redirect::route('home');
	});
});

// Authenticated group

Route::group(array('before' => 'auth'), function() {

	// CSRF protection group

	Route::group(array('before' => 'csrf'), function() {

		// Change password post

		Route::post('account/change-password',
			array(
				'as' => 'change-password-post',
				'uses' => 'AccountController@postChangePassword'
			)
		);

	});

	// Sign Out

	Route::get('account/sign-out',
		array (
			'as' => 'sign-out',
			'uses' => 'AccountController@getSignOut'
		)
	);

	// Change password

	Route::get('account/change-password',
		array(
			'as' => 'change-password',
			'uses' => 'AccountController@getChangePassword'
		)
	);

	
	// get Add Article

	Route::get('article/add',
		array(
			'as' => 'add',
			'uses' => 'ArticleController@getAddArticle'
		)
	);

	// Post Add Article

	Route::post('article/add',
		array(
			'as' => 'add-post',
			'uses' => 'ArticleController@postAddArticle'
		)
	);
	
	// get Add Article

	Route::get('article/edit/{id?}',
		array(
			'uses' => 'ArticleController@getEditArticle'
		)
	);

	// Post Add Article

	Route::post('article/edit/{id?}',
		array(
			'uses' => 'ArticleController@postEditArticle'
		)
	);

	// Post Add Article

	Route::get('article/delete/{id?}',
		array(
			'uses' => 'ArticleController@destroyArticle'
		)
	);
});

App::error(function($exception, $code)
{
    switch ($code)
    {
        case 403:
            return Response::view('errors.403', array(), 403);

        case 404:
            return Response::view('errors.404', array(), 404);

        case 500:
            return Response::view('errors.500', array(), 500);

        default:
            return Response::view('errors.default', array(), $code);
    }
});