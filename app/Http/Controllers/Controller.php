<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

abstract class Controller
{
    /**
     * Flash an alert to the session.
     */
    protected function flashAlert(
        string $icon,
        string $text,
        ?int $timer = null,
        ?string $title = null,
        ?string $footer = null,
        ?string $confirmButtonText = null,
        ?string $route = null,
    ): RedirectResponse {
        session()->flash('icon', $icon);
        session()->flash('text', $text);

        if ($timer) {
            session()->flash('timer', $timer);
        }
        if ($title) {
            session()->flash('title', $title);
        }
        if ($footer) {
            session()->flash('footer', $footer);
        }
        if ($confirmButtonText) {
            session()->flash('confirmButtonText', $confirmButtonText);
        }

        return $route ? redirect()->to($route) : redirect()->back();
    }
}
