<?php

namespace App\Http\Middleware;

use App\Filament\Admin\Resources\SettingsResource;
use Closure;
use Filament\Navigation\MenuItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AddFilamentMenuItemsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        if (SettingsResource::canAccess()) {
            filament()->getCurrentPanel()->userMenuItems([
                MenuItem::make()->label(ucfirst(__('settings')))->icon('feathericon-settings')->url('/admin/settings')
            ]);
        }

        return $next($request);
    }
}
