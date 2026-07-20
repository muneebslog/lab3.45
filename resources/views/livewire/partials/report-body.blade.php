    <div class="flex justify-between gap-x-5   mx-4 p-1 px-3  max-w-[100vw]  border-t border-b">
        <div class=" w-1/2">


            <div class="grid grid-cols-2  ">
                <div class="font-semibold">Patient Name</div>
                <div class=" uppercase text-right">{{ $data->patient->name }}</div>
            </div>
            <div class="flex justify-between">
                <div class="font-semibold">Receipt Number</div>
                <div>{{ $data->patient->receipt_no }}</div>
            </div>
            <div class="flex justify-between">
                <div class="font-semibold row-start-3">Age:</div>
                <div class="row-start-3">{{ $data->patient->age }} {{ $data->patient->age_unit }}</div>
            </div>
            <div class="flex justify-between">
                <div class="font-semibold row-start-4">Sample Date</div>
                <div class="row-start-4">{{ $data->patient->created_at->format('d M Y') }}</div>
            </div>
        </div>

        <div class="row-span-4 flex w-1/3 flex-col justify-center items-center">
            {{ QrCode::size(60)->generate(route('guest.invoice', ['invoice_number' => $data->patient->receipt_no])) }}
            <p class="font-serif text-center">Track Online</p>
        </div>
        <div class="w-1/2">
            <div class="grid grid-cols-2 ">
                <div class="font-semibold">Reffered By</div>
                <div class=" flex justify-end">
                    {{ $data->patient->doctor }}

                </div>

            </div>

            <div class="flex justify-between">
                <div class="font-semibold col-start-4">Sex</div>
                <div class="col-start-5 capitalize">{{ $data->patient->gender }}</div>
            </div>

            <div class="flex justify-between">
                <div class="font-semibold col-start-4 row-start-3">Phone</div>
                <div class="col-start-5 row-start-3">{{ $data->patient->phone }}</div>
            </div>

            <div class="flex justify-between">
                <div class="col-start-4 row-start-4">Report Date:</div>
                <div class="col-start-5 row-start-4">{{ $data->patient->updated_at->format('d M Y') }}</div>
            </div>

        </div>

    </div>


    <div class="max-w-4xl mx-auto bg-white  rounded-lg overflow-hidden">
        <h2 class=" text-xl underline uppercase mt-1 text-center text-bold font-serif">
            {{ $data->test->department }} Reports
        </h2>
        <h2 class=" underline text-xl  my-2  text-bold font-serif">
            {{ $data->test->name }} @if ($data->test->short_hand)
                ( {{ $data->test->short_hand }} )
            @endif
        </h2>

        @php
            $codes = json_decode(file_get_contents(public_path('test_codes.json')), true);
        @endphp
        @if ($data->test->code == 1122)
            <div class=" grid grid-cols-2 gap-4">
                <div class="">
                    <table class="  w-full  leading-normal">
                        <thead>
                            <tr>
                                <th colspan="2"
                                    class="px-6  py-2 bg-gray-200 text-gray-600  border border-gray-300 text-left text-sm uppercase">
                                    PHYSICAL EXAMINATION
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->testResults as $i => $item)
                                @if ($item->testField->id > 39 && $item->testField->id < 53)
                                    <tr>
                                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                            {{ $item->testField->field_name }}

                                        </td>
                                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                            {{ $item->result }}

                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="">
                    <table class="  w-full  leading-normal">
                        <thead>
                            <tr>
                                <th colspan="3"
                                    class="px-6  py-2 bg-gray-200 text-gray-600  border border-gray-300 text-left text-sm uppercase">
                                    MICROSCOPIC EXAMINATION
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->testResults as $i => $item)
                                @if ($item->testField->id > 52 && $item->testField->id < 63)
                                    <tr>
                                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                            {{ $item->testField->field_name }}
                                        </td>
                                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                            {{ $item->result }}

                                        </td>
                                        <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                            @if (
                                                $item->testField->id == 53 ||
                                                    $item->testField->id == 54 ||
                                                    $item->testField->id == 55 ||
                                                    $item->testField->id == 58 ||
                                                    $item->testField->id == 59 ||
                                                    $item->testField->id == 60)
                                                /HPF
                                            @endif

                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @elseif (in_array($data->test->code, $codes['codes']))
            <div class="">
                <table class="  w-full  leading-normal">
                    @if ($data->test->code == 2800)
                        <tbody class="font-bold">
                            @foreach ($data->testResults as $i => $item)
                                <tr>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->testField->field_name }}

                                    </td>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->result }}


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @elseif ($data->test->code == 4232)
                        <tbody class="font-bold">
                            @foreach ($data->testResults as $i => $item)
                                <tr>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->testField->field_name }}

                                    </td>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300 text-center">

                                        {{ $item->result }}



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @elseif ($data->test->code == 4235)
                        @php
                            $customOrder = [
                                'hbsag' => 1,
                                'anti hcv' => 2,
                                'hiv' => 3,
                                'vdrl' => 4,
                            ];

                            $sortedResults = $data->testResults
                                ->sortBy(function ($item) use ($customOrder) {
                                    $key = strtolower(trim($item->testField->field_name)); // <== cleaning the name here
                                    return $customOrder[$key] ?? 999;
                                })
                                ->values(); // Optional: reindex collection
                        @endphp

                        <tbody class="font-bold">
                            @foreach ($sortedResults as $i => $item)
                                <tr>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->testField->field_name }}

                                    </td>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300 text-center">

                                        {{ $item->result }}



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @elseif ($data->test->code == 2831)
                        @php
                            $testFieldMapping = [
                                // Patient / Donor Information
                                114 => 'Patient Blood Group',
                                106 => 'RH Factor',
                                105 => 'Donor Name',
                                107 => 'Age/Sex',
                                109 => 'Blood Product',
                                118 => 'Cross Match Result',

                                // Donorâ€™s Tests
                                68 => 'HbsAg',
                                67 => 'Anti HCV',
                                100 => 'HIV',
                                111 => 'VDRL',
                                84 => 'M.P',
                            ];

                            $results = $data->testResults->mapWithKeys(function ($result) use ($testFieldMapping) {
                                $label = $testFieldMapping[$result->test_field_id] ?? null;
                                return $label ? [$label => $result->result] : [];
                            });

                        @endphp
                        <div class="grid grid-cols-4 grid-rows-4 gap-4">

                            <div>Patient Name:</div>
                            <div>{{ $data->patient->name ?? '' }}</div>
                            <div>Patient Blood Group</div>
                            <div>{{ $results['Patient Blood Group'] ?? '' }}</div>
                            <div>Patient RH Factor</div>
                            <div>{{ $results['RH Factor'] ?? '' }}</div>
                            <div>Donor Name:</div>
                            <div>{{ $results['Donor Name'] ?? '' }}</div>
                            <div>Age/Sex:</div>
                            <div>{{ $results['Age/Sex'] ?? '' }}</div>
                            <div>Donnor Blood Group</div>
                            <div>{{ $results['Patient Blood Group'] ?? '' }}</div>
                            <div>Donnor RH Factor</div>
                            <div>{{ $results['RH Factor'] ?? '' }}</div>
                            <div>Blood Product:</div>
                            <div>{{ $results['Blood Product'] ?? '' }}</div>
                            <div class="">Cross Match Results:</div>
                            <div class=" col-span-2 font-bold text-lg">{{ $results['Cross Match Result'] ?? '' }}
                            </div>
                        </div>
                        <br>
                        <h2 class="text-center mt-4 pt-4 font-bold text-lg">DONORâ€™s TESTs</h2>
                        <div class="grid grid-cols-3 grid-rows-5 mt-4 gap-5">
                            @php
                                $testFields = ['HbsAg', 'Anti HCV', 'HIV', 'VDRL', 'M.P'];
                            @endphp

                            @foreach ($testFields as $field)
                                <div class="text-center">{{ $field }}</div>
                                <div class="text-center">-----------------------------</div>
                                <div class="text-center">{{ $results[$field] ?? 'N/A' }}</div>
                            @endforeach
                        </div>

                        {{-- <div class="grid grid-cols-3 grid-rows-5 mt-4 gap-5">
                            <div class="text-center">HbsAg </div>
                            <div class=" text-center">-----------------------------</div>
                            <div class="text-center">Negative</div>
                            <div class="text-center">Anti HCV</div>
                            <div class=" text-center">-----------------------------</div>

                            <div class="text-center">Negative</div>
                            <div class="text-center">HIV</div>
                            <div class=" text-center">-----------------------------</div>

                            <div class="text-center">Negative</div>
                            <div class="text-center">VDRL</div>
                            <div class=" text-center">-----------------------------</div>

                            <div class="text-center">Negative</div>
                            <div class="text-center">M.P</div>
                            <div class=" text-center">-----------------------------</div>

                            <div class="text-center">Negative</div>
                        </div> --}}
                    @else
                        <tbody class="font-bold">
                            @foreach ($data->testResults as $i => $item)
                                <tr>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->testField->field_name }}

                                    </td>
                                    <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                                        {{ $item->result }}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif

                </table>
            </div>
        @elseif ($data->test->code == 2802)
            <div class="page mx-auto max-w-4xl overflow-hidden rounded-lg bg-white">
                <div class="p-2 pt-0">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto text-sm">
                            <thead>
                                <tr>
                                    <th class="p-3 border text-left whitespace-nowrap">Type</th>
                                    <th class="p-3 border text-center">1:20</th>
                                    <th class="p-3 border text-center">1:40</th>
                                    <th class="p-3 border text-center">1:80</th>
                                    <th class="p-3 border text-center">1:160</th>
                                    <th class="p-3 border text-center">1:320</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Group results by main antigen name (TO, TH, AO, AH, BO, BH)
                                    $grouped = collect($data->testResults)
                                        ->mapWithKeys(
                                            fn($r) => [
                                                $r->testField->field_name => $r->result,
                                            ],
                                        )
                                        ->groupBy(function ($_, $key) {
                                            return \Illuminate\Support\Str::before($key, ' 1:'); // extract like "Salmonella TO"
                                        });
                                @endphp

                                @foreach ($grouped as $type => $values)
                                    <tr class="border">
                                        <td class="p-3 border font-medium">{{ $type }}</td>
                                        @foreach (['1:20', '1:40', '1:80', '1:160', '1:320'] as $titer)
                                            @php
                                                $key = "$type $titer";
                                                $res = $values->get($key, '-');
                                            @endphp
                                            <td class="p-3 border text-center">{{ $res }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Notes -->
                    <div class="rounded border pt-2 px-4 text-xs mt-3">
                        <p class="font-semibold">Note:</p>
                        <ol class="space-y-1 text-gray-700 p-2 list-decimal list-inside">
                            <li>Titres â‰¥1:80 of â€œOâ€ antigen &amp; â‰¥1:160 of â€œHâ€ antigen for Salmonella typhi and titres
                                â‰¥1:80 of â€œHâ€ antigen for Salmonella paratyphi A &amp; B are significant.</li>
                            <li>Rising titres in paired samples taken 7â€“10 days apart are more significant than a single
                                test.</li>
                            <li>Reactive results indicate ongoing or recent infection by Salmonella spp. Confirm
                                diagnosis by Blood culture before starting antibiotics.</li>
                            <li>The reactivity varies with the disease stage, increasing till the end of the
                                4<sup>th</sup> week then decreasing.</li>
                            <li>In TAB vaccinated patients, high titres of H antibody (â‰¥1:160) may persist for months or
                                years, while O antibody disappears within 6 months.</li>
                            <li>Antibiotic treatment in the 1<sup>st</sup> week may suppress antibody response.</li>
                            <li>False positives may appear after past enteric infections or unrelated fevers (e.g.
                                Malaria, Influenza).</li>
                            <li>False negatives may occur if samples are collected too early or due to
                                immunosuppression.</li>
                            <li class="italic">Test conducted on serum.</li>
                        </ol>
                    </div>
                </div>
            </div>
        @else

        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-l border-gray-300 text-left text-sm uppercase">
                        Test Name
                    </th>
                    <th
                        class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">
                        Normal Value
                    </th>
                    <th
                        class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">
                        Unit
                    </th>
                    <th
                        class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">

                    </th>
                    <th
                        class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-r border-t border-gray-300 text-left text-sm uppercase">
                        Result
                    </th>
                </tr>
            </thead>
            @php
                // Function to convert time (Minutes:Seconds) to total seconds
                function timeToSeconds($time)
                {
                    [$minutes, $seconds] = explode(':', $time);
                    return $minutes * 60 + $seconds;
                }
            @endphp


            <tbody>
                @foreach ($data->testResults as $i => $item)
                    @php
                        // Determine if the test result is time-based or numeric
                        $isTimeBased = strtolower($item->testField->unit) === 'minutes:seconds';
                        $resultInSeconds = $isTimeBased ? timeToSeconds($item->result) : $item->result;

                        // Initialize min and max values
                        $minValue = $item->testField->min_value;
                        $maxValue = $item->testField->max_value;

                        // If multiple_ranges is enabled, fetch the gender-specific range
                        if ($item->testField->multiple_ranges == 1) {
                            $genderRange = $item->testField->normalRanges
                                ->where('gender', $data->patient->gender)
                                ->first();

                            // Fallback to the 'all' range if no gender-specific range is found
                            if (!$genderRange) {
                                $genderRange = $item->testField->normalRanges->where('gender', 'all')->first();
                            }

                            // Assign min and max from the gender-specific range
                            if ($genderRange) {
                                $minValue = $genderRange->min_value;
                                $maxValue = $genderRange->max_value;
                            }
                        }

                        // Convert min and max values to seconds if the test is time-based
                        $minValueInSeconds = $isTimeBased ? timeToSeconds($minValue) : $minValue;
                        $maxValueInSeconds = $isTimeBased ? timeToSeconds($maxValue) : $maxValue;

                        // Determine the status of the result
                        $status =
                            $resultInSeconds < $minValueInSeconds
                                ? 'L'
                                : ($resultInSeconds > $maxValueInSeconds
                                    ? 'H'
                                    : null);
                        $isOutOfRange = $status !== null;
                    @endphp

                    <tr>
                        <td class="px-6 py-1 whitespace-no-wrap border-gray-300">
                            {{ $item->testField->field_name }}
                        </td>
                        <td class="px-6 py-1 whitespace-no-wrap border-gray-300">{{ $minValue }} -
                            {{ $maxValue }}</td>
                        <td class="px-6 py-1 whitespace-no-wrap border-gray-300">{{ $item->testField->unit }}</td>
                        <td
                            class="{{ $isOutOfRange ? 'font-bold' : '' }} px-6 py-1 whitespace-no-wrap border-gray-300">
                            {{ $status }}</td>
                        <td
                            class="{{ $isOutOfRange ? 'font-bold' : '' }} px-6 py-1 whitespace-no-wrap border-gray-300">
                            {{ $item->result }}</td>
                    </tr>

                    @if ($data->test->code == 1300 && count($data->testResults) == 13 && $i == 8)
                        <tr>
                            <td colspan="4" class="px-6 py-1 whitespace-no-wrap font-bold underline border-gray-300">
                                Differential Leukocytes Count:
                            </td>
                        </tr>
                    @endif
                    @if ($data->test->code == 1300 && count($data->testResults) == 12 && $i == 7)
                        <tr>
                            <td colspan="4"
                                class="px-6 py-1 whitespace-no-wrap font-bold underline border-gray-300">
                                Differential Leukocytes Count:
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>

        </table>
        @endif



    </div>
