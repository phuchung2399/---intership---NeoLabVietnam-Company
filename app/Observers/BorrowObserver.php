<?php

namespace App\Observers;

use App\Borrow;

class BorrowObserver
{
    /**
     * Handle the borrow "created" event.
     *
     * @param  \App\Borrow  $borrow
     * @return void
     */
    public function created(Borrow $borrow)
    {
        //pending
        $borrow->device()->update(['available' => false]);
    }
    
    /**
     * Handle the borrow "updated" event.
     *
     * @param  \App\Borrow  $borrow
     * @return void
     */
    public function updated(Borrow $borrow)
    {
        if ($borrow->status === 2 || $borrow->status === 4) {
             $borrow->device()->update(['available' => true]);
        }
    }

    /**
     * Handle the borrow "deleted" event.
     *
     * @param  \App\Borrow  $borrow
     * @return void
     */
    public function deleted(Borrow $borrow)
    {
        //
    }

    /**
     * Handle the borrow "restored" event.
     *
     * @param  \App\Borrow  $borrow
     * @return void
     */
    public function restored(Borrow $borrow)
    {
        //
    }

    /**
     * Handle the borrow "force deleted" event.
     *
     * @param  \App\Borrow  $borrow
     * @return void
     */
    public function forceDeleted(Borrow $borrow)
    {
        //
    }
}
