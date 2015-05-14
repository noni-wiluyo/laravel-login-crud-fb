<?php

class HomeController extends BaseController {

	public function showWelcome() {
		$article = Article::all();
		foreach ($article as $key => $value) {
			$user = User::where('id', '=', $value->userid);
			$user = $user->first();
			$value->username = $user->name;
		}
		$data['articles'] = $article;
		return View::make('home', $data);
	}

}