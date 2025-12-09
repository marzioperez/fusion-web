<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ScheduleEntryMenu;
use Illuminate\Console\Command;

class SetPriceToScheduleEntryMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-price-to-schedule-entry-menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle() {
        $schedule_entries = ScheduleEntryMenu::all();
        $progress_bar = $this->output->createProgressBar($schedule_entries->count());
        foreach ($schedule_entries as $schedule_entry) {
            $product = Product::find($schedule_entry['product_id']);
            $price = $product->price;
            if ($schedule_entry['school'] === "Cedarwood Waldorf School") {
                $price = 9;
            }
            if ($product) {
                $schedule_entry->update(['price' => $price]);
            }
            $progress_bar->advance();
        }
        $progress_bar->finish();
    }
}
