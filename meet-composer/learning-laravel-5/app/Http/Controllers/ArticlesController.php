<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

class ArticlesController extends Controller {

	public function __construct() {

		$this->middleware('auth', ['except' => 'index']);

	}

	public function index() {

		$articles = Article::latest('published_at')->published()->get();

		return view('articles.index', compact('articles'));

	}

	/**
	* Show a single article.
	*
	* @param Article $article
	* @return Response
	*/


	public function show(Article $article) {

		return view('articles.show', compact('article'));

	}


	public function create() {

		return view('articles.create');

	}


	/**
	 * Save a new article.
	 *
	 * @param ArticleRequest $request
	 * @return Response
	 */

	public function store(ArticleRequest $request) {


		Auth::user()->articles()->create($request->all());

		//flash()->success('Your article has been created');

		flash()->overlay('Your article has been successfully created!', 'Good Job');

		return redirect('articles');

	}

	/**
	* Edit a single article.
	*
	* @param Article $article
	* @return Response
	*/

	public function edit(Article $article) {

		$article = Article::findOrFail($id);

		return view('articles.edit', compact('article'));

	}

	/**
	* Update a single article.
	*
	* @param Article $article
	* @param ArticleRequest $request
	* @return Response
	*/


	public function update(Article $article, ArticleRequest $request) {

		$article = Article::findOrFail($id);

		$article->update($request->all());

		return redirect('articles');

	}

}
