<?php

namespace App\Http\Middleware;

use App\Filament\Admin\Resources\Settings\ParametersResource;
use App\Models\Parameter;
use Closure;
use Filament\Navigation\MenuItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use DB;

class AddFilamentMenuItemsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        if (ParametersResource::canAccess()) {
            $tableParamsExists = DB::select("SELECT * FROM information_schema.tables WHERE table_name = 'parameters'");
            $prefix =  $tableParamsExists ? (@Parameter::find('admin_route')?->value ?? "admin") : "admin";
            filament()->getCurrentPanel()->userMenuItems([
                MenuItem::make()->label(ucfirst(__('parameters')))->icon('feathericon-settings')->url("/$prefix/settings/parameters")
            ]);
        }

        return $next($request);
    }
}
