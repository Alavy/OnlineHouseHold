<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;
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
        
        Appointment::factory()->count(3)->state(new Sequence(
            ['fee' => 400.50],
            ['fee' => 300.56],
            ['fee'=> 1000.00]
        )) ->create();

        Blog::factory()->count(8)->state(new Sequence(
            ['header' => "Electronics & Gadgets Repair",'body'=>"
            there will be mainly available 3 types of service. 
            They are:
            •	 Desktop Service 
            •	 Laptop Service 
            •	 AC servicing 
            •	 Bc Servicing

            From Desktop service they can choose:
            a)	 Hardware Related Services 
            b)	 Software Related Services 
            
            In Hardware Related Services, there will be available 
            Motherboard installation, motherboard repair, HDD or SSD installation 
            or replacement, Power Supply, Diagnosis, Power Supply Unit Installation 
            services.
            In Software Related Services, there will be available Driver Installation, 
            Software Installation, Application Installation, 
            Operating System installation, Data Recovery, Diagnosis, 
            BIOS Configuring Updating services.
            
            From Laptop Service they can choose:
            a)	 Hardware Related Services 
            b)	 Software Related Services 
            
            In Hardware Related Services, there will be available 
            Motherboard installation, motherboard repair, HDD or SSD installation 
            or replacement, Power Supply, Diagnosis, Power Supply 
            Unit Installation services.
            In Software Related Services, there will be available Driver Installation, 
            Software Installation, Application Installation, 
            Operating System installation, Data Recovery, Diagnosis, 
            BIOS Configuring Updating services.
            
            From AC servicing they can choose:
            a)	 AC Servicing 
            b)	 AC Installation & Un-installation 
            
            In AC Servicing, there will be available AC Basic Service, 
            AC Master Service,, AC Water Drop Solution, Hanging Charge, 
            AC Jet Wash services. 
            In AC Installation & Un-installation there will be available 
            AC installation, AC un-installation, 
            AC installation & un-installation services.
            "],
            ['header' => "Plumber",'body'=>"
            In Plumbing Category, there will be available 4 kind of services. 
            They are:
            •	 Water Meter Servicing 
            •	 Water Tap Servicing 
            •	 Sink Repair 
            •	 Plumbing Checkup 
            
            From Water Meter Servicing, there will be available Water 
            Meter Installation service.
            From Water Tap Servicing, there will be available Water Tap 
            Installation service.
            From Sink Repair, there will be available Sink Installation, 
            Sink Repair, Sink Blockage services.
            "],
            ['header' => "Home Cleaner",'body'=>"
            In Home Cleaning Category, there will be available 6 type of services. 
            They are:
            •	 Common Space Cleaning 
            •	 Home Deep Clean 
            •	 Floor Deep Cleaning For Home 
            •	 Bathroom Deep Cleaning 
            •	 Kitchen Deep Cleaning 
            •	 Window & Thai Cleaning 
        
            From Common Space Cleaning, there will be available Roof top cleaning, 
            Basement cleaning, Stairs services.
            From Home Deep Clean, there will be available range upto 800sft, 800-1200sft, 
            1200-1600sft, 1600-2000sft, 2000-2500sft.
            From Floor Deep Cleaning For Home, there will be available Tiles, Marble, 
            Mosaic, Wooden services,
            From Kitchen Deep Cleaning, there will be available cleaning with kitchen hood,
            cleaning without kitchen hood.
            "],
            ['header' => "Pest Controller",'body'=>"
            In Pest Control Category, 
            there will be available :
            •	 Cockroach Control  
            •	 Rodent Control 
            •	 Bed Bug Control 
            •	 Termite Control 
            General Spraying for Pest like ant and mosquito etc services.
            "],
            ['header' => "House Shifting",'body'=>"
            In House Shifting Category, there will be 2 type of service. 
            They are:
                •	 Family House Shifting 
                •	 Bachelor House Shifting 
            From Family House Shifting, there will be 1 Bedroom hall and kitchen, 
            2 Bedroom hall and kitchen, 3 Bedroom hall and kitchen,
            4 Bedroom hall and kitchen services.
            "],
            ['header' => "Electrician",'body'=>"
            In Electrician for electric service, there will be 6 type of service. 
            They are:
                •	 Ceiling Fan Servicing 
                •	 Exhaust Fan Servicing 
                •	 Main Circuit Breaker Servicing 
                •	 Main Distribution Board Installation 
                •	 Power Distribution Board Installation 
                •	 Electrical Checkup 
                
            From Ceiling Fan Servicing, there will be available ceiling fan installation
            \capacitor change\regulator fitting, Fan repair, Coil repair services.
            From Exhaust Fan Servicing, there will be available exhaust fan Installation,
            Repair,Coil repair services.
            From Main Circuit Breaker Servicing, there will be available 
            main circuit breakerinstallation, 
            main circuit breaker repair services.
            "],
            ['header' => "Appliance Repair",'body'=>"
            In Appliance Repair Category, there will be 5 type of services. 
            They are:
            •	 TV Repair Service 
            •	 Refrigerator Repair Service 
            •	 Washing Machine Repair Service 
            •	 Water Purifier Repair Service 
            •	 Generator Repair Service 
            
            From TV Repair Service, they can choose:
            a)	LCD\LED TV repair service
            b)	TV wall mount installation
            
            In LCD\LED TV repair service, there will be range from 22”-39”, 
            40”-45”, 46”-55”,Above 55”.
            In TV wall mount installation, there will be range from 22”-50”,
            Above 50”.
            
            From Refrigerator Repair Service, they can choose:
            a)	Refrigerator servicing
            b)	Fridge gas refill
            
            In Refrigerator servicing, there will be available Basic service,
            Circuit repair or replacement, Condensor fitting with gas refill, 
            Compressor fitting with gas refill services.
            
            From Washing Machine Repair Service, they can choose:
            a)	Washing machine servicing
            b)	Washing machine installation
            
            In Washing machine servicing, there will be available Basic service,
            Circuit repair or replacement, Motor repair, Gear box repair, 
            Water level sensor services.
        
            From Water Purifier Repair Service, there will be available Installation, 
            Dismantling, Kit replacement, Servicing.
            From Generator Repair Service, there will be available range from Up-to 150KVA,
            Up-to 300KVA, Up-to 500 KVA.
            "],
            ['header' => "Service Seeker",'body'=>"
            there will be available 5 types of services.
             They are:
            •	 Interior Paint 
            •	 Exterior Paint 
            •	 Damp Repair Solution 
            •	 Wood & Furniture Paint 
            •	 Enamel Paint 
            
            From Interior Paint, there will be available Plastic paint, Distemper paint, 
            Luxury silk paint, Breath easy paint, Easy clean services.
            From Exterior Paint, there will be available Weather coat anti dirt paint,
             Weather coat smooth paint services.
            From Damp Repair Solution, there will be available Damp wall repair 
            permanent solution, Roof water leakage repair services.
            From Wood & Furniture Paint, there will be available Lacquar varnish, 
            Hand polish, Spray or Docu paint services.
            From Enamel Paint, there will be available new surface, 
            Re-paint on old surface services.
            "],
        )) ->create();

        User::factory()->state(function (array $attributes){
            return [
                'name' => "Md Sajeeb ",
                'email' => 'sajeebhassan612@gmail.com',
                'email_verified_at' => now(),
                'role'=> 'admin',
                'user_identity'=>crc32('sajeebhassan612@gmail.com'.' '.time()),
                'profileUpdated'=>true,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ];
        })->create();
    }
}
