<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class UserTable extends PowerGridComponent
{
    use WithExport;
    public $role_id;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        if (in_array($this->role_id, [2, 3])) {
            return User::whereNot('role_id', 1)->where('role_id', $this->role_id)->with('role');
        } else {
            return User::whereNot('role_id', 1)->with('role');
        }
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('manager', function (User $user) {
                return strtoupper(User::find($user->manager_id)->name);
            })
            ->add('role', function (User $user) {
                return strtoupper($user->role->role_name);
            });
    }

    public function columns(): array
    {
        return [
            // Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),



            Column::make('Reports To', 'manager'),
            Column::make('Role', 'role'),


            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId)
    {
        // $this->js('alert(' . $rowId . ')');
        return redirect()->route('editUser', ['userId' => $rowId]);
    }
    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId)
    {
        $this->js('alert("This will delete, user: ' .  strtoupper(User::find($rowId)->name) . '")');
        User::find($rowId)->delete();
        $this->dispatch('$refresh');
    }

    public function actions(User $row): array
    {
        return [
            Button::add('email')
                ->slot('<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>')
                ->id()
                ->class('bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded')
                ->dispatch('edit', ['rowId' => $row->id]),

            Button::add('edit')
                ->slot('<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12l-6-6 1.5-1.5L18 12l-6.75 6.75L8.25 18 15 12z" />
            </svg>')
                ->id()
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded')
                ->dispatch('edit', ['rowId' => $row->id]),

            Button::add('delete')
                ->slot('<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>')
                ->id()
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded')
                ->dispatch('delete', ['rowId' => $row->id])

        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
