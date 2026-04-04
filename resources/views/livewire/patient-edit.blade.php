<div class="">
    <!-- Card Section -->
    <div class="max-w-2xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-7">
            <div class="text-red-500">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                    Edit Patient
                </h2>
                <p class="text-sm text-gray-600">
                    {{-- Manage your payment methods. --}}
                </p>
            </div>

            <form>
                <!-- Section -->
                <div>
                    <label for="af-payment-billing-contact" class="inline-block text-sm font-medium">
                        Patient Name
                    </label>
                    <div class="mt-2 space-y-3">
                        <input wire:model='name' id="af-payment-billing-contact" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="First Name">
                    </div>
                </div>
                <div>
                    <label for="af-payment-billing-contact" class="inline-block text-sm font-medium">
                        Patient Age
                    </label>
                    <div class="mt-2 space-y-3">
                        <input wire:model='age' id="af-payment-billing-contact" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="First Name">
                    </div>
                </div>
                <div>
                    <label for="af-payment-billing-contact" class="inline-block text-sm font-medium">
                        Reciept Number
                    </label>
                    <div class="mt-2 space-y-3">
                        <input wire:model='reciept' id="af-payment-billing-contact" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="First Name">
                    </div>
                </div>
                <div>
                    <label for="af-payment-billing-contact" class="inline-block text-sm font-medium">
                        Gender
                    </label>
                    <div class="mt-2 space-y-3">
                        <select wire:model='gender'
                            class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="af-payment-billing-contact" class="inline-block text-sm font-medium">
                        Phone Number
                    </label>
                    <div class="mt-2 space-y-3">
                        <input wire:model='phone' id="af-payment-billing-contact" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="First Name">
                    </div>
                </div>
                <div>
                    <label for="af-payment-billing-contact" class="inline-block text-sm font-medium">
                        Referred by
                    </label>
                    <div class="mt-2 space-y-3">
                        <select wire:model='doctor'
                            class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            id="doctor" name="doctor" required>
                            <option value="Self">Self</option>
                            <option value="Dr. Maliha Tariq">Dr. Maliha Tariq</option>
                            <option value="Dr. Sadia Sohail">Dr. Sadia Sohail</option>
                            <option value="Dr. Gul">Dr. Gul</option>
                            <option value="Dr. M. Bilal">Dr. M. Bilal</option>
                            <option value="Dr. Sohail">Dr. Sohail</option>
                            <option value="Dr. Tariq Saeed">Dr. Tariq Saeed</option>
                            <option value="Dr. M. Ahtesham">Dr. M. Ahtesham</option>
                            <option value="Dr. M. Ahmer">Dr. M. Ahmer</option>
                            <option value="Dr. Arslan">Dr. Arslan</option>
                        </select>
                    </div>
                </div>
                <div>

                </div>
                <!-- End Section -->


                <!-- End Section -->
            </form>

            <div class="mt-5 flex justify-end gap-x-2">
                <a href="{{ route('cases-list') }}"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                    Cancel
                </a>
                <button type="button" wire:click='update'
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Save changes
                </button>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Section -->
</div>
