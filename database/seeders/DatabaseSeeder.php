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
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "id" => 1,
                'name' => 'Jhon Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('123456'),
            ],
            [
                "id" => 2,
                'name' => 'Steve Smith',
                'email' => 'steve@example.com',
                'password' => Hash::make('123456'),
            ],
            [
                "id" => 3,
                'name' => 'Richard Roe',
                'email' => 'richard@example.com',
                'password' => Hash::make('123456'),
            ]
        ];

        $posts = [
            [
                "id" => 1,
                "user_id" => $users[0]['id'],
                "content" =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed voluptates ipsa eveniet non, reiciendis culpa vero voluptatibus cupiditate debitis incidunt inventore molestias pariatur? Corrupti aperiam hic maxime, sunt id labore?'
            ],
            [
                "id" => 2,
                "user_id" => $users[1]['id'],
                "content" =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed voluptates ipsa eveniet non, reiciendis culpa vero voluptatibus cupiditate debitis incidunt inventore molestias pariatur? Corrupti aperiam hic maxime, sunt id labore?'
            ],
            [
                "id" => 3,
                "user_id" => $users[2]['id'],
                "content" =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed voluptates ipsa eveniet non, reiciendis culpa vero voluptatibus cupiditate debitis incidunt inventore molestias pariatur? Corrupti aperiam hic maxime, sunt id labore?'
            ],
        ];

        $likes = [
            // post 1 :
            [
                "id" => 1,
                "user_id" => $users[0]['id'],
                "post_id" => $posts[0]['id'],
            ],
            [
                "id" => 2,
                "user_id" => $users[1]['id'],
                "post_id" => $posts[0]['id'],
            ],
            [
                "id" => 3,
                "user_id" => $users[2]['id'],
                "post_id" => $posts[0]['id'],
            ],
            // post 2 :
            [
                "id" => 4,
                "user_id" => $users[0]['id'],
                "post_id" => $posts[1]['id'],
            ],
            [
                "id" => 5,
                "user_id" => $users[1]['id'],
                "post_id" => $posts[1]['id'],
            ],
            // post 3 :
            [
                "id" => 5,
                "user_id" => $users[0]['id'],
                "post_id" => $posts[2]['id'],
            ],
            [
                "id" => 6,
                "user_id" => $users[1]['id'],
                "post_id" => $posts[2]['id'],
            ],
        ];

        $comments = [
            // post 1 :
            [
                "id" => 1,
                "user_id" => $users[0]['id'],
                "post_id" => $posts[0]['id'],
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
            ],
            [
                "id" => 2,
                "user_id" => $users[1]['id'],
                "post_id" => $posts[0]['id'],
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
            ],
            [
                "id" => 3,
                "user_id" => $users[2]['id'],
                "post_id" => $posts[0]['id'],
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
            ],
            // post 2 :
            [
                "id" => 4,
                "user_id" => $users[0]['id'],
                "post_id" => $posts[1]['id'],
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
            ],
            [
                "id" => 5,
                "user_id" => $users[1]['id'],
                "post_id" => $posts[1]['id'],
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
            ],
            // post 3 :
            [
                "id" => 5,
                "user_id" => $users[0]['id'],
                "post_id" => $posts[2]['id'],
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
            ],
            [
                "id" => 6,
                "user_id" => $users[1]['id'],
                "post_id" => $posts[2]['id'],
                "content" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat, natus!",
            ],
        ];

        User::insert($users);
        Post::insert($posts);
        Like::insert($likes);
        Comment::insert($comments);
    }
}
