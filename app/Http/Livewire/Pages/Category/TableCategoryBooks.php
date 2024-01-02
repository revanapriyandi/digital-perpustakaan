<?php

namespace App\Http\Livewire\Pages\Category;

use App\Models\CategoryBook;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TableCategoryBooks extends DataTableComponent
{
    protected $model = CategoryBook::class;
    public array $categoryBooks = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayoutSlideDown()
            ->setUseHeaderAsFooterEnabled()
            ->setHideBulkActionsWhenEmptyEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make('Action')
                ->label(
                    fn ($row, Column $column) => view('components.datatables.action-column')->with(
                        [
                            'show' => '$dispatch(\'showModal\', [' . $row->id . ', \'true\'])',
                            'edit' => '$dispatch(\'showModal\', [' . $row->id . '])',
                            'delete' => '$dispatch(\'deleteData\', [' . $row->id . '])',
                        ]
                    )
                )->html(),
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make('Status', 'is_active')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return $value ? 'Active' : 'Inactive';
                }),
            Column::make("Description", "description")
                ->sortable()
                ->collapseOnMobile()
                ->format(function ($value, $column, $row) {
                    return substr($value, 0, 20) . '...';
                }),
            Column::make("Created at", "created_at")
                ->sortable(),


        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Category Status')
                ->setFilterPillTitle('Category Status')
                ->setFilterPillValues([
                    '1' => 'Active',
                    '0' => 'Inactive',
                ])
                ->options([
                    '' => 'All',
                    '1' => 'Yes',
                    '0' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('is_active', true);
                    } elseif ($value === '0') {
                        $builder->where('is_active', false);
                    }
                }),

            DateFilter::make('Created At')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('created_at', $value);
                }),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
        ];
    }


    public function activate()
    {
        CategoryBook::whereIn('id', $this->getSelected())->update(['is_active' => true]);

        $this->clearSelected();
    }

    public function deactivate()
    {
        CategoryBook::whereIn('id', $this->getSelected())->update(['is_active' => false]);

        $this->clearSelected();
    }
}
