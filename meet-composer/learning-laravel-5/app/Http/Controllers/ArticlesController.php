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

	/*Create a new articles controller instance.*/

	public function __construct() {

		$this->middleware('auth', ['except' => 'index', 'show']);

	}

	public function index() {

		$articles = Article::latest('published_at')->published()->get();
		$latest = Article::latest()->first();

		return view('articles.index', compact('articles', 'latest'));

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

		$this->createArticle($request);

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


	public function update(ArticleRequest $request, Article $article) {

		//$article = Article::findOrFail($id);

		$article->update($request->all());

		$this->syncTags($article, $request->input('tag_list'));

		return redirect('articles');

	}

	/**
	* Sync up the list of tags in the database.
	*
	* @param Article $article
	* @param array $tags
	*/

	private function syncTags(Article $article, array $tags) {

		$article->tags()->sync($tags);

	}

	/**
	* Save a new article.
	*
	* @param ArticleRequest $request
	* @return mixed
	*/

	private function createArticle(ArticleRequest $request) {
		$article = Auth::user()->articles()->create($request->all());

		$this->syncTags($article, $request->input('tag_list'));

		return $article;
	}

}
