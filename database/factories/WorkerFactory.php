<?php

namespace Database\Factories;

use App\Models\Worker;
use App\Models\User;

use Illuminate\Support\Facades\Hash;


use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Worker::class;

    private  $fee = array(500,600,700,1000);
    private  $experience = array('2-3 years','4-5 years','5-6 years');
    private  $expertField =  array('Electronics & Gadgets Repair',
    'Plumber','Home Cleaner','Pest Controller','Painter',
    'House Shifting','Electrician','Appliance Repair','Service Seeker');
    private  $aboutme =  array('Oedient','Loving','Punctual');
    private  $address =  array('Naria,Shariatpur','Shariatpur Sadar,Shariatpur','Jajira,Shariatpur','Damudda,Shariatpur','Bhedorgonj,Shariatpur');
    private $name=array('KAMRUL HASAN VULU','RABBY AHMED','MOHAMMAD IMTIAZ');
    private $email=array('kamrulhasanvulu@gmail.com','mdrabbybd977@gmail.com','imtiazhasan48@gmail.com');
    private $gpsLoc=array(array(23.256883561301724, 90.36690725632201),array(23.25674036906484, 90.29270158573827),array(23.26349979816383, 90.28500684260364));

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
                    'role' => 'worker',
                    'name' => $name,
                    'profileUpdated'=>true,
                    'email' => $email,
                    'user_identity'=>crc32($email.' '.time()),
                ];
            }),
            'perHourFee'=>$this->fee[rand(0,sizeof($this->fee)-1)],
            'experience'=>$this->experience[rand(0,sizeof($this->experience)-1)],
            'expertField'=>$this->expertField[rand(0,sizeof($this->expertField)-1)],
            'aboutme'=>$this->aboutme[rand(0,sizeof($this->aboutme)-1)],
            'address'=>$this->address[rand(0,sizeof($this->address)-1)],
            'latitude'=>$this->gpsLoc[rand(0,sizeof($this->gpsLoc)-1)][0],
            'longitude'=>$this->gpsLoc[rand(0,sizeof($this->gpsLoc)-1)][1],
            'mobileNumber'=>'+8801'.random_int(5,9).''.random_int(10000000, 99999999)
        ];
    }
}
