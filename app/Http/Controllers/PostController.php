<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{


    public function index()
    {
        return Post::all();
    }


    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'content' => 'required',

        ], [
            'content.required' => 'Please provide a content text for creating a  post.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = auth()->user();

        return Post::create([
            "user_id" => $user->id,
            "content" => $request->input('content'),
        ]);
    }


    public function remove()
    {
    }

    public function toggleLike()
    {
    }

    public function addComment()
    {
    }

    public function removeComment()
    {
    }
}
