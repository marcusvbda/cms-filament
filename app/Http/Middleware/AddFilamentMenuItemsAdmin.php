<?php

namespace App\Http\Middleware;

use App\Filament\Admin\Resources\Settings\ParametersResource;
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

        if (ParametersResource::canAccess()) {
            filament()->getCurrentPanel()->userMenuItems([
                MenuItem::make()->label(ucfirst(__('parameters')))->icon('feathericon-settings')->url('/admin/settings/parameters')
            ]);
        }

        return $next($request);
    }
}
