<?php

namespace App\Http\Livewire\Student;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboardcomponent extends Component
{
    public $title;
    public $start;
    public $end;
    public $event_id;

    protected function resetFields(){
        $this->title = null;
        $this->start = null;
        $this->end = null;
    }
    //create event
    public function save_event(){
        Event::create([
            'user_id' => Auth::user()->id,
            'title' => $this->title,
            'start' => $this->start,
            'end' => $this->end,
        ]);
        $this->emitTo('body-header-component','refreshComponent');
        $this->resetFields();
        $this->dispatchBrowserEvent('closeModalCreate',['close' => true]);
        $this->dispatchBrowserEvent('refeshEvent',['refesh' => true]);
    }

    public function update_event(){

        Event::findOrFail($this->event_id)->update([
            'user_id' => Auth::user()->id,
            'title' => $this->title,
            'start' => $this->start,
            'end' => $this->end,
        ]);
        $this->emitTo('body-header-component','refreshComponent');
        $this->dispatchBrowserEvent('closeModalEdit',['close' => true]);
        $this->dispatchBrowserEvent('refeshEvent',['refesh' => true]);
    }
    public function delete_event(){
        Event::findOrFail($this->event_id)->delete();
        $this->emitTo('body-header-component','refreshComponent');
        $this->dispatchBrowserEvent('closeModalEdit',['close' => true]);
        $this->dispatchBrowserEvent('refeshEvent',['refesh' => true]);
    }
    public function render()
    {
        return view('livewire.student.dashboardcomponent')->layout('layouts.layout',
        ['title' => 'Trang Chủ']);
    }
}
