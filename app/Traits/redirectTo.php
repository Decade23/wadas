<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename redirectTo.php
 * @LastModified 15/10/2019, 12:43
 */

namespace App\Traits;

/**
 * Trait redirectTo
 * @package App\Traits
 */
trait redirectTo
{

    /**
     * @param $url
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectSuccessCreate($url, $message)
    {
        session()->flash('success', 'Created Successfully. '. $message);
        return redirect()->to($url);
    }

    /**
     * @param $url
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectSuccessUpdate($url, $message)
    {
        session()->flash('success', 'Updated Successfully. '. $message);
        return redirect()->to($url);
    }

    /**
     * @param $url
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectSuccessDelete($url, $message)
    {
        session()->flash('success', 'Deleted Successfully. '. $message);
        return redirect()->to($url);
    }

    /**
     * @param $url
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectSuccessBlast($url, $message)
    {
        session()->flash('success', 'Blast Successfully. '. $message);
        return redirect()->to($url);
    }

    /**
     * @param $url
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectSuccessSend($url, $message)
    {
        session()->flash('success', 'Send Successfully. '. $message);
        return redirect()->to($url);
    }

    /**
     * @param $url
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectFailed($url, $message)
    {
        session()->flash('failed', $message);
        return redirect()->to($url);
    }

    /**
     * @param $url
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectSuccessAdd($url, $message)
    {
        session()->flash('success', 'Added Successfully. '. $message);
        return redirect()->to($url);
    }

    /**
     * @param $url
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectSuccessRemove($url, $message)
    {
        session()->flash('success', 'Removed Successfully. '. $message);
        return redirect()->to($url);
    }
}
