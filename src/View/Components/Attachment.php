<?php

namespace dizatech\Attachment\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Attachment extends Component
{
    /**
     * The file upload url
     * @var
     */
    public $upload_url;

    /**
     * The file remove url
     * @var
     */
    public $remove_url;

    /**
     * The type of file, image or attachment
     * @var
     */
    public $type;

    /**
     * The count of files, single file or multiple files
     * @var
     */
    public $multiple;

    /**
     * The type of page, create page or edit page
     * @var
     */
    public $page;

    /**
     * The name of array to send data to controller
     * @var
     */
    public $name;

    /**
     * The label of file input
     * @var
     */
    public $label;

    /**
     * Data to show in edit page
     * @var
     */
    public $data;

    /**
     * Create a new component instance.
     *
     * @param $type
     * @param $multiple
     * @param $page
     * @param $name
     * @param $label
     * @param null $data
     */
    public function __construct($type, $multiple ,$page ,$name, $label, $data = null)
    {
        // Set input variables to generate a component
        $this->type = $type;
        $this->multiple = $multiple;
        $this->page = $page;
        $this->name = $name;
        $this->label = $label;

        // Convert string input data to array, for edit pages
        preg_match_all('!\d+!', $data, $array);
        $this->data = $array[0];

        // Set url
        $this->upload_url = route('dizatech_upload');
        $this->remove_url = route('dizatech_remove');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        // Render image type of components
        if($this->type == 'image' && $this->multiple == 'false' && $this->page == 'create')
            return view('dizatech_attachment::components.image_single_create');
        if($this->type == 'image' && $this->multiple == 'true' && $this->page == 'create')
            return view('dizatech_attachment::components.image_multiple_create');
        if($this->type == 'image' && $this->multiple == 'false' && $this->page == 'edit')
            return view('dizatech_attachment::components.image_single_edit', ['data' => $this->data]);
        if($this->type == 'image' && $this->multiple == 'true' && $this->page == 'edit')
            return view('dizatech_attachment::components.image_multiple_edit', ['data' => $this->data]);

        // Render attachment type of components
        if($this->type == 'attachment' && $this->multiple == 'false' && $this->page == 'create')
            return view('dizatech_attachment::components.attachment_single_create');
        if($this->type == 'attachment' && $this->multiple == 'true' && $this->page == 'create')
            return view('dizatech_attachment::components.attachment_multiple_create');
        if($this->type == 'attachment' && $this->multiple == 'false' && $this->page == 'edit')
            return view('dizatech_attachment::components.attachment_single_edit', ['data' => $this->data]);
        if($this->type == 'attachment' && $this->multiple == 'true' && $this->page == 'edit')
            return view('dizatech_attachment::components.attachment_multiple_edit', ['data' => $this->data]);
    }
}
