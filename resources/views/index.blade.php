<x-parent-layout>
    <main>
        <div
          class="relative pt-16 pb-32 flex content-center items-center justify-center"
          style="min-height: 75vh;">
          <div
            class="absolute w-full h-full bg-center bg-cover"
            style='background-image: url("imgs/backgroundImage.jpg");'>
          </div>
          <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
              <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                <div class="pr-12">
                  <h1 class="text-black font-bold text-5xl mb-40">
                    Trust in with us.
                  </h1>
                </div>
              </div>
            </div>
          </div>
          <div class="absolute mt-10 w-1/3">
            <form action="" method="POST">
              @csrf
              <div id="searchService" class="relative">
                <input class="w-full h-11 border-2 border-black pl-4 shadow-lg rounded-md content-center"
                            type="text"
                            name="searchService" placeholder="Find your Service here e.g. AC,Car"  required />
                <button type="submit" class="absolute inset-y-0 right-0 w-8 m-2 bg-pink-600 rounded-md">
                    <i class="text-white fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
            </form>
          </div>
          <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
            style="height: 70px;">
            <svg
              class="absolute bottom-0 overflow-hidden"
              xmlns="http://www.w3.org/2000/svg"
              preserveAspectRatio="none"
              version="1.1"
              viewBox="0 0 2560 100"
              x="0"
              y="0">
              <polygon
                class="text-gray-300 fill-current"
                points="2560 0 2560 100 0 100"
              ></polygon>
            </svg>
          </div>
        </div>
        <section class="pb-20 bg-gray-300 -mt-24">
          <div class="container mx-auto px-4">
            <div class="flex flex-wrap">
              <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                  <div class="px-4 py-5 flex-auto">
                    <div
                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400">
                      <i class="fas fa-award"></i>
                    </div>
                    <h6 class="text-xl font-semibold">Awarded Agency</h6>
                    <p class="mt-2 mb-4 text-gray-600">
                      We are awarded with best Online service provider in 2020.
                    </p>
                  </div>
                </div>
              </div>
              <div class="w-full md:w-4/12 px-4 text-center">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
                >
                  <div class="px-4 py-5 flex-auto">
                    <div
                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-blue-400"
                    >
                      <i class="fas fa-retweet"></i>
                    </div>
                    <h6 class="text-xl font-semibold">Free Services</h6>
                    <p class="mt-2 mb-4 text-gray-600">
                      Free Delevary charge
                    </p>
                  </div>
                </div>
              </div>
              <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
                >
                  <div class="px-4 py-5 flex-auto">
                    <div
                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-400"
                    >
                      <i class="fas fa-fingerprint"></i>
                    </div>
                    <h6 class="text-xl font-semibold">Verified Company</h6>
                    <p class="mt-2 mb-4 text-gray-600">
                      We are verified by BEA.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex flex-wrap items-center mt-32">
              <div class="w-full md:w-5/12 px-4 mr-auto ml-auto">
                <div
                  class="text-gray-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-gray-100"
                >
                  <i class="fas fa-user-friends text-xl"></i>
                </div>
                <h3 class="text-3xl mb-2 font-semibold leading-normal">
                  Working with us is a pleasure
                </h3>
                <p
                  class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700"
                >
                  They help me to comeback in my feet. After i lost my job i became homeless.
                </p>
                <p
                  class="text-lg font-light leading-relaxed mt-0 mb-4 text-gray-700"
                >
                  I heard it from my friend. When I started working with them My life change Ever Since.
                </p>
                <a
                  href="https://www.creative-tim.com/learning-lab/tailwind-starter-kit#/presentation"
                  class="font-bold text-gray-800 mt-8"
                  >More!</a
                >
              </div>
              <div class="w-full md:w-4/12 px-4 mr-auto ml-auto">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-pink-600"
                >
                  <img
                    alt="..."
                    src="imgs/p.jpeg"
                    class="w-full align-middle rounded-t-lg"
                  />
                  <blockquote class="relative p-8 mb-4">
                    <svg
                      preserveAspectRatio="none"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 583 95"
                      class="absolute left-0 w-full block"
                      style="height: 95px; top: -94px;"
                    >
                      <polygon
                        points="-30,95 583,95 583,65"
                        class="text-pink-600 fill-current"
                      ></polygon>
                    </svg>
                    <h4 class="text-xl font-bold text-white">
                      Top Services
                    </h4>
                    <p class="text-md font-light mt-2 text-white">
                      you can do almost anything if you work hard enough
                    </p>
                  </blockquote>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="relative py-20">
          <div
            class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
            style="height: 80px;"
          >
            <svg
              class="absolute bottom-0 overflow-hidden"
              xmlns="http://www.w3.org/2000/svg"
              preserveAspectRatio="none"
              version="1.1"
              viewBox="0 0 2560 100"
              x="0"
              y="0"
            >
              <polygon
                class="text-white fill-current"
                points="2560 0 2560 100 0 100"
              ></polygon>
            </svg>
          </div>
          <div class="container mx-auto px-4">
            <div class="items-center flex flex-wrap">
              <div class="w-full md:w-4/12 ml-auto mr-auto px-4">
                <img
                  alt="..."
                  class="max-w-full rounded-lg shadow-lg"
                  src="imgs/chair.jfif"
                />
              </div>
              <div class="w-full md:w-5/12 ml-auto mr-auto px-4">
                <div class="md:pr-12">
                  <div
                    class="text-pink-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-pink-300"
                  >
                    <i class="fas fa-rocket text-xl"></i>
                  </div>
                  <h3 class="text-3xl font-semibold">A growing company</h3>
                  <p class="mt-4 text-lg leading-relaxed text-gray-600">
                    Thousand of people trust in us.We are expanding rapidly.
                  </p>
                  <ul class="list-none mt-6">
                    <li class="py-2">
                      <div class="flex items-center">
                        <div>
                          <span
                            class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-pink-200 mr-3"
                            ><i class="fas fa-fingerprint"></i
                          ></span>
                        </div>
                        <div>
                          <h4 class="text-gray-600">
                            Good User Reviews
                          </h4>
                        </div>
                      </div>
                    </li>
                    <li class="py-2">
                      <div class="flex items-center">
                        <div>
                          <span
                            class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-pink-200 mr-3"
                            ><i class="fab fa-html5"></i
                          ></span>
                        </div>
                        <div>
                          <h4 class="text-gray-600">Hard working Service Men</h4>
                        </div>
                      </div>
                    </li>
                    <li class="py-2">
                      <div class="flex items-center">
                        <div>
                          <span
                            class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-pink-200 mr-3"
                            ><i class="far fa-paper-plane"></i
                          ></span>
                        </div>
                        <div>
                          <h4 class="text-gray-600">Satisfied Clients</h4>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="pb-20 relative block bg-gray-900">
          <div
            class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
            style="height: 80px;"
          >
            <svg
              class="absolute bottom-0 overflow-hidden"
              xmlns="http://www.w3.org/2000/svg"
              preserveAspectRatio="none"
              version="1.1"
              viewBox="0 0 2560 100"
              x="0"
              y="0">
              <polygon
                class="text-gray-900 fill-current"
                points="2560 0 2560 100 0 100"
              ></polygon>
            </svg>
          </div>
          <div class="container mx-auto px-4 lg:pt-24 lg:pb-64">
            <div class="flex flex-wrap text-center justify-center">
              <div class="w-full lg:w-6/12 px-4">
                <h2 class="text-4xl font-semibold text-white">Work With Us</h2>
                <p class="text-lg leading-relaxed mt-4 mb-4 text-gray-500">
                  We care about everyone including who work for us.
                </p>
              </div>
            </div>
            <div class="flex flex-wrap mt-12 justify-center">
              <div class="w-full lg:w-3/12 px-4 text-center">
                <div
                  class="text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-white inline-flex items-center justify-center"
                >
                  <i class="fas fa-medal text-xl"></i>
                </div>
                <h6 class="text-xl mt-5 font-semibold text-white">
                  Excelent Pay
                </h6>
                <p class="mt-2 mb-4 text-gray-500">
                  We offer wages based on hourly work done.
                </p>
              </div>
              <div class="w-full lg:w-3/12 px-4 text-center">
                <div
                  class="text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-white inline-flex items-center justify-center"
                >
                  <i class="fas fa-poll text-xl"></i>
                </div>
                <h5 class="text-xl mt-5 font-semibold text-white">
                  Promote your Service
                </h5>
                <p class="mt-2 mb-4 text-gray-500">
                  we promote our best working Service men.
                </p>
              </div>
              <div class="w-full lg:w-3/12 px-4 text-center">
                <div
                  class="text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-white inline-flex items-center justify-center"
                >
                  <i class="fas fa-lightbulb text-xl"></i>
                </div>
                <h5 class="text-xl mt-5 font-semibold text-white">Flexible working Time</h5>
                <p class="mt-2 mb-4 text-gray-500">
                  You can work with us within our flexible time limit.
                </p>
              </div>
            </div>
          </div>
        </section>
    </main>
</x-parent-layout>