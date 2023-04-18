<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alerta extends Component
{
    public $mensaje;
    public $tipo;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($mensaje,$tipo)
    {
        //
        $this->mensaje = $mensaje;
        $this->tipo = $tipo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alerta');
    }
}
