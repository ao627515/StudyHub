<?php

namespace App\View\Components;

use Closure;
use App\Models\Resource;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ResourceTable extends Component
{
    public Collection|LengthAwarePaginator $resources;
    public string $datatable = '';

    /**
     * Create a new component instance.
     */
    public function __construct(Collection|LengthAwarePaginator|array $resources, string $datatable = '')
    {
        $this->resources = $resources;
        $this->datatable = $datatable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.resourse-table');
    }
}
