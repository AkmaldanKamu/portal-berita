<?php

namespace App\Filament\Resources\BennerResource\Pages;

use App\Filament\Resources\BennerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBenners extends ListRecords
{
    protected static string $resource = BennerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
