<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\VideoView;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoView $event)
    {
        //
        $this->updateViewer($event ->video);

    }
    function updateViewer($video)
    {
      $video->viewers=$video->viewers+1;
      $video->save();

    }
}
