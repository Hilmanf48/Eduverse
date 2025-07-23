<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Filament\Facades\Filament;

class CheckFilamentResources extends Command
{
    protected $signature = 'debug:filament-resources';
    protected $description = 'Checks which Filament resources are registered';

    public function handle()
    {
        $this->info('Mengecek resource yang terdaftar di panel "admin"...');
        
        $panel = Filament::getPanel('admin');
        $resources = $panel->getResources();

        if (empty($resources)) {
            $this->error('Tidak ada resource yang terdaftar sama sekali!');
            return;
        }

        $this->info('Resource yang ditemukan:');
        foreach ($resources as $resource) {
            $this->line('- ' . $resource);
        }
    }
}