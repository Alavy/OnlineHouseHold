<nav class="fixed bg-white text-gray-800 shadow-md z-50 w-full flex flex-wrap items-center justify-between px-2 py-3">
      <div x-data="{navShow:true}"
        class="container px-4 mx-auto flex flex-wrap items-center justify-between">
        <div class="w-full relative flex items-center justify-between lg:w-auto lg:static lg:block lg:justify-start">
          <x-application-logo class="inline-block h-10 w-40 fill-current text-gray-600" />
          <a class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase"
            href="{{route('index')}}">
            {{ config('app.name', 'Laravel') }}</a
          ><div
            class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
            x-on:click="navShow =! navShow">
            <i class="text-gray-800 fas fa-bars"></i>
          </div>
        </div>
        <div x-bind:class="!navShow?'lg:flex flex-grow items-center lg:bg-transparent lg:shadow-none visible':'lg:flex flex-grow items-center lg:bg-transparent lg:shadow-none lg:visible hidden'">
            <ul class="flex flex-col lg:flex-row list-none mr-auto">
              @if (Auth::check())
              <li class="flex items-center">
                <a
                  class="lg:text-black lg:hover:text-gray-500 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                  href="{{route('dashboard')}}"
                  ><i
                    class="lg:text-gray-700 text-gray-500 far fa-file-alt text-lg leading-lg mr-2"
                  ></i>
                  Home </a
                >
              </li>
              @else
              <li class="flex items-center">
                <a
                  class="lg:text-black lg:hover:text-gray-500 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                  href="{{route('index')}}"
                  ><i
                    class="lg:text-gray-700 text-gray-500 far fa-file-alt text-lg leading-lg mr-2"
                  ></i>
                  Home </a
                >
              </li>
              @endif
              
              <li class="flex items-center">
                <a
                  class="lg:text-black lg:hover:text-gray-500 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                  href="{{route('aboutus')}}"
                  ><i
                    class="lg:text-gray-700 text-gray-500 fas fa-filter text-lg leading-lg mr-2"
                  ></i>
                  About Us </a
                >
              </li>
              <li class="flex items-center">
                <a
                  class="lg:text-black lg:hover:text-gray-500 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                  href="{{route('policy')}}"
                  ><i
                    class="lg:text-gray-700 text-gray-500 fas fa-user-secret text-lg leading-lg mr-2"
                  ></i>
                  Policy</a
                >
              </li>
              <li class="flex items-center">
                <a
                  class="lg:text-black lg:hover:text-gray-500 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                  href="{{route('contractus')}}"
                  ><i
                    class="lg:text-gray-700 text-gray-500 fas fa-align-justify text-lg leading-lg mr-2"
                  ></i>
                  Contact Us</a>
              </li>
              <li class="flex items-center">
                <div class="items-center">
                  <x-dropdown :align="'top'" :width="48">
                      <x-slot name="trigger">

                        <a class="lg:text-black lg:hover:text-gray-500 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                          href="#"
                        ><i class="lg:text-gray-700 text-gray-500 fas fa-ambulance text-lg leading-lg mr-2"></i>
                        Service Category</a>
                      </x-slot>
                      <x-slot name="content">
                        <div class="block">
                          <a class="block p-2" href="{{route('blog').'/1'}}">Electronics & Gadgets Repair</a>
                          <a class="block p-2" href="{{route('blog').'/2'}}">Plumber</a>
                          <a class="block p-2" href="{{route('blog').'/3'}}">Home Cleaner</a>
                          <a class="block p-2" href="{{route('blog').'/4'}}">Pest Controller</a>
                          <a class="block p-2" href="{{route('blog').'/5'}}">House Shifting</a>
                          <a class="block p-2" href="{{route('blog').'/6'}}">Electrician</a>
                          <a class="block p-2" href="{{route('blog').'/7'}}">Appliance Repair</a>
                          <a class="block p-2" href="{{route('blog').'/8'}}">Service Seeker</a>

                        </div>
                      </x-slot>
                  </x-dropdown>
                </div>
                
              </li>
            </ul>
            @if (Auth::check())
            <div class="items-center">
              <x-dropdown :align="'right'" width="48">
                  <x-slot name="trigger">
                      <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                          <div>{{ Auth::user()->name }}</div>

                          <div class="ml-1">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                              </svg>
                          </div>
                      </button>
                  </x-slot>

                  <x-slot name="content">
                      <!-- Authentication -->
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <x-dropdown-link :href="route('logout')"
                                  onclick="event.preventDefault();
                                              this.closest('form').submit();">
                              {{ __('Logout') }}
                          </x-dropdown-link>
                      </form>
                  </x-slot>
              </x-dropdown>
            </div>
            @else
            <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
              <li class="flex items-center">
                <a href="{{route('login')}}">
                <button
                  class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3"
                  type="button"
                  style="transition: all 0.15s ease 0s;">
                  <i class="fas fa-code-branch"></i> Log In
                </button>
              </a>
              </li>
              
              <li class="flex items-center">
                <a href="{{route('register')}}">
                <button
                  class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3"
                  type="button"
                  style="transition: all 0.15s ease 0s;">
                  <i class="fas fa-address-book"></i> Register
                </button>
              </a>
              </li>
            </ul>
            @endif

            
        </div>
        
      </div>
    </nav>