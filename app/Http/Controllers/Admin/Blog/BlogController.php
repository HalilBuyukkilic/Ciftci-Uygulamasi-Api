<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Http\Resources\UI\Blog\BlogCollection;
use App\Http\Resources\UI\Blog\BlogResource;
use App\Models\Blog\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return response()->json(['data' => new BlogCollection(Blog::get())]);
    }

    public function store(StoreBlogRequest $request)
    {
        $data = $request->all();
        if ($request->file('gorsel'))
        {
            $custom_file_name = time().'-'.$request->file('gorsel')->getClientOriginalName();
            $request->file('gorsel')->storeAs('public/blog-gorsel', $custom_file_name);
        }
        $data['gorsel'] = isset($custom_file_name) ? url('storage/blog-gorsel/' . $custom_file_name) : null;
        if (Blog::create($data))
        {
            return response()->json(['status' => true], 201);
        }
        else
        {
            return response()->json(['status' => false], 400);
        }
    }

    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }

    public function update(UpdateBlogRequest $request)
    {

    }
}
