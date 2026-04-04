<div class=" flex justify-center items-center gap-2 m-4 p-3 w-full h-full">
    {{-- Do your work, then step back. --}}
    <div class=" min-w-[90vh] max-w-[90vh] ">
        <h1 class=" text-xl font-bold text-center">New Case</h1>
        <br>
        <x-filament::section>
            <x-slot name="heading">
                Patient details
            </x-slot>
            <x-filament::input.wrapper>
                <x-filament::input type="text" wire:model="name" required placeholder="Name"
                    class=" placeholder:text-gray-700" />
            </x-filament::input.wrapper>
            <br>
            <x-filament::input.wrapper>
                <x-filament::input type="number" wire:model="age" required placeholder="Age"
                    class=" placeholder:text-gray-700" />
            </x-filament::input.wrapper>
            <br>
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </x-filament::input.select>
            </x-filament::input.wrapper>
            <br>
            <div>
                <x-filament::input.wrapper>
                    <x-filament::input type="number" minlength="11" wire:model='phone' min="11" id="phoneInput" placeholder="Phone Number"
                        class="placeholder:text-gray-700" />
                </x-filament::input.wrapper>

                <p id="phoneDigitsCount">Phone Digits: 0</p>
            </div>

            @error('phone')
                <p class="m-2 p-1 bg-red-600 text-white">{{ $message }}</p>
            @enderror


            {{-- Content --}}
        </x-filament::section>
        <br>
        <x-filament::section>
            <x-slot name="heading">
                Test details
            </x-slot>
            <div class="">
                <form class=" flex justify-between gap-6 m-4  mt-0" wire:submit='findTest'>
                    <div class="bv w-full space-y-3">
                        <input type="text" wire:model='param'
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Enter Test code or Short Hand">
                    </div>
                    <x-filament::button size="sm" type='submit' color="success" class=" bg-green-400 text-black">
                        Add
                    </x-filament::button>
                </form>
                @if ($tests)

                    <div class="flex flex-col" >
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Code</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Short Hand</th>
                                                    <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Price</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                            @forelse ($tests as $item)
                                                <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                        {{ $item['name'] }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ $item['code'] }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ $item['short_hand'] }}</td>
                                                        <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ $item['price'] }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                        <button type="button"  wire:click='delTest({{ $item['id'] }})'
                                                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400">Delete</button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>Nothing here</td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                        <h2 class=" p-3">

                            Total={{ $total }}
                        </h2>
                    </div>
                @endif

            </div>

            {{-- Content --}}
        </x-filament::section>

        <br>
        <x-filament::button size="lg" wire:click='save' color="success" class=" bg-green-400 text-black"
            icon="heroicon-m-sparkles">
            Add Case
        </x-filament::button>



    </div>
    <script>
        // Get the input element and the paragraph for displaying count
        const phoneInput = document.getElementById('phoneInput');
        const phoneDigitsCount = document.getElementById('phoneDigitsCount');

        // Add an event listener to the input field to count digits on input change
        phoneInput.addEventListener('input', function() {
            const phoneValue = phoneInput.value.trim(); // Get input value and trim whitespace

            // Update the paragraph text with the count of digits
            phoneDigitsCount.textContent = `Phone Digits: ${phoneValue.length}`;
        });
    </script>

    @script
    <script>
      $wire.on('error', (e) => {
       alert(e);
      });
    </script>
    @endscript


</div>
