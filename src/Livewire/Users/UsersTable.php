<?php

namespace Nkls\Tables\Livewire\Users;

use App\Models\User;
use Nkls\Tables\Table;
use Nkls\Tables\Columns\Column;
use Nkls\Tables\Livewire\Users\UserForm;
use Illuminate\Database\Eloquent\Builder;

class UsersTable extends Table
{
    public UserForm $form;

    public function getEntityName($plural = false): string
    {
        return $plural ? 'users' : 'user';
    }

    public function config(): array
    {
        //In order for the changes to take effect, you must clear your cookies
        return [
            'tblClass' => 'table w-100 align-middle',
            // 'bulkOperations' => false,
            // 'viewPrefix' => 'tbl.',
            'mobileView' => ['layout' => 'mobile-user-cards'],
            'desktopView' => [
                'layout' => 'desktop-table',
            ],
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('users.id', 'ID')->sortable(direction: 'desc'),
            Column::make('profiles.avatar', 'Avatar')->tdTmpl('avatar')->mobile(cardHeader: true),
            Column::make('users.name', 'Name')->sortable()->searchable()->addFilter()->mobile(cardHeader: true),
            Column::make('email', 'Email')->sortable()->searchable()->addFilter()->mobile(cardHeader: true),
            Column::make('profiles.tel', 'Phone')->searchable()->addFilter(),
            Column::make('profiles.status', 'Status')->tdTmpl('status')->sortable()->mobile(cardHeader: true),
            Column::make('created_at', 'Created At')->tdTmpl('human-diff')->sortable(),
        ];
    }

    public function query(): Builder
    {
        return User::query()->leftJoin('profiles', 'profiles.user_id', '=', 'users.id');
    }
}
