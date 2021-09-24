<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $birth = mktime(null, null, null, rand(1, 12), rand(1, 28), rand(1972, 2006));

        return [
            'family_status_id' => 1, //1 kepala keluarga, 3 istri
            'sex_id' => 1, //perempuan
            'blood_group_id' => rand(1, 8),
            'religion_id' => rand(1, 7),
            'marital_status_id' => 2, //kawin tercatat
            'educational_id' => rand(1, 10),
            'name' => $this->faker->name('male'),
            'place_of_birth' => 'Kebumen',
            'date_of_birth' => date('Y-m-d', $birth),
            'rw' => rand(1, 3),
            'rt' => rand(1, 5),
            'is_cacat' => 0,
        ];
    }
}
