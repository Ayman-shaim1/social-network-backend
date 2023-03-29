<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        $users = [
            [
                "id" => 1,
                'name' => 'Jhon Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('123456'),
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),

            ],
            [
                "id" => 2,
                'name' => 'Steve Smith',
                'email' => 'steve@example.com',
                'password' => Hash::make('123456'),
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 3,
                'name' => 'Richard Roe',
                'email' => 'richard@example.com',
                'password' => Hash::make('123456'),
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ]
        ];

        $posts = [
            [
                "id" => 1,
                "user_id" => 1,
                "content" =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed voluptates ipsa eveniet non, reiciendis culpa vero voluptatibus cupiditate debitis incidunt inventore molestias pariatur? Corrupti aperiam hic maxime, sunt id labore?',
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 2,
                "user_id" => 2,
                "content" =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed voluptates ipsa eveniet non, reiciendis culpa vero voluptatibus cupiditate debitis incidunt inventore molestias pariatur? Corrupti aperiam hic maxime, sunt id labore?',
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 3,
                "user_id" => 3,
                "content" =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed voluptates ipsa eveniet non, reiciendis culpa vero voluptatibus cupiditate debitis incidunt inventore molestias pariatur? Corrupti aperiam hic maxime, sunt id labore?',
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
        ];

        $likes = [
            // post 1 :
            [
                "id" => 1,
                "user_id" => 1,
                "post_id" => 1,
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 2,
                "user_id" => 2,
                "post_id" => 1,
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 3,
                "user_id" => 3,
                "post_id" => 1,
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            // post 2 :
            [
                "id" => 4,
                "user_id" => 1,
                "post_id" => 2,
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 5,
                "user_id" => 2,
                "post_id" => 2,
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            // post 3 :
            [
                "id" => 6,
                "user_id" => 1,
                "post_id" => 3,
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 7,
                "user_id" => 2,
                "post_id" => 3,
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
        ];

        $comments = [
            // post 1 :
            [
                "id" => 1,
                "user_id" => 1,
                "post_id" => 1,
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 2,
                "user_id" => 2,
                "post_id" => 1,
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 3,
                "user_id" => 3,
                "post_id" => 1,
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            // post 2 :
            [
                "id" => 4,
                "user_id" => 1,
                "post_id" => 2,
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 5,
                "user_id" => 2,
                "post_id" => 2,
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            // post 3 :
            [
                "id" => 6,
                "user_id" => 1,
                "post_id" => 3,
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
            [
                "id" => 7,
                "user_id" => 2,
                "post_id" => 3,
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
                "created_at" =>  date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ],
        ];

        User::insert($users);
        Post::insert($posts);
        Like::insert($likes);
        Comment::insert($comments);
    }

    // public function run()
    // {
    //     Comment::truncate();
    //     Post::truncate();
    //     Like::truncate();
    //     User::truncate();
    // }
}
