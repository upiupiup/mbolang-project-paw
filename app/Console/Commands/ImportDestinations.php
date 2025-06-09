<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;
use App\Models\Destination;
use Illuminate\Support\Str;

class ImportDestinations extends Command
{
    protected $signature = 'import:destinations';
    protected $description = 'Import destinasi dari CSV ke database';

    public function handle()
    {
        $path = storage_path('app/public/destinations.csv');

        if (!file_exists($path)) {
            $this->error("File CSV tidak ditemukan di $path");
            return;
        }

        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0); // Baris pertama sebagai header

        foreach ($csv->getRecords() as $record) {
            Destination::create([
                'category' => $record['kategori'],
                'name' => $record['name'],
                'slug' => Str::slug($record['name']),
                'image' => $record['image'],
                'description' => $record['deskripsi'],
                'location' => $record['lokasi'],
                'contact_person' => $record['contact_person'],
                'gmaps_link' => $record['link_gmaps'],
            ]);
        }

        $this->info('Berhasil mengimpor destinasi!');
    }
}
