<?php

class ArticleController extends \BaseController {

	public function getAddArticle(){
		return View::make('addarticle');
	}

	public function postAddArticle() {
		$valid = Validator::make(Input::all(),
			array(
				'title' => 'required||unique:articles',
				'text' => 'required',
			)
		);

		if($valid->fails()) {
			return Redirect::route('add')->withErrors($valid)->withInput();
		}
		
		$title = Input::get('title');
		$text = Input::get('text');

		$article = Article::create(array(
			'title' => $title,
			'text' => $text,
			'userid' => Auth::id(),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		));

		if($article) {
			return Redirect::route('home')->with('success', 'Your article has been submited successfully.');
		}
		return Redirect::route('add')->with('unex-error', true)->withInput();
	}

	public function readAddArticle($id){
		$article = Article::where('id', '=', $id);
		$article = $article->first();
		$user = User::where('id', '=', $article->userid);
		$user = $user->first();
		$article->username = $user->name;
		return View::make('read')
            ->with('article', $article);
	}

	public function getEditArticle($id = 0){
		$article = Article::where('id', '=', $id);
		$article = $article->first();

		if(Auth::id() != $article->userid)
			return Redirect::route('home');

		$user = User::where('id', '=', $article->userid);
		$user = $user->first();
		$article->username = $user->name;
		return View::make('editarticle')
            ->with('article', $article);
	}

	public function postEditArticle($id = 0) {
		$article = Article::where('id', '=', $id);
		$article = $article->first();

		if(Auth::id() != $article->userid)
			return Redirect::route('home');

		$valid = Validator::make(Input::all(),
			array(
				'title' => 'required',
				'text' => 'required',
			)
		);

		if($valid->fails()) {
			return Redirect::to('article/edit/'.$id)->withErrors($valid)->withInput();
		}
		
		$title = Input::get('title');
		$text = Input::get('text');

        $article = Article::where('id', $id)->update(array(
			'title' => $title,
			'text' => $text,
			'updated_at' => date("Y-m-d H:i:s")
        ));

		if($article) {
			return Redirect::route('home')->with('success', 'Your article has been updated successfully.');
		}
		return Redirect::to('article/edit/'.$id)->with('unex-error', true)->withInput();
	}

	public function destroyArticle($id = 0) {
		if($id == 0)
			return Redirect::route('home');

	    $article = Article::find($id);

		if(!$article || Auth::id() != $article->userid)
			return Redirect::route('home')->with('error', 'The data you trying to delete is not exist or you are not the author!');

	    $article->delete();
		return Redirect::route('home')->with('success', 'Your article has been deleted successfully.');
	}


}
