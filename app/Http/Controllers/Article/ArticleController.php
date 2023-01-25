<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index()
    {
        $data = Article::latest()->paginate(5);

        return view('articles.index', ['articles' => $data]);
    }

    public function detail($id)
    {
        $data = Article::find($id);

        return view('articles.detail', ['article' => $data]);
    }

    public function add()
    {
        $data = Category::all();

        return view('articles.add', ['categories' => $data]);
    }

    public function create()
    {
        $validator = validator(request()->all(), ['title' => 'required', 'body' => 'required', 'category_id' => 'required',]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/articles');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        
        if(Gate::allows('article-delete', $article)) {
            $article->delete();
            return redirect('/articles')->with('info', 'Article deleted');
        } else {
            return back()->with('info', 'Unauthorize to delete article');
        }        
    }

    public function edit($id)
    {
        $data = Article::find($id);
        $categories = Category::all();
        
        return view('articles.edit', ['article' => $data, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->category_id = $request->input('category_id');
        
        if(Gate::allows('article-edit', $article)) {
            $article->update();
            return redirect('/articles')->with('info', 'Article was edited');
        } else {
            return redirect('/articles')->with('info', 'Unauthorize to edit article');
        }        
    }
}
