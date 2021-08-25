<?php

namespace App\Http\Livewire\Options;

/**
 * inclue tag <x-toaster/> in blade to use
 */
trait WithNotifyMsgUi
{
    protected function flashMessage(string $message, string $type = 'success'): void
    {
        $this->dispatchBrowserEvent('flash-messages', [
            'type'                  =>  $type,
            'message'               =>  ucwords($message)
        ]);
    }

    protected function flashErrorMessage(string $message): void
    {
        $this->dispatchBrowserEvent('flash-messages', [
            'type'                  =>  'error',
            'message'               =>  ucwords($message)
        ]);
    }
}
