<div class="">
    {{-- Stop trying to control. --}}
    <x-back-link href="{{ route('cases-list') }}">Invoice</x-back-link>

    <!-- Invoice -->
    <div class="max-w-[85rem] px-4 mt-3 sm:px-6 lg:px-8 mx-auto ">
        <div class="sm:w-11/12 lg:w-3/4 mx-auto">
            <!-- Card -->
            <div class="flex flex-col p-4 sm:p-10 bg-white shadow-md rounded-xl dark:bg-neutral-800">
                <!-- Grid -->

                <div class="flex justify-between">
                    <div>

                        <div class="grid grid-cols-2 grid-rows-2 gap-1">
                            <div class="row-span-2">
                                <h1 class="mt-2 text-6xl  font-semibold text-blue-900 dark:text-white">Mohsin </h1>
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
                        {{ QrCode::size(60)->generate(route('guest.invoice', ['invoice_number' => $patient->receipt_no])) }}
                        {{-- <img src="{{ asset('images/download.png') }}" class=" size-20" alt=""> --}}
                    </div>
                    <!-- Col -->
                </div>
                <!-- End Grid -->
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-neutral-200 text-center">Invoice
                </h2>

                <!-- Grid -->
                <div class="mt-8 grid sm:grid-cols-2 gap-3">
                    <div>
                        <dl class="grid sm:grid-cols-5 gap-x-3 mb-1">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Medical Record #:
                            </dt>
                            <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                {{ $patient->receipt_no }}</dd>
                        </dl>
                        <dl class="grid sm:grid-cols-5 mt-1 ">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Name:</dt>
                            <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->name }}</dd>
                        </dl>
                        <dl class="grid sm:grid-cols-5 ">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Gender:</dt>
                            <dd class="col-span-2 text-gray-500 dark:text-neutral-500 capitalize">{{ $patient->gender }}
                            </dd>
                        </dl>

                    </div>
                    <!-- Col -->

                    <div class="sm:text-end space-y-2">
                        <!-- Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Invoice Date:
                                </dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                    {{ $patient->created_at->format('d F Y') }}</dd>
                            </dl>
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Age:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->age }}</dd>
                            </dl>
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Phone:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->phone }}</dd>
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
                        <div class="hidden sm:grid sm:grid-cols-6">
                            <div
                                class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Test</div>
                            <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Rate</div>
                            <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Status</div>
                            <div class=" text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-center">
                                Action</div>
                        </div>

                        <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700"></div>
                        @foreach ($patient->tests as $item)
                            <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                                <div class="col-span-full sm:col-span-2">
                                    <h5
                                        class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Item</h5>
                                    <p class="font-medium text-gray-800 dark:text-neutral-200">{{ $item->name }}</p>
                                </div>
                                <div>
                                    <h5
                                        class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Rate</h5>
                                    <p class="text-gray-800 dark:text-neutral-200">{{ $item->price }}</p>
                                </div>

                                <div class="">
                                    @if ($item->pivot->isResultAdded)
                                        <span
                                            class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                            <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                            </svg>
                                            Active
                                        </span>
                                        @if ($item->pivot->isPrinted)
                                            <span
                                                class="mt-1 py-0.5 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full dark:bg-blue-500/10 dark:text-blue-500">
                                                Printed
                                            </span>
                                        @else
                                            <span
                                                class="mt-1 py-0.5 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-slate-100 text-slate-800 rounded-full dark:bg-slate-500/10 dark:text-slate-400">
                                                Not printed
                                            </span>
                                        @endif
                                    @else
                                        <span
                                            class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-500/10 dark:text-yellow-500">
                                            <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                            Warning
                                        </span>
                                    @endif
                                </div>
                                <div class=" flex gap-3  col-span-2">
                                    @if (!$item->pivot->isResultAdded)
                                        @if (auth()->user()?->isAdmin())
                                            <a href="{{ route('addResults', ['patientId' => $patient->id, 'testId' => $item->id]) }}"
                                                type="button"
                                                class="py-1 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                Add Result
                                            </a>
                                            <button type="button" wire:confirm wire:click='delTest({{ $item->id }})'
                                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                                X
                                            </button>
                                        @endif
                                    @else
                                        @if (auth()->user()?->isAdmin())
                                            <a href="{{ route('editreport', ['patientId' => $patient->id, 'testId' => $item->id]) }}"
                                                type="button"
                                                class="py-0 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                Edit
                                            </a>
                                        @endif
                                        <a target="__blank" href="{{ route('showreport', $item->pivot->id) }}"
                                            type="button"
                                            class="py-1 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                                            Header
                                        </a>
                                        <a target="__blank" href="{{ route('noheaderreport', $item->pivot->id) }}"
                                            type="button"
                                            class="py-1 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                            No Header
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @if ($testField)

                            <form class="flex justify-center items-center" wire:submit='add'>
                                <div class=" flex-1">
                                    <label for="hs-select-label" class="block text-sm font-medium mb-2 ">Test</label>
                                    <select id="hs-select-label" wire:model='test'
                                        class="py-3 px-4 pe-9 block  w-[95%] p-2 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                        @foreach ($tests as $test)
                                            <option value="{{ $test->id }}">{{ $test->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div>
                                    <button type="submit"
                                        class="py-2 px-3 mt-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                        Add
                                    </button>
                                </div>


                            </form>
                        @endif


                        <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>


                    </div>
                </div>
                <!-- End Table -->

                <!-- Flex -->
                <div class="mt-8 flex sm:justify-end">
                    <div class="w-full max-w-2xl sm:text-end space-y-2">
                        <!-- Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                            {{-- <dl class="grid sm:grid-cols-5 gap-x-3">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Subtotal:</dt>
                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$2750.00</dd>
              </dl> --}}

                            {{-- <dl class="grid sm:grid-cols-5 gap-x-3">
                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Discount:</dt>
                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$50.00</dd>
              </dl> --}}

                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Total:</dt>
                                <dd class="col-span-2 text-black dark:text-neutral-500">Rs {{ $total }}</dd>
                            </dl>
                        </div>
                        <!-- End Grid -->
                    </div>
                </div>
                <!-- End Flex -->
                @if (auth()->user()?->isAdmin())
                    <div class="mt-6 flex justify-end gap-x-3">
                        {{-- <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-neutral-800 dark:hover:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-white dark:focus:ring-offset-gray-800" target= "_blank" href="{{ route('invoiceDownload', $patient->id)  }}">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
              Invoice PDF
            </a> --}}
                        <button wire:click="$set('testField', true)" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                            Add Test
                        </button>
                    </div>
                @endif
            </div>
            <!-- End Card -->

            <!-- Buttons -->

            <!-- End Buttons -->
        </div>
    </div>
    <!-- End Invoice -->
</div>
