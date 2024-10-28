<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Meal;

class ListMeals extends Command
{
    protected $signature = 'meals:list';
    protected $description = 'List all dishes from the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dishes = Meal::all();

        if ($dishes->isEmpty()) {
            $this->info('No meals found in the database.');
            return;
        }

        foreach ($dishes as $dish) {
            $this->info('ID: ' . $dish->id);
            $this->info('Title: ' . $dish->title);
            $this->info('Status: ' . $dish->status);
            $this->info('---'); // Separator
        }
    }
}