<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
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


    public function remove($id)
    {
        $post = Post::find($id);
        if ($post) {
            $user = auth()->user();

            if ($post->user_id == $user->id) {
                $post->delete();
                return ["message" => "Post removed !"];
            } else {
                return response()->json([
                    'errors' =>
                    ["you are not allowed to remove this post !"]
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'errors' =>
                ["post not found !"]
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function toggleLike($id)
    {
        try {
            $post = Post::find($id);
            if ($post) {
                $user = auth()->user();
                $findLike =  $post->likes->where('user_id', $user->id)->where('post_id', $id)->first();
                if ($findLike) {
                    Like::where('user_id', $user->id)->where('post_id', $id)->first()->delete();
                    return Post::find($id)->likes;
                } else {
                    Like::create([
                        "user_id" => $user->id,
                        "post_id" => $id,
                    ]);
                    return Post::find($id)->likes;
                }
            } else {
                return response()->json([
                    'errors' =>
                    ["post not found !"]
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => [$th->getMessage()]
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function addComment(Request $request, $id)
    {
        try {
            $post = Post::find($id);
            if ($post) {
                $user = auth()->user();
                Comment::create([
                    "user_id" => $user->id,
                    "post_id" => $post->id,
                    "content" => $request->input('content'),
                ]);

                return Post::find($id)->comments;
            } else {
                return response()->json([
                    'errors' =>
                    ["post not found !"]
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => [$th->getMessage()]
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function removeComment($idPost, $idComment)
    {
        try {
            $post = Post::find($idPost);
            if ($post) {
                $user = auth()->user();
                $findComment =  $post->comments->where('id', $idComment)
                    ->where('user_id', $user->id)
                    ->first();

                if ($findComment) {
                    Comment::find($idComment)->delete();
                    return Post::find($idPost)->comments;
                } else {
                    return response()->json([
                        'errors' =>
                        ["you are not allowed to remove this comment !"]
                    ], Response::HTTP_BAD_REQUEST);
                }
            } else {
                return response()->json([
                    'errors' =>
                    ["post not found !"]
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => [$th->getMessage()]
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
