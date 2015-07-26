<?php namespace App\Http\Controllers;

use App\Article;
use App\Tag;
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

		$tags = Tag::lists('name', 'id');
		return view('articles.create', compact('tags'));

	}


	/**
	 * Save a new article.
	 *
	 * @param ArticleRequest $request
	 * @return Response
	 */

	public function store(ArticleRequest $request) {

		$article = Auth::user()->articles()->create($request->all());

		$article->tags()->attach($request->input('tag_list'));

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

		//$article = Article::findOrFail($id);

		$tags = Tag::lists('name', 'id');

		return view('articles.edit', compact('article', 'tags'));

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
