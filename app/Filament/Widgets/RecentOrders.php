<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentOrders extends TableWidget
{
    protected function getHeading(): string
    {
        return __('widgets.recent_orders.heading');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Order::latest())
            ->columns([
                TextColumn::make('id')->label(__('widgets.recent_orders.id')),
                TextColumn::make('name')->label(__('widgets.recent_orders.customer')),
                TextColumn::make('total')->label(__('widgets.recent_orders.total')),
                TextColumn::make('status')->label(__('widgets.recent_orders.status')),
                TextColumn::make('created_at')->label(__('widgets.recent_orders.created_at')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
