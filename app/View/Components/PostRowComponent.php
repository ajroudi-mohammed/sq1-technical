<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostRowComponent extends Component
{
    public $id;

    public $title;

    public $description;

    public $publishdate;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title, $description, $publishdate)
    {
        //
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->publishdate = $publishdate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.post-row-component');
    }
}
