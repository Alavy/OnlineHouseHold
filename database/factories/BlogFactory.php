<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Blog;
use App\Models\Worker;
use App\Models\Client;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'header' => "Electronics & Gadgets Repair",
            'body'=>"there will be mainly available 3 types of service. They are:
            •	Desktop Service
            •	Laptop Service
            •	AC servicing
            
            From Desktop service they can choose:
            a)	Hardware Related Services
            b)	Software Related Services
            
            In Hardware Related Services, there will be available Motherboard installation, motherboard repair, HDD or SSD installation or replacement, Power Supply, Diagnosis, Power Supply Unit Installation services.
            In Software Related Services, there will be available Driver Installation, Software Installation, Application Installation, Operating System installation, Data Recovery, Diagnosis, BIOS Configuring Updating services.
            
            From Laptop Service they can choose:
            a)	Hardware Related Services
            b)	Software Related Services
            
            In Hardware Related Services, there will be available Motherboard installation, motherboard repair, HDD or SSD installation or replacement, Power Supply, Diagnosis, Power Supply Unit Installation services.
            In Software Related Services, there will be available Driver Installation, Software Installation, Application Installation, Operating System installation, Data Recovery, Diagnosis, BIOS Configuring Updating services.
            
            
        
            From AC servicing they can choose:
            a)	AC Servicing
            b)	AC Installation & Un-installation
            
            In AC Servicing, there will be available AC Basic Service, AC Master Service,, AC Water Drop Solution, Hanging Charge, AC Jet Wash services. 
            In AC Installation & Un-installation there will be available AC installation, AC un-installation, AC installation & un-installation services.
            "
        ];
    }
}
