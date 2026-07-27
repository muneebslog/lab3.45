<?php

namespace App\Livewire;

use App\Models\PatientTest;
use Carbon\Carbon;
use Livewire\Component;

class Reports extends Component
{
    public $reports;

    public string $dateFrom;

    public string $dateTo;

    public string $search = '';

    public string $status = 'all';

    public function mount(): void
    {
        $today = Carbon::today()->format('Y-m-d');
        $this->dateFrom = Carbon::today()->subDays(3)->format('Y-m-d');
        $this->dateTo = $today;
        $this->getData();
    }

    public function getData(): void
    {
        $query = PatientTest::query()
            ->with(['patient', 'test'])
            ->orderBy('updated_at', 'desc');

        $term = trim($this->search);
        if ($term !== '') {
            $like = '%'.$term.'%';
            $query->whereHas('test', function ($q) use ($like) {
                $q->where('name', 'like', $like)
                    ->orWhere('code', 'like', $like)
                    ->orWhere('short_hand', 'like', $like);
            });
        }

        match ($this->status) {
            'pending' => $query->where('isResultAdded', 0),
            'completed' => $query->where('isResultAdded', 1)->whereBetween('updated_at', $this->dateRange()),
            'printed' => $query->where('isResultAdded', 1)->where('isPrinted', 1)->whereBetween('updated_at', $this->dateRange()),
            default => $this->applyAllStatus($query),
        };

        $this->reports = $query->get();
    }

    /**
     * For "all" status: show pending tests regardless of date, plus completed
     * tests whose result-entry date falls inside the selected range.
     */
    protected function applyAllStatus($query): void
    {
        [$from, $to] = $this->dateRange();

        $query->where(function ($q) use ($from, $to) {
            $q->where('isResultAdded', 0)
                ->orWhere(function ($sub) use ($from, $to) {
                    $sub->where('isResultAdded', 1)
                        ->whereBetween('updated_at', [$from, $to]);
                });
        });
    }

    /**
     * @return array{0: Carbon, 1: Carbon}
     */
    protected function dateRange(): array
    {
        $from = Carbon::parse($this->dateFrom)->startOfDay();
        $to = Carbon::parse($this->dateTo)->endOfDay();

        if ($from->gt($to)) {
            [$from, $to] = [$to->copy()->startOfDay(), $from->copy()->endOfDay()];
        }

        return [$from, $to];
    }

    public function updatedDateFrom(): void
    {
        $this->getData();
    }

    public function updatedDateTo(): void
    {
        $this->getData();
    }

    public function updatedSearch(): void
    {
        $this->getData();
    }

    public function updatedStatus(): void
    {
        $this->getData();
    }

    public function render()
    {
        return view('livewire.reports');
    }
}
