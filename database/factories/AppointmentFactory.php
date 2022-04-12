<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Worker;
use App\Models\Client;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'worker_id' => Worker::factory(),
            'client_id'=> Client::factory(),
            'fee'=> 570.80,
            'appointmentDate'=>$this->faker->dateTimeBetween('+1 week', '+1 month')
        ];
    }
}
