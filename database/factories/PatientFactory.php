<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;
    /**
     * Define the model's default state.
     

     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname'=> $this->faker->firstName(),
            'midname'=> $this->faker->firstName(),
            'lastname'=> $this->faker->lastName(),
            'dob'=> $this->faker->date(),
            'insurance'=> $this->faker->randomElement(['NSSF', 'Hay2a','ISF','Lebanese army','Coop','Private']),
            'gender'=> $this->faker->randomElement(['male','female']),
            'bloodtype'=> $this->faker->randomElement(['A+','B+','O+','AB+','A-','B-','O-','AB-']),
            'diag'=> $this->faker->text(50),
            'address'=> $this->faker->address(),
            'number'=> $this->faker->phoneNumber(),
            'maincomplaint'=> $this->faker->text(25),
            'pathological_story'=> $this->faker->text(75),
        ];
    }
}
