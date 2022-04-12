<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;


class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    private $sexArray = array('Male','Female');
    private  $address =  array('Naria,Shariatpur','Shariatpur Sadar,Shariatpur','Jajira,Shariatpur','Damudda,Shariatpur','Bhedorgonj,Shariatpur');
    private $name=array('Rakib Hossain','Md.Juwel','Md. Mohiuddin Islam');
    private $email=array('rakibhosssain9@gmail.com',' juwelmahmud2000720@gmail.com','mdmohiuddinislam703@gmail.com');

    /**
     * Define the model's default state.
     *
     * @return array
     */
    private static $indx=0;

    public function definition()
    {
        $name = $this->name[self::$indx];
        $email =  $this->email[self::$indx];
        self::$indx++;
        if(self::$indx > sizeof($this->name)-1){
            self::$indx=0;
        }

        return [
            'user_id'=>User::factory()->state(function (array $attributes) use($name,$email) {
                return [
                    'role' => 'client',
                    'name' => $name,
                    'profileUpdated'=>true,
                    'email' => $email,
                    'user_identity'=>crc32($email.' '.time()),

                ];
            }),
            'dateOfBirth'=>$this->faker->dateTimeBetween('1990-01-01', '2012-12-31'),
            'sex'=>$this->sexArray[rand(0,sizeof($this->sexArray)-1)],
            'address'=>$this->address[rand(0,sizeof($this->address)-1)],
            'mobileNumber'=>'+8801'.random_int(5,9).''.random_int(10000000, 99999999)
        ];
    }
}
