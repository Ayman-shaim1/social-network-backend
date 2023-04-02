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
        try {
            return Post::with('user', 'likes', 'comments')->orderBy('created_at', 'desc')->get();
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => [$th->getMessage()]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function find($id)
    {
        try {

            $post =  Post::find($id);

            if ($post) {
                return Post::with('user', 'likes', 'comments.user')->find($id);
            } else {
                return response()->json([
                    'errors' =>
                    ["post not found !"]
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => [$th->getMessage()]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content' => 'required',
            ], [
                'content.required' => 'Please provide a content text for creating a  post.',
            ]);


            $errors = $validator->errors()->toArray();;

            $errors = array_map(function ($messages) {
                return $messages[0];
            }, array_values($errors));


            if ($validator->fails()) {
                return response()->json([
                    'errors' => $errors,
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            if ($validator->fails()) {
                return response()->json([
                    'errors' =>  $errors,
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $user = auth()->user();

            $createdPost = Post::create([
                "user_id" => $user->id,
                "content" => $request->input('content'),
            ]);

            return response()->json([
                "user_id" =>  $user->id,
                "content" =>  $createdPost->content,
                "updated_at" =>  $createdPost->updated_at,
                "created_at" =>  $createdPost->created_at,
                "id" =>  $createdPost->id,
                "user" => $user,
                "likes" => [],
                "comments" => [],
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => [$th->getMessage()]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function remove($id)
    {
        try {
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
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => [$th->getMessage()]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
