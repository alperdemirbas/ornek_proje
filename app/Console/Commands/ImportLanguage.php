<?php

namespace App\Console\Commands;

use App\Imports\LanguageImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\TranslationLoader\LanguageLine;

class ImportLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-language';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new LanguageImport, public_path('language.xlsx'));

    }
}
