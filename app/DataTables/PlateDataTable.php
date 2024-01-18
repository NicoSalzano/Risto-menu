<?php

namespace App\DataTables;

use App\Models\Category;
use App\Models\Plate;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PlateDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query){
            $infoBtn = "<a href='".route('admin.piatti.show', $query->id)."' class='btn btn-info mr-2'>Info</a>";
            $editBtn = "<a href='".route('admin.piatti.edit', $query->id)."' class='btn btn-warning'>Edit</a>";
            $deleteBtn = "<a href='".route('admin.piatti.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item'>Cancella</a>";
            
           return $infoBtn.$editBtn.$deleteBtn;
        })
        ->addColumn('Img', function($query){
            return $img = "<img width='80' src='".asset($query->image)."'></img>";
        })
        ->addColumn('not_available', function($query){
            $active = '<i class="badge badge-success">Disponibile</i>';
            $inactive = '<i class="badge badge-danger">Non disponibile</i>';
            if ($query->status == 1) {
                return $active;
            }else {
                return $inactive;   
            }
        })
        ->addColumn('status', function($query){
            if ($query->status == 1) {
                $button = '<label class="custom-switch mt-2">
                <input type="checkbox" checked name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
              </label>';  
            }else{
                $button = '<label class="custom-switch mt-2">
                <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
              </label>';
            }
            
          return $button;
        })

        ->rawColumns(['Img','action','not_available','status'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Plate $model, Category $cate): QueryBuilder
    {
        return $model->newQuery()->with('category');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('plate-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0, 'asc')
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            
            Column::make('id'),
            Column::make('Img')->width(100),
            Column::make('name')->title('Nome'),
            Column::make('category.name')->title('Categoria'),
            Column::make('price')->title('Prezzo'),
            Column::make('status')->title('Stato*'),
            Column::make('not_available')->title('Disponibilità**')->width(60),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(300)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Plate_' . date('YmdHis');
    }
}
