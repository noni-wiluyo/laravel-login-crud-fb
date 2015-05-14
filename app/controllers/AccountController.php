<?php

class AccountController extends BaseController {

	public function postSignUp() {
		$valid = Validator::make(Input::all(),
			array(
				'name' => 'required|max:50',
				'email' => 'required|max:50|email|unique:users',
				'password' => 'required|min:5',
				'password_again' => 'required|same:password',
			)
		);

		if($valid->fails()) {
			return Redirect::route('sign-up')->withErrors($valid)->withInput();
		}
		
		$name = Input::get('name');
		$email = Input::get('email');
		$password = Input::get('password');

		$code = str_random(60);

		$user = User::create(array(
			'name' => $name,
			'email' => $email,
			'password' => Hash::make($password)
		));

		if($user) {
			return Redirect::route('sign-up')->with('success', true);
		}
		return Redirect::route('sign-up')->with('unex-error', true)->withInput();
	}



	public function postSignIn() {

		$valid = Validator::make(Input::all(),
			array(
				'email' => 'required|email',
				'password' => 'required'
			)
		);

		if(!$valid->fails()) {
			$user = User::where('email', '=', Input::get('email'));
			
			if($user->count()) {
				$user = $user->first();
				if(Hash::check(Input::get('password'), $user->password)) {
						Auth::login($user);
						if($user->password_temp != '') {
							return Redirect::route('change-password')->with('warning', true);
						}
						return Redirect::intended('/');
				}
				else {
					return Redirect::route('sign-in')->withInput()->with('error', 'invalid-account');
				}
			}
			return Redirect::route('sign-in')->withInput()->with('error', 'account-doesnt-exist');
		}
		
		return Redirect::route('sign-in')->withInput()->with('error', 'invalid-account');
	}




	public function postChangePassword() {
		if(Auth::user()->facebook_id == NULL)
			Redirect::route('home');

		$valid = Validator::make(Input::all(), array(
			'old_password' => 'required',
			'password' => 'required|min:5|different:old_password',
			'password_again' => 'required|same:password'
		));

		if($valid->passes()) {
			$user = Auth::user();

			if(Hash::check(Input::get('old_password'), $user->password)) {

				$user->password = Hash::make(Input::get('password'));
				$user->password_temp = '';

				if($user->save()) {
					return Redirect::route('change-password')->with('success', true);
				}

				return Redirect::route('change-password')->with('error', true);
			}

			return Redirect::route('change-password')->withErrors(array('old_password' => 'Incorrect current password'));
		}

		return Redirect::route('change-password')->withErrors($valid);
	}
	


	public function getSignIn() {
		return View::make('signin');
	}



	public function getSignUp() {
		return View::make('signup');
	}



	public function getActivateAccount($code) {
		$user = User::where('code', '=', $code)->where('active', '=', 0);
		if($user->count()) {
			$user = $user->first();
			$user->active = 1;
			$user->code = '';

			if($user->save()) {
				return Redirect::route('sign-in')->with('success', true);
			}
			return Redirect::route('sign-in')->with('error', 'unactive-account');
		}
		return App::abort(404);
	}



	public function getSignOut() {
		Auth::logout();
		return Redirect::route('home');
	}



	public function getChangePassword() {
		if(Auth::user()->facebook_id == NULL)
			Redirect::route('home');

		return View::make('changepassword');
	}
}