<?php

namespace App\Filament\Resources\BennerResource\Pages;

use App\Filament\Resources\BennerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBenner extends EditRecord
{
    protected static string $resource = BennerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
