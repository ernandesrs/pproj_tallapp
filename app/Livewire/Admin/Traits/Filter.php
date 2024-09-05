<?php

namespace App\Livewire\Admin\Traits;
use Livewire\Attributes\Url;

trait Filter
{
    /**
     * Limit of list
     * @var int
     */
    #[Url()]
    public int $quantity = 15;

    /**
     * Search term
     * @var null|string
     */
    #[Url(except: '', nullable: false)]
    public null|string $search = null;

    /**
     * Filter by select values
     *
     * @var array
     */
    #[Url(except: '', nullable: false)]
    public array $selects = [];

    /**
     * Filter by periods
     *
     * @var array
     */
    #[Url()]
    public array $periods = [];

    /**
     * Filter selects
     * @return array array with fields, like:
     * [
     *   [
     *     'index' => 'gender',
     *     'label' => 'Gender',
     *     'options' => [
     *       ['label'=>'Famale','value'=>'f'],
     *       ['label'=>'Male','value'=>'m']
     *     ]
     *   ]
     * ]
     */
    abstract static public function filterSelects(): array;

    /**
     * Filter by periods
     * @return array array with fields, like:
     * [
     *   [
     *     'index' => 'created_at',
     *     'label' => 'Created at',
     *   ],
     *   [
     *     'index' => 'other_field',
     *     'label' => 'Other field',
     *   ]
     * ]
     */
    abstract static public function filterPeriods(): array;

    /**
     * Check if is filtring
     * @return bool
     */
    public function isFiltering()
    {
        return count($this->selects) || count($this->periods) ? true : false;
    }

    /**
     * Apply filter
     * @return void
     */
    public function applyFilters()
    {
    }

    /**
     * Clear filters
     * @return void
     */
    public function clearFilters()
    {
        $this->selects = [];
        $this->periods = [];
    }

    /**
     * Validate filter values
     * @return array valid datas
     */
    private function validateFilters()
    {
        $validator = \Validator::make([
            'quantity' => $this->quantity,
            'search' => $this->search,
            'selects' => $this->selects,
            'periods' => $this->periods
        ], [
            'quantity' => ['required', 'numeric', \Illuminate\Validation\Rule::in([5, 10, 15, 20, 25])],

            // search rules
            'search' => ['required', 'string'],

            // select rules
            'selects.*' => [
                'required',
                function ($attr, $val, $fail) {
                    $index = explode(".", $attr)[1] ?? null;

                    $r = collect(self::filterSelects())->first(fn($i) => $i['index'] == $index);
                    if ($r && isset($r['options'])) {
                        if (!\Illuminate\Validation\Rule::in(collect($r['options'])->map(fn($o) => $o['value']))) {
                            $fail('Invalid option');
                            return;
                        }
                    }
                }
            ],

            // period rules
            'periods.*.start' => ['required', 'string', 'date'],
            'periods.*.end' => ['required', 'string', 'date'],
        ]);

        return $validator->valid();
    }
}
