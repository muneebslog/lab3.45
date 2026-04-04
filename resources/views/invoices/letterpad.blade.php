<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Set A4 size with margins for printing */
        @page {
            size: A4;
        }

        /* Apply styles to the body element */
        body {
            box-sizing: border-box;
            font-family: "Lato", sans-serif;
            margin: 0;
            padding: 0;
        }

    </style>

</head>

<body  class=" ">
    <div class="   ">
        <div class=" ">
            <div class=" ">
                <!-- Card -->
                <div class="flex flex-col  bg-white  rounded-xl dark:bg-neutral-800">
                    <div class="flex justify-between  items-center">

                        <div class="flex">
                            <div class="">
                                <h1 class="mt-2 text-5xl  font-semibold text-blue-900 dark:text-white font-serif">Mohsin
                                </h1>
                                <div class=" mx-1 font-mono">
                                    <p class="font-serif">PHC REG # R <span class="font-sans">13048</span></P>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class=" h-1/2 flex items-end">
                                    <p class=" font-semibold text-blue-900 font-serif">&nbsp;Clinical </p>
                                </div>
                                <div class=" h-1/2">
                                    <p class=" font-serif font-semibold text-blue-900">
                                        &nbsp; Laboratory
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class=" flex gap-3">
                            <div class="font-serif">Medical Record No:</div>
                            <div class="flex flex-col">
                                <div class=""><img class="h-[30px]" src="{{ asset('images/download (1).png') }}"
                                        alt=""></div>
                                <div class="text-center">
                                    <span class="">{{ now()->format('d-m-Y') }}-{{ $no }}</sapn>
                                </div>

                            </div>
                        </div>
                        <!-- Col -->
                    </div>
                </div>
            </div>
            <!-- End Invoice -->
        </div>
        {{-- <div class="">

        <div class="grid text-sm grid-cols-5 mt-3 grid-rows-3 gap-1 p-1 border-t border-b">
            <div class="font-serif">Patient Name</div>
            <div class="font-serif">: Anaya Maqsood</div>
            <div class="col-start-4 row-start-1 font-serif">Age / Sex</div>
            <div class="col-start-5 row-start-1 font-serif">: <span class="font-sans"> 04 </span>Yrs. / Female</div>
            <div class="col-start-1 row-start-2 font-serif">Referred by Doctor</div>
            <div class="col-start-2 row-start-2 font-serif">: Dr. Ahtisham Sb</div>
            <div class="col-start-4 row-start-2 font-serif">Sample Date</div>
            <div class="col-start-5 row-start-2 text-bold">: 13 – 07 – 2024</div>
            <div class="col-start-1 row-start-3 font-serif">Phone / Cell No. </div>
            <div class="col-start-2 row-start-3">: 0315-4161461</div>
            <div class="col-start-4 row-start-3 font-serif">Reports Date</div>
            <div class="col-start-5 row-start-3">: 14 – 07 – 2024</div>
            <div class="row-span-3 col-start-3 row-start-1 my-1 flex items-center flex-col  ">
                <img src="{{ asset('images/download.png') }}" class=" size-20" alt="">
                <p class="font-serif">Track Online</p>
            </div>
        </div>


    </div> --}}
    </div>
        <div class="">
            <div class=" min-h-[820px] border-black">
                {{-- @yield('content') --}}

                {{ $slot }}
            </div>

            <div class="  w-screen ">
                <div class="">
                    <p class=" text-center font-serif"> Electronically verified report. No signature(s) required. Not
                        valid for
                        Court</p>
                    <div class="grid text-center m-1 mb-2 border-black border-t grid-cols-4 grid-rows-1 gap-4">
                        <div class="text-center">
                            <h3 class=" font-serif  text-xs">Dr. Tariq Saeed</h3>
                            <p class="font-serif  text-[0.50rem]">M.B.B.S. M.C.P.S, F.C.P.S</p>
                            <p class="font-serif  text-[0.50rem]">Asst prof. surgery Shalimar</p>
                        </div>
                        <div>
                            <h3 class=" font-serif  text-xs">Dr. Muhammad Sohail</h3>
                            <p class="font-serif  text-[0.50rem]">M.B.B.S, MS (UROLOGY) </p>
                            <p class="font-serif  text-[0.50rem]">Consultant Urologist</p>
                        </div>
                        <div>
                            <h3 class=" font-serif  text-xs"> Muhammad Asghar</h3>
                            <p class="font-serif  text-[0.50rem]"> Sr. Lab Technician </p>
                        </div>
                        <div>
                            <h3 class=" font-serif  text-xs">Muhammad Zia Ul Haq</h3>
                            <p class="font-serif  text-[0.50rem]"> Biochemist & Molecular Biologist </p>

                        </div>
                    </div>


                </div>
                <div class=" text-center font-serif pt-1 text-white   font-mono text-sm p-3 bg-indigo-900">
                    <p><span class="font-sans">433/12</span>-A,Peer Colony,St <span class="font-sans"># 1</span>,Walton
                        Road
                        Lahore, <span class="font-sans">Cell: 0320-8489685 | Ph: 042 36662345</span></p>
                    <p class="text-xs"> Website: mohsinmedicalcomplex.com</p>
                </div>
            </div>
        </div>


    </div>

</body>

</html>
