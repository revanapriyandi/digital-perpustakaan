<?php

namespace App\Http\Livewire\Pages\Books;

use App\Models\Book;
use Faker\Core\File;
use App\Models\CategoryBook;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;

class TableBooks extends DataTableComponent
{
    protected $model = Book::class;

    public array $books = [];

    public $columnSearch = [
        'title',
        'categoryName',
    ];

    public function builder(): Builder
    {
        return Book::query()
            ->with(['category'])
            ->where('created_by', auth()->id())
            ->orderBy('created_at', 'desc');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayoutSlideDown()
            ->setUseHeaderAsFooterEnabled()
            ->setHideBulkActionsWhenEmptyEnabled()
            ->setBulkActionsTdCheckboxAttributes([
                'class' => 'dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400',
            ])
            ->setLoadingPlaceholderStatus(true)
            ->setLoadingPlaceholderEnabled()
            ->setTableRowUrl(function ($row) {
                return route('books.edit', $row);
            })
            ->setBulkActionConfirmMessages([
                'delete' => 'Are you sure you want to delete these items?',
            ]);
    }

    public function columns(): array
    {
        return [
            Column::make('#')
                ->label(
                    fn ($row, Column $column) => view('components.datatables.action-column')->with(
                        [
                            'show' => '$dispatch(\'showForm\', [' . $row->id . ', \'true\'])',
                            'edit' => '$dispatch(\'showEditForm\', [' . $row->id . '])',
                            'delete' => '$dispatch(\'deleteData\', [' . $row->id . '])',
                        ]
                    )
                )->html()
                ->unclickable(),
            ImageColumn::make('Cover')
                ->location(function ($row) {
                    return $row->cover_url;
                })
                ->attributes(function ($row) {
                    return [
                        'class' => 'h-auto rounded-lg',
                    ];
                })
                ->unclickable(),
            Column::make("File Pdf", 'media_pdf')
                ->label(function ($row) {
                    return view('components.datatables.action-column')->with(
                        [
                            'download' => '$dispatch(\'downloadFile\', [' . $row->id . '])',
                        ]
                    );
                })
                ->html()
                ->unclickable(),
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Category Book", "category.name")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return substr($value, 0, 20) . '...';
                }),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Book Status')
                ->setFilterPillTitle('Book Status')
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

            SelectFilter::make(' Category Book')
                ->options(
                    CategoryBook::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($category) => $category->name)
                        ->toArray()
                )->filter(function (Builder $builder, string $value) {
                    $builder->where('category_book_id', $value);
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
            'delete' => 'Delete',
        ];
    }


    public function activate()
    {
        flash()->addPreset('success', ['message' => 'Success activate']);
        CategoryBook::whereIn('id', $this->getSelected())->update(['is_active' => true]);

        $this->clearSelected();
    }

    public function deactivate()
    {
        flash()->addPreset('success', ['message' => 'Success deactivate']);
        CategoryBook::whereIn('id', $this->getSelected())->update(['is_active' => false]);

        $this->clearSelected();
    }

    public function delete()
    {
        flash()->addPreset('success', ['message' => 'Success delete']);
        CategoryBook::whereIn('id', $this->getSelected())->delete();

        $this->clearSelected();
    }
}
