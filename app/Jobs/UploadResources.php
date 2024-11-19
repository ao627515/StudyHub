<?php

namespace App\Jobs;

use Throwable;
use App\Models\User;
use App\Models\Resource;
use App\Services\ResourceService;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ResourceUploadFailNotification;

class UploadResources implements ShouldQueue
{
    use Queueable;

    private User $author;
    private array $data;
    private ?Resource $resource;

    /**
     * Create a new job instance.
     */
    public function __construct(
        User $author,
        array $data,
        ?Resource $resource = null
    ) {
        $this->author = $author;
        $this->data = $data;
        $this->resource = $resource;
    }

    /**
     * Execute the job.
     */
    public function handle(ResourceService $resourceService): void
    {
        if (is_null($this->resource))
            $resourceService->store($this->data);
        else
            $resourceService->update($this->resource, $this->data);
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        Notification::send($this->author, new ResourceUploadFailNotification($this->data, $exception));
    }
}
