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
        
        return [
            //selects a random post->id
            'post_id'=> Post::all()->random()->id,
            'author' => $this->faker->name(),
            'comment' => $this->faker->realText(150),
            'approved' => 0,
        ];
    }
}
