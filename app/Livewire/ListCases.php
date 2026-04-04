<?php

namespace App\Livewire;

use App\Models\Patient;
use Carbon\Carbon;
use Livewire\Component;

class ListCases extends Component
{
    public $patients;

    public string $dateFrom;

    public string $dateTo;

    public string $search = '';

    public bool $pendingOnly = false;

    public function mount(): void
    {
        $today = Carbon::today()->format('Y-m-d');
        $this->dateFrom = $today;
        $this->dateTo = $today;
        $this->getData();
    }

    public function getData(): void
    {
        $from = Carbon::parse($this->dateFrom)->startOfDay();
        $to = Carbon::parse($this->dateTo)->endOfDay();

        if ($from->gt($to)) {
            $from = Carbon::parse($this->dateTo)->startOfDay();
            $to = Carbon::parse($this->dateFrom)->endOfDay();
        }

        $query = Patient::query()
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')
            ->with('tests');

        $term = trim($this->search);
        if ($term !== '') {
            $like = '%'.$term.'%';
            $query->where(function ($q) use ($like) {
                $q->where('name', 'like', $like)
                    ->orWhere('phone', 'like', $like);
            });
        }

        if ($this->pendingOnly) {
            $query->whereHas('tests', function ($q) {
                $q->where('patient_test.isResultAdded', 0);
            });
        }

        $this->patients = $query->get();
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

    public function updatedPendingOnly(): void
    {
        $this->getData();
    }

    public function render()
    {
        return view('livewire.list-cases');
    }
}
