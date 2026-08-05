{{-- PDF-safe markup (tables + inline styles). Mirrors livewire/partials/report-body.blade.php for DomPDF. --}}
<table width="100%" cellspacing="0" cellpadding="0" style="border-top: 1px solid #111; border-bottom: 1px solid #111; margin: 0 0 12px 0;">
    <tr valign="top">
        <td style="width: 42%; padding: 8px 12px 8px 0;">
            <table width="100%" cellspacing="0" cellpadding="2">
                <tr>
                    <td style="font-weight: bold; font-size: 12px;">Patient Name</td>
                    <td style="font-size: 12px; text-align: right; text-transform: uppercase;">{{ $data->patient->name }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 12px;">Receipt Number</td>
                    <td style="font-size: 12px; text-align: right;">{{ $data->patient->receipt_no }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 12px;">Age:</td>
                    <td style="font-size: 12px; text-align: right;">{{ $data->patient->age }} {{ $data->patient->age_unit }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 12px;">Sample Date</td>
                    <td style="font-size: 12px; text-align: right;">{{ $data->patient->created_at->format('d M Y') }}</td>
                </tr>
            </table>
        </td>
        <td style="width: 16%; padding: 8px 6px; text-align: center; vertical-align: middle;">
            @php
                $qrSrc = \App\Support\QrPng::dataUri(
                    route('guest.invoice', ['invoice_number' => $data->patient->receipt_no]),
                    112
                );
            @endphp
            @if ($qrSrc)
                <img src="{{ $qrSrc }}" width="56" height="56" alt="Track online" style="display: inline-block;"/>
            @endif
            <div style="font-family: DejaVu Serif, serif; font-size: 10px; text-align: center; margin-top: 4px;">Track Online</div>
        </td>
        <td style="width: 42%; padding: 8px 0 8px 12px;">
            <table width="100%" cellspacing="0" cellpadding="2">
                <tr>
                    <td style="font-weight: bold; font-size: 12px;">Reffered By</td>
                    <td style="font-size: 12px; text-align: right;">{{ $data->patient->doctor }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 12px;">Sex</td>
                    <td style="font-size: 12px; text-align: right; text-transform: capitalize;">{{ $data->patient->gender }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 12px;">Phone</td>
                    <td style="font-size: 12px; text-align: right;">{{ $data->patient->phone }}</td>
                </tr>
                <tr>
                    <td style="font-size: 12px;">Report Date:</td>
                    <td style="font-size: 12px; text-align: right;">{{ $data->patient->updated_at->format('d M Y') }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div style="width: 100%; max-width: 100%;">
    <h2 style="font-size: 16px; font-weight: bold; text-decoration: underline; text-transform: uppercase; text-align: center; margin: 6px 0 4px 0; font-family: DejaVu Serif, serif;">
        {{ $data->test->department }} Reports
    </h2>
    <h2 style="font-size: 16px; font-weight: bold; text-decoration: underline; text-align: left; margin: 4px 0 10px 0; font-family: DejaVu Serif, serif;">
        {{ $data->test->name }} @if ($data->test->short_hand)
            ( {{ $data->test->short_hand }} )
        @endif
    </h2>

    @php
        $codes = json_decode(file_get_contents(public_path('test_codes.json')), true);
    @endphp

    @if ($data->test->code == 1122)
        <table width="100%" cellspacing="0" cellpadding="0">
            <tr valign="top">
                <td style="width: 50%; padding-right: 8px;">
                    <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th colspan="2" style="padding: 8px 10px; background-color: #e5e7eb; color: #4b5563; border: 1px solid #d1d5db; text-align: left; font-size: 11px; text-transform: uppercase;">
                                    PHYSICAL EXAMINATION
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->testResults as $i => $item)
                                @if ($item->testField->id > 39 && $item->testField->id < 53)
                                    <tr>
                                        <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">{{ $item->testField->field_name }}</td>
                                        <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">{{ $item->result }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; padding-left: 8px;">
                    <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th colspan="3" style="padding: 8px 10px; background-color: #e5e7eb; color: #4b5563; border: 1px solid #d1d5db; text-align: left; font-size: 11px; text-transform: uppercase;">
                                    MICROSCOPIC EXAMINATION
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->testResults as $i => $item)
                                @if ($item->testField->id > 52 && $item->testField->id < 63)
                                    <tr>
                                        <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">{{ $item->testField->field_name }}</td>
                                        <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">{{ $item->result }}</td>
                                        <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">
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
                </td>
            </tr>
        </table>
    @elseif (in_array($data->test->code, $codes['codes']))
        @if ($data->test->code == 2800)
            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                <tbody style="font-weight: bold;">
                    @foreach ($data->testResults as $i => $item)
                        <tr>
                            <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">{{ $item->testField->field_name }}</td>
                            <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">{{ $item->result }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif ($data->test->code == 4232)
            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                <tbody style="font-weight: bold;">
                    @foreach ($data->testResults as $i => $item)
                        <tr>
                            <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">{{ $item->testField->field_name }}</td>
                            <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px; text-align: center;">{{ $item->result }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                        $key = strtolower(trim($item->testField->field_name));

                        return $customOrder[$key] ?? 999;
                    })
                    ->values();
            @endphp

            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                <tbody style="font-weight: bold;">
                    @foreach ($sortedResults as $i => $item)
                        <tr>
                            <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">{{ $item->testField->field_name }}</td>
                            <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px; text-align: center;">{{ $item->result }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif ($data->test->code == 2831)
            @php
                $testFieldMapping = [
                    114 => 'Patient Blood Group',
                    106 => 'RH Factor',
                    105 => 'Donor Name',
                    107 => 'Age/Sex',
                    109 => 'Blood Product',
                    118 => 'Cross Match Result',
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
            <table width="100%" cellspacing="0" cellpadding="4" style="font-size: 12px; margin-bottom: 10px;">
                <tr>
                    <td>Patient Name:</td>
                    <td>{{ $data->patient->name ?? '' }}</td>
                    <td>Patient Blood Group</td>
                    <td>{{ $results['Patient Blood Group'] ?? '' }}</td>
                </tr>
                <tr>
                    <td>Patient RH Factor</td>
                    <td>{{ $results['RH Factor'] ?? '' }}</td>
                    <td>Donor Name:</td>
                    <td>{{ $results['Donor Name'] ?? '' }}</td>
                </tr>
                <tr>
                    <td>Age/Sex:</td>
                    <td>{{ $results['Age/Sex'] ?? '' }}</td>
                    <td>Donnor Blood Group</td>
                    <td>{{ $results['Patient Blood Group'] ?? '' }}</td>
                </tr>
                <tr>
                    <td>Donnor RH Factor</td>
                    <td>{{ $results['RH Factor'] ?? '' }}</td>
                    <td>Blood Product:</td>
                    <td>{{ $results['Blood Product'] ?? '' }}</td>
                </tr>
                <tr>
                    <td>Cross Match Results:</td>
                    <td colspan="3" style="font-weight: bold; font-size: 14px;">{{ $results['Cross Match Result'] ?? '' }}</td>
                </tr>
            </table>
            <h2 style="text-align: center; font-weight: bold; font-size: 14px; margin: 12px 0 8px 0;">DONORâ€™s TESTs</h2>
            <table width="100%" cellspacing="0" cellpadding="6" style="font-size: 12px;">
                @php
                    $testFields = ['HbsAg', 'Anti HCV', 'HIV', 'VDRL', 'M.P'];
                @endphp
                @foreach ($testFields as $field)
                    <tr>
                        <td style="text-align: center; width: 33%;">{{ $field }}</td>
                        <td style="text-align: center; width: 33%;">-----------------------------</td>
                        <td style="text-align: center; width: 33%;">{{ $results[$field] ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                <tbody style="font-weight: bold;">
                    @foreach ($data->testResults as $i => $item)
                        <tr>
                            <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">{{ $item->testField->field_name }}</td>
                            <td style="padding: 5px 10px; border: 1px solid #d1d5db; font-size: 12px;">{{ $item->result }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @elseif ($data->test->code == 2802)
        <div style="padding: 4px 0;">
            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse; font-size: 12px;">
                <thead>
                    <tr>
                        <th style="padding: 8px; border: 1px solid #d1d5db; text-align: left;">Type</th>
                        <th style="padding: 8px; border: 1px solid #d1d5db; text-align: center;">1:20</th>
                        <th style="padding: 8px; border: 1px solid #d1d5db; text-align: center;">1:40</th>
                        <th style="padding: 8px; border: 1px solid #d1d5db; text-align: center;">1:80</th>
                        <th style="padding: 8px; border: 1px solid #d1d5db; text-align: center;">1:160</th>
                        <th style="padding: 8px; border: 1px solid #d1d5db; text-align: center;">1:320</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grouped = collect($data->testResults)
                            ->mapWithKeys(
                                fn ($r) => [
                                    $r->testField->field_name => $r->result,
                                ],
                            )
                            ->groupBy(function ($_, $key) {
                                return \Illuminate\Support\Str::before($key, ' 1:');
                            });
                    @endphp

                    @foreach ($grouped as $type => $values)
                        <tr>
                            <td style="padding: 8px; border: 1px solid #d1d5db; font-weight: 600;">{{ $type }}</td>
                            @foreach (['1:20', '1:40', '1:80', '1:160', '1:320'] as $titer)
                                @php
                                    $key = "$type $titer";
                                    $res = $values->get($key, '-');
                                @endphp
                                <td style="padding: 8px; border: 1px solid #d1d5db; text-align: center;">{{ $res }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="border: 1px solid #d1d5db; padding: 8px 12px; margin-top: 10px; font-size: 10px;">
                <p style="font-weight: bold; margin: 0 0 6px 0;">Note:</p>
                <ol style="margin: 0; padding-left: 16px;">
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
                    <li style="font-style: italic;">Test conducted on serum.</li>
                </ol>
            </div>
        </div>
    @else
        @php
            $reportBodyPdfTimeToSeconds = function (string $time): int {
                [$minutes, $seconds] = explode(':', $time);

                return (int) $minutes * 60 + (int) $seconds;
            };
        @endphp

        <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="padding: 6px 10px; background-color: #e5e7eb; color: #4b5563; border-top: 1px solid #d1d5db; border-bottom: 1px solid #d1d5db; border-left: 1px solid #d1d5db; text-align: left; font-size: 10px; font-weight: bold; text-transform: uppercase;">
                        Test Name
                    </th>
                    <th style="padding: 6px 10px; background-color: #e5e7eb; color: #4b5563; border-top: 1px solid #d1d5db; border-bottom: 1px solid #d1d5db; border-left: 1px solid #d1d5db; text-align: left; font-size: 10px; font-weight: bold; text-transform: uppercase;">
                        Normal Value
                    </th>
                    <th style="padding: 6px 10px; background-color: #e5e7eb; color: #4b5563; border-top: 1px solid #d1d5db; border-bottom: 1px solid #d1d5db; border-left: 1px solid #d1d5db; text-align: left; font-size: 10px; font-weight: bold; text-transform: uppercase;">
                        Unit
                    </th>
                    <th style="padding: 6px 6px; background-color: #e5e7eb; color: #4b5563; border-top: 1px solid #d1d5db; border-bottom: 1px solid #d1d5db; border-left: 1px solid #d1d5db; text-align: left; font-size: 10px; font-weight: bold; text-transform: uppercase; width: 28px;">
                    </th>
                    <th style="padding: 6px 10px; background-color: #e5e7eb; color: #4b5563; border-top: 1px solid #d1d5db; border-bottom: 1px solid #d1d5db; border-left: 1px solid #d1d5db; border-right: 1px solid #d1d5db; text-align: left; font-size: 10px; font-weight: bold; text-transform: uppercase;">
                        Result
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->testResults as $i => $item)
                    @php
                        $isTimeBased = strtolower($item->testField->unit) === 'minutes:seconds';
                        $resultInSeconds = $isTimeBased ? $reportBodyPdfTimeToSeconds($item->result) : $item->result;

                        $minValue = $item->testField->min_value;
                        $maxValue = $item->testField->max_value;

                        if ($item->testField->multiple_ranges == 1) {
                            $genderRange = $item->testField->normalRanges
                                ->where('gender', $data->patient->gender)
                                ->first();

                            if (! $genderRange) {
                                $genderRange = $item->testField->normalRanges->where('gender', 'all')->first();
                            }

                            if ($genderRange) {
                                $minValue = $genderRange->min_value;
                                $maxValue = $genderRange->max_value;
                            }
                        }

                        $minValueInSeconds = $isTimeBased ? $reportBodyPdfTimeToSeconds($minValue) : $minValue;
                        $maxValueInSeconds = $isTimeBased ? $reportBodyPdfTimeToSeconds($maxValue) : $maxValue;

                        $status =
                            $resultInSeconds < $minValueInSeconds
                                ? 'L'
                                : ($resultInSeconds > $maxValueInSeconds
                                    ? 'H'
                                    : null);
                        $isOutOfRange = $status !== null;
                    @endphp

                    <tr>
                        <td style="padding: 4px 10px; font-size: 12px; vertical-align: top;">{{ $item->testField->field_name }}</td>
                        <td style="padding: 4px 10px; font-size: 12px; vertical-align: top;">{{ $minValue }} -
                            {{ $maxValue }}</td>
                        <td style="padding: 4px 10px; font-size: 12px; vertical-align: top;">{{ $item->testField->unit }}</td>
                        <td style="padding: 4px 6px; font-size: 12px; vertical-align: top; {{ $isOutOfRange ? 'font-weight: bold;' : '' }}">{{ $status }}</td>
                        <td style="padding: 4px 10px; font-size: 12px; vertical-align: top; {{ $isOutOfRange ? 'font-weight: bold;' : '' }}">{{ $item->result }}</td>
                    </tr>

                    @if ($data->test->code == 1300 && count($data->testResults) == 13 && $i == 8)
                        <tr>
                            <td colspan="5" style="padding: 4px 10px; font-size: 12px; font-weight: bold; text-decoration: underline;">
                                Differential Leukocytes Count:
                            </td>
                        </tr>
                    @endif
                    @if ($data->test->code == 1300 && count($data->testResults) == 12 && $i == 7)
                        <tr>
                            <td colspan="5" style="padding: 4px 10px; font-size: 12px; font-weight: bold; text-decoration: underline;">
                                Differential Leukocytes Count:
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif
</div>
