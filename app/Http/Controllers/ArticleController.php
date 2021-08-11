<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('categories')->orderByDesc('updated_at')->paginate(10);

        return view('articles.list', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('articles.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->upsert($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::all();

        return view('articles.create', [
            'article' => $article,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        return $this->upsert($request->all(), $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Export articles that have a minimum 2 categories attached
     */
    public function export(Request $request)
    {
        $articles = Article::with('categories')->has('categories', '>=', 2)->orderByDesc('updated_at')->get();

        return response()->json( $articles );
    }

    /**
     * Display import
     */
    public function import()
    {
        return view('articles.import');
    }

    /**
     * Import CSV
     *
     * @return \Illuminate\Http\Response
     */
    public function importUpload(Request $request)
    {
        // Validate data
        $validator = Validator::make( $request->all(), [
            'file' => 'required|file|max:1024|mimes:csv,txt',
        ] );

        if ( $validator->fails() ) {
            return view('articles.import')->withErrors($validator->messages());
        }

        // Read data
        $path = $request->file('file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        if ( empty( $data ) ) {
            return view('articles.import')->withErrors('Empty or Invalid CSV');
        }

        // Upsert articles
        foreach( $data as $article ) {
            if ( empty( $article[0] ) || empty( $article[1] ) ) {
                continue;
            }

            $this->upsert(
                [
                    'title' => $article[0],
                    'text' => $article[1],
                    'categories' => $article[2],
                ]
            );
        }

        return view('articles.import', [
            'success' => 'Import successfull'
        ]);
    }

    /**
     * Update or Create an article
     * In this particular case we won't have duplicate code
     */
    protected function upsert(array $data, $article = null)
    {
        // Validate data
        $validator = Validator::make( $data, [
            'title' => 'required|string',
            'text' => 'required|string',
            'categories' => 'nullable|string',
        ] );

        if ( $validator->fails() ) {
            return response()->json( [], 422 );
        }

        // Upsert article
        if ( empty( $article ) ) {
            // Create article
            $article = Article::create([
                'user_id' => 1,
                'title' => $data['title'],
                'text' => $data['text'],
            ]);
        } else {
            // Update article
            $article->title = $data['title'];
            $article->text = $data['text'];
            $article->save();
        }

        // Sync categories
        if ( ! empty( $categories = $data['categories'] ) ) {
            $categories = explode(',', $categories);

            // Validate categories
            $categories = Category::whereIn('id', $categories)->get()->pluck('id')->toArray();

            if ( ! empty( $categories ) ) {
                $article->categories()->sync($categories);
            }
        } else {
            $article->categories()->detach();
        }

        // Return
        return response()->json( [] );
    }
}
