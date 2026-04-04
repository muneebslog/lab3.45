<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="">
        <div class=" w-full">
            <div class=" w-full">
                <!-- Card -->
                <div class="flex flex-col  bg-white  rounded-xl dark:bg-neutral-800">
                    <!-- Grid -->

                    <div class="flex justify-between">
                        <div>

<div class="grid grid-cols-2 grid-rows-2 gap-1">
    <div class="row-span-2"><h1 class="mt-2 text-6xl  font-semibold text-blue-900 dark:text-white">Mohsin </h1>
        <div class=" flex justify-between mx-1">
            <p>PHC REG #</p>
            <P> R 13048</P>
        </div>
    </div>
    <div class=" flex items-end ">
        <p class=" font-semibold text-blue-900 ">Clinical </p>
    </div>
    <div class="col-start-2 row-start-2 flex items-start">
        <p class="  font-semibold text-blue-900">
            Laboratory
            </p>
        </div>
</div>
                        </div>
                        <!-- Col -->
                        <div class="">
                            <img src="{{ asset('images/download.png') }}" class=" size-20" alt="">
                        </div>
                        <!-- Col -->
                    </div>
                    <!-- End Grid -->
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-neutral-200 text-center">
                        Invoice </h2>

                    <!-- Grid -->
                    <div class="mt-2 grid sm:grid-cols-2 gap-3">
                        <div>
                            <dl class="grid sm:grid-cols-5 gap-x-3 mb-1">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Medical Record No:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500"> {{ $patient->created_at->format('d-m-Y') }}-{{ $patient->id }}</dd>
                            </dl>
                            <dl class="grid sm:grid-cols-5 mt-1 ">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Name:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->name }}</dd>
                            </dl>
                            <dl class="grid sm:grid-cols-5 ">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Gender:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500 capitalize">
                                    {{ $patient->gender }}</dd>
                            </dl>

                        </div>
                        <!-- Col -->

                        <div class="sm:text-end space-y-2">
                            <!-- Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                                <dl class="grid sm:grid-cols-5 gap-x-3">
                                    <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Invoice
                                        Date:</dt>
                                    <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                        {{ $patient->created_at->format('d F Y') }}</dd>
                                </dl>
                                <dl class="grid sm:grid-cols-5 gap-x-3">
                                    <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Age:</dt>
                                    <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->age }}</dd>
                                </dl>
                                <dl class="grid sm:grid-cols-5 gap-x-3">
                                    <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Phone:</dt>
                                    <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->phone }}
                                    </dd>
                                </dl>
                            </div>
                            <!-- End Grid -->
                        </div>
                        <!-- Col -->
                    </div>
                    <!-- End Grid -->

                    <!-- Table -->
                    <div class="mt-6">
                        <div class="border border-gray-200 p-4 rounded-lg space-y-4 dark:border-neutral-700">
                            <div class="hidden sm:grid sm:grid-cols-4">
                                <div
                                    class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Test</div>
                                <div
                                    class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Rate</div>
                                <div class="text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Amount</div>
                            </div>

                            <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700"></div>
                            @foreach ($patient->tests as $item)
                                <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                                    <div class="col-span-full sm:col-span-2">
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Item</h5>
                                        <p class="font-medium text-gray-800 dark:text-neutral-200">{{ $item->name }}
                                        </p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Rate</h5>
                                        <p class="text-gray-800 dark:text-neutral-200">{{ $item->price }}</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Amount</h5>
                                        <p class="sm:text-end text-gray-800 dark:text-neutral-200">Rs{{ $item->price }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                            <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>


                        </div>
                    </div>
                    <!-- End Table -->

                    <!-- Flex -->
                    <div class="mt-3 flex sm:justify-end">
                        <div class="w-full max-w-2xl sm:text-end space-y-2">
                            <!-- Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">


                                <dl class="grid sm:grid-cols-5 gap-x-3">
                                    <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Total:</dt>
                                    <dd class="col-span-2 text-black dark:text-neutral-500">Rs {{ $total }}</dd>
                                </dl>
                            </div>
                            <!-- End Grid -->
                        </div>
                    </div>
                    <!-- End Flex -->

                    <div class="mt-2 flex gap-3 sm:mt-12">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Thank you!</h4>
                        <p class="text-gray-500 dark:text-neutral-500">If you have any questions concerning this
                            invoice, use the following contact information:</p>
                            <a href="tel:04236662345"
                                class="block text-sm font-medium text-gray-800 dark:text-neutral-200">04236662345</a>
                    </div>

                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Invoice -->
    </div>
    <br>
    <hr>
    <P class=" text-center">------------------------------------------------  CUT FROM HERE! ------------------------------------</P>
    <hr>
    <br>
    <div class="">
        <div class=" w-full">
            <div class=" w-full">
                <!-- Card -->
                <div class="flex flex-col  bg-white  rounded-xl dark:bg-neutral-800">
                    <!-- Grid -->

                    <div class="flex justify-between">
                        <div>

<div class="grid grid-cols-2 grid-rows-2 gap-1">
    <div class="row-span-2"><h1 class="mt-2 text-6xl  font-semibold text-blue-900 dark:text-white">Mohsin </h1></div>
    <div class=" flex items-end ">
        <p class=" font-semibold text-blue-900 ">Clinical </p>
    </div>
    <div class="col-start-2 row-start-2 flex items-start">
        <p class="  font-semibold text-blue-900">
            Laboratory
            </p>
        </div>
</div>
                        </div>
                        <!-- Col -->
                        <div class="">
                            <img src="{{ asset('images/download.png') }}" class=" size-20" alt="">
                        </div>
                        <!-- Col -->
                    </div>
                    <!-- End Grid -->
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-neutral-200 text-center">
                        Invoice </h2>

                    <!-- Grid -->
                    <div class="mt-2 grid sm:grid-cols-2 gap-3">
                        <div>
                            <dl class="grid sm:grid-cols-5 gap-x-3 mb-1">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Medical Record No:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->id }}</dd>
                            </dl>
                            <dl class="grid sm:grid-cols-5 mt-1 ">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Name:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->name }}</dd>
                            </dl>
                            <dl class="grid sm:grid-cols-5 ">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Gender:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500 capitalize">
                                    {{ $patient->gender }}</dd>
                            </dl>

                        </div>
                        <!-- Col -->

                        <div class="sm:text-end space-y-2">
                            <!-- Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                                <dl class="grid sm:grid-cols-5 gap-x-3">
                                    <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Invoice
                                        Date:</dt>
                                    <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                        {{ $patient->created_at->format('d F Y') }}</dd>
                                </dl>
                                <dl class="grid sm:grid-cols-5 gap-x-3">
                                    <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Age:</dt>
                                    <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->age }}</dd>
                                </dl>
                                <dl class="grid sm:grid-cols-5 gap-x-3">
                                    <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Phone:</dt>
                                    <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->phone }}
                                    </dd>
                                </dl>
                            </div>
                            <!-- End Grid -->
                        </div>
                        <!-- Col -->
                    </div>
                    <!-- End Grid -->

                    <!-- Table -->
                    <div class="mt-6">
                        <div class="border border-gray-200 p-4 rounded-lg space-y-4 dark:border-neutral-700">
                            <div class="hidden sm:grid sm:grid-cols-4">
                                <div
                                    class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Test</div>
                                <div
                                    class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Rate</div>
                                <div class="text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Amount</div>
                            </div>

                            <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700"></div>
                            @foreach ($patient->tests as $item)
                                <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                                    <div class="col-span-full sm:col-span-2">
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Item</h5>
                                        <p class="font-medium text-gray-800 dark:text-neutral-200">{{ $item->name }}
                                        </p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Rate</h5>
                                        <p class="text-gray-800 dark:text-neutral-200">{{ $item->price }}</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Amount</h5>
                                        <p class="sm:text-end text-gray-800 dark:text-neutral-200">Rs{{ $item->price }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                            <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>


                        </div>
                    </div>
                    <!-- End Table -->

                    <!-- Flex -->
                    <div class="mt-3 flex sm:justify-end">
                        <div class="w-full max-w-2xl sm:text-end space-y-2">
                            <!-- Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">


                                <dl class="grid sm:grid-cols-5 gap-x-3">
                                    <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Total:</dt>
                                    <dd class="col-span-2 text-black dark:text-neutral-500">Rs {{ $total }}</dd>
                                </dl>
                            </div>
                            <!-- End Grid -->
                        </div>
                    </div>
                    <!-- End Flex -->


                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Invoice -->
    </div>



    <script>
        window.onload = function() {
            // Optionally add a delay to ensure content is fully loaded
            setTimeout(function() {
                window.print();
            }, 100); // Adjust delay in milliseconds if needed
        };
    </script>

</body>

</html>
