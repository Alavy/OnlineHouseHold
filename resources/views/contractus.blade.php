<x-parent-layout>
    <section class="relative block lg:pt-0 bg-gray-900">
        <div class="container mx-auto py-48">
            <div class="flex flex-wrap justify-center">
                <div class="w-full lg:w-6/12 px-4">
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300">
                        @isset($succes)
                        <div class="font-bold p-6 text-lg text-green-600 content-center">
                            {{$succes}}

                        </div>
                        @endisset

                        <div class="flex-auto p-5 lg:p-10">
                            <h4 class="text-2xl font-semibold">Do have any Suggestions?</h4>
                            <p class="leading-relaxed mt-1 mb-4 text-gray-600">
                                Complete this form and we will get back to you in 24 hours.
                                <br>
                                Or you can directly Contract us in  <a style="color: red;" href="tel:+8801580398370">   015-803-98370</a>
                                <br>
                                And Mail Us <a style="color: red;" href="mailto:sajeebhassan612@gmail">  sajeebhassan612@gmail</a>

                            </p>

                                        <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <div class="relative w-full mb-3 mt-8">
                                <form method="POST" action="{{ route('contractus') }}">
                                    @csrf
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                        for="full-name">Full Name</label><input type="text"
                                        class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                        placeholder="Full Name" name="name" style="transition: all 0.15s ease 0s;" />
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    for="email">Email</label><input type="email"
                                    class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                    placeholder="Email" name="contractEmail" style="transition: all 0.15s ease 0s;" />
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    for="message">Message</label><textarea rows="4" cols="80" name="message"
                                    class="border-0 px-3 py-3 placeholder-gray-400  text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                    placeholder="Type a message..."></textarea>
                            </div>
                            <div class="text-center mt-6">
                                <button
                                    class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
                                    type="submit" style="transition: all 0.15s ease 0s;">
                                    Send Message
                                </button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-parent-layout>
