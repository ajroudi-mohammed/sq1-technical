<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlogPostComponent extends Component
{
    public $title;

    public $description;

    public $publishedAt;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description, $publishedAt)
    {
        //
        $this->title = $title;
        $this->description = $description;
        $this->publishedAt = $publishedAt;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blog-post-component');
    }
}
