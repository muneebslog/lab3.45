<div>
    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="sm:w-11/12 lg:w-3/4 mx-auto">
            <div class="flex flex-col p-4 sm:p-10 bg-white shadow-md rounded-xl dark:bg-neutral-800">
                <div class="flex justify-between">
                    <div>
                        <div class="grid grid-cols-2 grid-rows-2 gap-1">
                            <div class="row-span-2">
                                <h1 class="mt-2 text-6xl font-semibold text-blue-900 dark:text-white">Mohsin</h1>
                            </div>
                            <div class="flex items-end">
                                <p class="font-semibold text-blue-900">Clinical</p>
                            </div>
                            <div class="col-start-2 row-start-2 flex items-start">
                                <p class="font-semibold text-blue-900">Laboratory</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        {{ QrCode::size(60)->generate(\Illuminate\Support\Facades\URL::signedRoute('guest.invoice', ['patient' => $patient->id])) }}
                    </div>
                </div>

                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-neutral-200 text-center mt-4">Invoice</h2>

                <div class="mt-8 grid sm:grid-cols-2 gap-3">
                    <div>
                        <dl class="grid sm:grid-cols-5 gap-x-3 mb-1">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Medical Record #:</dt>
                            <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                {{ $patient->created_at->format('d-m-Y') }}-{{ $patient->id }}
                            </dd>
                        </dl>
                        <dl class="grid sm:grid-cols-5 mt-1">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Name:</dt>
                            <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $patient->name }}</dd>
                        </dl>
                        <dl class="grid sm:grid-cols-5">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Gender:</dt>
                            <dd class="col-span-2 text-gray-500 dark:text-neutral-500 capitalize">{{ $patient->gender }}</dd>
                        </dl>
                    </div>

                    <div class="sm:text-end space-y-2">
                        <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Invoice Date:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                    {{ $patient->created_at->format('d F Y') }}
                                </dd>
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
                    </div>
                </div>

                <div class="mt-6">
                    <div class="border border-gray-200 p-4 rounded-lg space-y-4 dark:border-neutral-700">
                        <div class="hidden sm:grid sm:grid-cols-6">
                            <div class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Test</div>
                            <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Rate</div>
                            <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Status</div>
                            <div class="text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 text-center">Actions</div>
                        </div>

                        <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700"></div>

                        @foreach ($patient->tests as $item)
                            <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                                <div class="col-span-full sm:col-span-2">
                                    <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Item</h5>
                                    <p class="font-medium text-gray-800 dark:text-neutral-200">{{ $item->name }}</p>
                                </div>
                                <div>
                                    <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Rate</h5>
                                    <p class="text-gray-800 dark:text-neutral-200">{{ $item->price }}</p>
                                </div>
                                <div>
                                    @if ($item->pivot->isResultAdded)
                                        <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                            <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                            </svg>
                                            Active
                                        </span>
                                    @else
                                        <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-500/10 dark:text-yellow-500">
                                            <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                            Warning
                                        </span>
                                    @endif
                                </div>
                                <div class="flex flex-wrap gap-2 col-span-2 sm:col-span-2 justify-start sm:justify-center">
                                    @if ($item->pivot->isResultAdded)
                                        <a
                                            href="{{ route('showreport', $item->pivot->id) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="py-1 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700"
                                        >
                                            Show
                                        </a>
                                        <a
                                            href="{{ route('report.pdf.header', $item->pivot->id) }}"
                                            class="py-1 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700"
                                        >
                                            PDF
                                        </a>
                                    @else
                                        <span class="py-1 px-2 text-sm text-gray-500 dark:text-neutral-400">—</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>
                    </div>
                </div>

                <div class="mt-8 flex sm:justify-end">
                    <div class="w-full max-w-2xl sm:text-end space-y-2">
                        <dl class="grid sm:grid-cols-5 gap-x-3">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Total:</dt>
                            <dd class="col-span-2 text-black dark:text-neutral-500">Rs {{ $total }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
