<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ScheduleEntryMenu;
use Illuminate\Console\Command;

class SetProductIdToScheduleEntryMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-product-id-to-schedule-entry-menu';

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
            $product = Product::where('name', $schedule_entry->product)->first();
            if ($product) {
                $schedule_entry->update(['product_id' => $product->id]);
            }
            $progress_bar->advance();
        }
        $progress_bar->finish();
    }
}
