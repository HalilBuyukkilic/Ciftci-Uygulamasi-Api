<?php

namespace App\Http\Controllers\UI\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Http\Resources\UI\Blog\BlogCollection;
use App\Models\Blog\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blog = Blog::query();
        if (isset($request->bolge))
        {
            if ($request->bolge == 2)
            {
                $blog->where('bolge', 2)->orderBy('created_at', 'desc')->limit($request->limit);
            }
            else if ($request->bolge == 3 || $request->bolge == 4 || $request->bolge == 5 || $request->bolge == 6)
            {
                $blog->where('bolge', 3)->orWhere('bolge', 4)->orWhere('bolge', 5)->orWhere('bolge', 6);
            }
            else
            {
                $blog->where('bolge', $request->bolge);
            }
        }
        else
        {
            $blog->where('slug', $request->slug);
        }

        return response()->json(['data' => new BlogCollection($blog->get())]);
    }

}
