<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imgName = $this->faker->image(storage_path("app/public/uploads/products"), $width = 640, $height = 480, 'cats', false);
        return [
            'room_no' => $this->faker->name,
            'floor' => rand(1,5),
            'image' => "uploads/products/" . $imgName,
            'detail' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'price' => rand(100,500),
        ];
    }
}
