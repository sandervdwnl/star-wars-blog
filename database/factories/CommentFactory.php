<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;



class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // create array with all post id's
        $posts = Post::all()->pluck('id')->toArray();

        //loop through arr array and return random post_id
        $post_id = $this->faker->randomElement($posts);

        return [
            //
            'post_id'=> $post_id,
            'author' => $this->faker->name(),
            'comment' => $this->faker->realText(150),
            'approved' => 0,
        ];
    }
}
