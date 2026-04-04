@extends('invoices.letterpad')


@section('content')

<div class="max-w-4xl mx-auto bg-white  rounded-lg overflow-hidden">
    <h2 class=" text-xl underline my-3 text-center text-bold font-serif">
        HEMATOLOGY REPORT
    </h2>
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-l border-gray-300 text-left text-sm uppercase">
                    Test Name
                </th>
                <th class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">
                    Normal Value
                </th>
                <th class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-t border-gray-300 text-left text-sm uppercase">
                    Unit
                </th>
                <th class="px-6 py-2 bg-gray-200 text-gray-600 border-b border-r border-t border-gray-300 text-left text-sm uppercase">
                    Result
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                    WBC
                </td>
                <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                    4 – 11
                </td>
                <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                    x10^9/l
                </td>
                <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                    7.5
                </td>
            </tr>

            <tr>
                <td colspan="4" class="px-6 py-1 whitespace-no-wrap  font-bold underline  border-gray-300">
                    Differential Leukocytes Count:
                </td>
            </tr>
            <tr>
                <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                    Neutrophils
                </td>
                <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                    40 – 75
                </td>
                <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                    %
                </td>
                <td class="px-6 py-1 whitespace-no-wrap  border-gray-300">
                    58
                </td>
            </tr>


        </tbody>
    </table>
</div>

@endsection
