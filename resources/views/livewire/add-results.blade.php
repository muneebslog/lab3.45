<div class="add-results-page min-h-[88vh] bg-white text-neutral-900 antialiased">
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">

        {{-- Page title --}}
        <header class="mb-10 border-b border-neutral-200 pb-8">
            <p class="text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-neutral-500">Laboratory</p>
            <h1 class="mt-2 font-serif text-3xl font-normal tracking-tight text-neutral-900 sm:text-4xl">Result entry</h1>
            <p class="mt-3 max-w-2xl text-sm leading-relaxed text-neutral-600">
                Enter values for each analyte. Indicators show when a numeric result falls outside the listed reference interval.
            </p>
            <p class="mt-2 max-w-2xl text-xs leading-relaxed text-neutral-500">
                On save, common shorthands are normalized:
                <span class="font-mono text-neutral-700">nil</span> or <span class="font-mono text-neutral-700">nill</span>
                (any case), or a lone lowercase <span class="font-mono text-neutral-700">n</span>, as <span class="text-neutral-700">Nil</span>;
                uppercase <span class="font-mono text-neutral-700">N</span> as <span class="text-neutral-700">Negative</span>;
                <span class="font-mono text-neutral-700">p</span> or <span class="font-mono text-neutral-700">P</span> as <span class="text-neutral-700">Positive</span>.
            </p>
            <p class="mt-2 max-w-2xl text-xs leading-relaxed text-neutral-500">
                Press <span class="font-mono text-neutral-700">Enter</span> in a result field to move to the next field in order (across all tests on this page). On the last result field, <span class="font-mono text-neutral-700">Enter</span> moves focus to <span class="text-neutral-700">Save results</span> for that test. You can still use Tab if you prefer.
            </p>
        </header>

        {{-- Patient context --}}
        <section class="mb-12" aria-labelledby="patient-context-heading">
            <h2 id="patient-context-heading"
                class="mb-4 text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-neutral-500">
                Patient context
            </h2>
            <div class="rounded-lg border border-neutral-200 bg-neutral-50/80 px-5 py-6 sm:px-8">
                <dl class="grid gap-x-10 gap-y-5 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="space-y-1">
                        <dt class="text-[0.7rem] font-medium uppercase tracking-wider text-neutral-500">Medical record</dt>
                        <dd class="font-mono text-sm font-medium tabular-nums text-neutral-900">
                            {{ $patient->created_at->format('d-m-Y') }}-{{ $patient->id }}
                        </dd>
                    </div>
                    <div class="space-y-1">
                        <dt class="text-[0.7rem] font-medium uppercase tracking-wider text-neutral-500">Invoice date</dt>
                        <dd class="text-sm font-medium tabular-nums text-neutral-900">
                            {{ $patient->created_at->format('d-m-Y') }}
                        </dd>
                    </div>
                    <div class="space-y-1 sm:col-span-2 lg:col-span-1">
                        <dt class="text-[0.7rem] font-medium uppercase tracking-wider text-neutral-500">Name</dt>
                        <dd class="text-base font-medium leading-snug text-neutral-900">{{ $patient->name }}</dd>
                    </div>
                    <div class="space-y-1">
                        <dt class="text-[0.7rem] font-medium uppercase tracking-wider text-neutral-500">Age</dt>
                        <dd class="text-sm font-medium tabular-nums text-neutral-900">{{ $patient->age }}</dd>
                    </div>
                    <div class="space-y-1">
                        <dt class="text-[0.7rem] font-medium uppercase tracking-wider text-neutral-500">Gender</dt>
                        <dd class="text-sm font-medium text-neutral-900">{{ $patient->gender }}</dd>
                    </div>
                    <div class="space-y-1">
                        <dt class="text-[0.7rem] font-medium uppercase tracking-wider text-neutral-500">Phone</dt>
                        <dd class="font-mono text-sm text-neutral-800">{{ $patient->phone }}</dd>
                    </div>
                </dl>
            </div>
        </section>

        {{-- Result tables per test --}}
        @foreach ($patient->tests as $test)
            <section class="mb-14 last:mb-6" aria-labelledby="test-heading-{{ $test->id }}">
                <div class="rounded-lg border border-neutral-200 bg-white shadow-sm shadow-neutral-900/5">
                    <div class="border-b border-neutral-200 px-5 py-5 sm:px-8 sm:py-6">
                        <h2 id="test-heading-{{ $test->id }}"
                            class="font-serif text-xl font-normal tracking-tight text-neutral-900 sm:text-2xl">
                            {{ $test->name }}
                        </h2>
                        <p class="mt-1 text-xs text-neutral-500">Complete all fields, then save this panel.</p>
                    </div>

                    <div class="-mx-px overflow-x-auto">
                        <table class="min-w-full divide-y divide-neutral-200 text-left">
                            <thead>
                                <tr class="bg-neutral-50/90">
                                    <th scope="col"
                                        class="whitespace-nowrap px-4 py-3.5 text-[0.65rem] font-semibold uppercase tracking-wider text-neutral-500 sm:px-6">
                                        Analyte
                                    </th>
                                    <th scope="col"
                                        class="whitespace-nowrap px-4 py-3.5 text-[0.65rem] font-semibold uppercase tracking-wider text-neutral-500 sm:px-6">
                                        Result
                                    </th>
                                    <th scope="col"
                                        class="whitespace-nowrap px-4 py-3.5 text-center text-[0.65rem] font-semibold uppercase tracking-wider text-neutral-500 sm:px-6">
                                        Flag
                                    </th>
                                    <th scope="col"
                                        class="whitespace-nowrap px-4 py-3.5 text-[0.65rem] font-semibold uppercase tracking-wider text-neutral-500 sm:px-6">
                                        Unit
                                    </th>
                                    <th scope="col"
                                        class="whitespace-nowrap px-4 py-3.5 text-[0.65rem] font-semibold uppercase tracking-wider text-neutral-500 sm:px-6">
                                        Reference interval
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-100">
                                @foreach ($test->testFields as $i => $field)
                                    <tr class="transition-colors hover:bg-neutral-50/60">
                                        <td class="whitespace-nowrap px-4 py-4 align-middle text-sm font-medium text-neutral-900 sm:px-6">
                                            {{ $field->field_name }}
                                        </td>
                                        <td class="px-4 py-3 align-middle sm:px-6">
                                            <input autocomplete="off"
                                                {{ $i == 0 ? 'autofocus' : '' }} type="text"
                                                wire:model="results.{{ $test->id }}.{{ $field->id }}"
                                                class="result-input block w-full min-w-[12rem] rounded-md border border-neutral-300 bg-white px-3 py-2.5 font-mono text-sm text-neutral-900 placeholder:text-neutral-400 focus:border-neutral-900 focus:outline-none focus:ring-1 focus:ring-neutral-900 disabled:pointer-events-none disabled:opacity-50 sm:max-w-md"
                                                placeholder="Value"
                                                data-min="{{ $field->min_value }}"
                                                data-max="{{ $field->max_value }}">
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-center align-middle sm:px-6">
                                            <span
                                                class="indicator inline-flex min-w-[1.5rem] justify-center font-mono text-xs font-semibold tabular-nums text-neutral-600"></span>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 align-middle text-sm text-neutral-700 sm:px-6">
                                            {{ $field->unit }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 align-middle font-mono text-xs tabular-nums text-neutral-600 sm:px-6">
                                            {{ $field->min_value . ' — ' . $field->max_value }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @error($error)
                        <div class="border-t border-neutral-200 px-5 py-3 sm:px-8">
                            <p class="border-l-2 border-neutral-900 pl-3 text-sm text-neutral-800">{{ $message }}</p>
                        </div>
                    @enderror

                    <div class="flex flex-col gap-3 border-t border-neutral-200 bg-neutral-50/50 px-5 py-4 sm:flex-row sm:items-center sm:justify-end sm:px-8">
                        <button wire:click="save({{ $test->id }})" type="button"
                            class="result-save-btn inline-flex w-full items-center justify-center px-5 py-2.5 text-sm font-semibold tracking-wide text-white transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-neutral-900 focus-visible:ring-offset-2 sm:w-auto bg-neutral-900 hover:bg-neutral-800">
                            Save results
                        </button>
                    </div>
                </div>
            </section>
        @endforeach
    </div>

    <script>
        const resultInputs = document.querySelectorAll('.result-input');

        document.addEventListener('keydown', function(e) {
            if (e.key !== 'Enter' || e.shiftKey || e.ctrlKey || e.metaKey || e.altKey) {
                return;
            }
            const el = e.target;
            if (!el.classList?.contains('result-input') || !el.closest('.add-results-page')) {
                return;
            }
            e.preventDefault();
            const inputs = [...document.querySelectorAll('.add-results-page .result-input')];
            const idx = inputs.indexOf(el);
            if (idx === -1) {
                return;
            }
            if (idx < inputs.length - 1) {
                inputs[idx + 1].focus();
                inputs[idx + 1].select();
            } else {
                const saveBtn = el.closest('section')?.querySelector('.result-save-btn');
                saveBtn?.focus();
            }
        }, true);

        resultInputs.forEach(input => {
            input.addEventListener('input', function() {
                const minValue = parseFloat(input.getAttribute('data-min'));
                const maxValue = parseFloat(input.getAttribute('data-max'));
                const enteredValue = parseFloat(input.value.trim());
                const indicator = input.closest('tr').querySelector('.indicator');

                const setNeutral = () => {
                    input.classList.remove('border-neutral-800', 'ring-1', 'ring-neutral-400', 'border-neutral-500');
                    input.classList.add('border-neutral-300');
                };

                if (input.value.trim() === '' || isNaN(enteredValue) || isNaN(minValue) || isNaN(maxValue)) {
                    setNeutral();
                    indicator.textContent = '';
                    return;
                }

                if (enteredValue < minValue) {
                    input.classList.remove('border-neutral-300', 'border-neutral-500', 'ring-1', 'ring-neutral-400');
                    input.classList.add('border-neutral-800');
                    indicator.textContent = 'L';
                } else if (enteredValue > maxValue) {
                    input.classList.remove('border-neutral-300', 'border-neutral-800');
                    input.classList.add('border-neutral-500', 'ring-1', 'ring-neutral-400');
                    indicator.textContent = 'H';
                } else {
                    setNeutral();
                    indicator.textContent = '';
                }
            });
        });
    </script>
    @script
        <script>
            $wire.on('message', (e) => {
                alert(e);
            });
        </script>
    @endscript
</div>
