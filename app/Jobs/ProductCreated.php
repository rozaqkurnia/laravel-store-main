<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \App\Models\Product::create([
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'slug' => $this->data['slug'],
            'featured_image' => $this->data['featured_image'],
            'details' => $this->data['details'],
            'description' => $this->data['description'],
            'price' => $this->data['price'],
            'created_at' => $this->data['created_at'],
            'updated_at' => $this->data['updated_at']
        ]);
    }
}
