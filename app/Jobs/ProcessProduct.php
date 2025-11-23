<?php

namespace App\Jobs;

use App\Models\MediaVault;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class ProcessProduct implements ShouldQueue {
    use Queueable;

    public function __construct(public $data) {
    }

    public function handle(): void {
        $product = Product::where('sku', $this->data['sku'])->first();
        if ($product) {
            $product->update([
                'name' => $this->data['nombre'],
                'price' => $this->data['precio'],
            ]);
        } else {
            $product = Product::create([
                'sku' => $this->data['sku'],
                'name' => $this->data['nombre'],
                'price' => $this->data['precio'],
            ]);
        }
        if ($this->data['url_foto']) {
            $this->store_photo($product);
        }
    }

    public function store_photo(Product $product): void {
        $drive_url = $this->data['url_foto'];
        $file_id = $this->extract_google_drive_file_id($drive_url);
        if ($file_id) {
            $downloadUrl = "https://drive.google.com/uc?export=download&id={$file_id}";

            try {
                // Usamos la respuesta como stream
                $response = Http::get($downloadUrl);

                if ($response->successful()) {
                    $stream = $response->body();

                    $vault = MediaVault::firstOrCreate(['id' => 1], []);
                    $photo = $vault->addMediaFromStream($stream)->usingFileName("image_{$product->id}.jpg")->toMediaCollection('assets', 'media-manager');
                    $product->update(['media_id' => $photo->id]);
                }
            } catch (\Exception $e) {
                logger()->error('Error descargando imagen desde Google Drive: ' . $e->getMessage());
            }
        }
    }

    public function extract_google_drive_file_id($drive_url) {
        if (preg_match('/(?:\/d\/|id=)([a-zA-Z0-9_-]+)/', $drive_url, $matches)) {
            return $matches[1];
        }
        return null;
    }

}
