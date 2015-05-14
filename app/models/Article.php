<?php

class Article extends Eloquent {

	protected $fillable = array('id', 'title', 'text', 'userid');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'articles';

}