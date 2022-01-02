<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use File;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Article::all();
        return view('admin.articles.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::get();
        return view('admin.articles.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get('action') == 'save') {
            $data=[
                'ar_name' => $request->get('ar_name'),
                'en_name' => $request->get('en_name'),

            ];
            $tag = Tag::create($data);

            return redirect()->back()->withInput();
        }elseif ($request->get('action') == 'confirm') {
            $values=[
 'ar_title' => $request->get('ar_title'),
 'en_title' => $request->get('en_title'),
 'ar_text' => $request->get('ar_text'),
 'en_text' => $request->get('en_text'),
            ];
        }
        if ($request->hasFile('img')) {
            $attach_image = $request->file('img');

            $values['img'] = $this->UplaodImage($attach_image);

        }
        $article = Article::create($values);
        $article->tag()->sync((array) $request->input('tag'));
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::get();
        $row = Article::findOrFail($id);
        $selectTags=$row->tag->pluck('id','id')->all();
        return view('admin.articles.edit', compact('row', 'tags','selectTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $values=[
            'ar_title' => $request->get('ar_title'),
            'en_title' => $request->get('en_title'),
            'ar_text' => $request->get('ar_text'),
            'en_text' => $request->get('en_text'),
                       ];

                   if ($request->hasFile('img')) {
                       $attach_image = $request->file('img');

                       $values['img'] = $this->UplaodImage($attach_image);

                   }
                //    dd($values);
        $article->update($values);
        $article->tag()->sync((array)$request->input('tag'));
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $file = $article->img;

        $file_name = public_path('uploads/blogs/' . $file);
        try {
            $article->delete();
            File::delete($file_name);

        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger','هذا المنتج مرتبط بجدول اخر');

        }
            return redirect()->route($this->routeName.'index')->with('flash_success', ' تم الحذف بنجاح!');

    }

    public function articlesTag(Request $request){
        $tag = Tag::create($request->all());
        // $article->tag()->sync((array) $request->input('tag'));
        // return redirect()->route('articles.create');
        // return redirect()->back()->withInput($request->all());
        return redirect()->back()->withInput()->with('flash_danger', "xx");
    }


     /* uplaud image
     */
    public function UplaodImage($file_request)
    {
        //  This is Image Info..
        $file = $file_request;
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $path = $file->getRealPath();
        $mime = $file->getMimeType();
        // Rename The Image ..
        $imageName = $name;
        $uploadPath = public_path('uploads/blogs');

        // Move The image..
        $file->move($uploadPath, $imageName);

        return $imageName;
    }
}
