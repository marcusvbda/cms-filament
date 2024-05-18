<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Resources\PostsResource\Widgets\QtyPosts;
use App\Filament\Admin\Resources\PagesResource\Widgets\QtyPages;
use App\Filament\Admin\Resources\ParametersResource;
use App\Filament\Admin\Resources\UserResource;
use App\Models\Parameter;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
// use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $tableParamsExists = DB::select("SELECT * FROM information_schema.tables WHERE table_name = 'parameters'");
        $prefix =  $tableParamsExists ? (@Parameter::find('admin_route')?->value ?? "admin") : "admin";
        $menuType = $tableParamsExists ? @Parameter::find('menu_type')?->value : "topbar";

        // $tableCollectionsExists = DB::select("SELECT * FROM information_schema.tables WHERE table_name = 'collections'");

        // $collections = array_map(function ($collection) use ($prefix) {
        //     $name = strtolower(data_get($collection, "name"));
        //     $slug = Str::slug($name);
        //     return NavigationItem::make(ucfirst(__($name)))
        //         ->url("/$prefix/data/tables/$slug")
        //         ->icon('bx-data')
        //         ->group(ucfirst(__("collections")));
        // }, $tableCollectionsExists ? Collection::get()->toArray() : []);

        return $panel
            ->id('admin')
            ->default()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->path($tableParamsExists ? (@Parameter::find('admin_route')?->value ?? "admin") : "admin")
            ->spa()
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->topNavigation($menuType === "topbar")
            ->brandName($tableParamsExists ?  (Parameter::find('app_name')->value ?? "Filament") : "Filament")
            // ->brandLogo(asset('img/logo.png'))
            ->sidebarFullyCollapsibleOnDesktop($menuType === "sidebar")
            // ->spa()
            ->databaseTransactions()
            ->colors([
                'primary' => Color::hex($tableParamsExists ? (Parameter::find('primary_color')->value ?? "#EA580C") : "#EA580C"),
            ])
            ->login()
            // ->registration()
            // ->emailVerification()
            ->passwordReset()
            ->profile()
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                // AccountWidget::class,
                QtyPages::make(),
                QtyPosts::make(),

            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->userMenuItems([
                MenuItem::make()
                    ->label(ucfirst(__('parameters')))
                    ->icon('feathericon-settings')
                    ->url("/$prefix/parameters")
                    ->visible(fn (): bool => ParametersResource::canAccess()),
                MenuItem::make()
                    ->label(ucfirst(__('users')))
                    ->icon('heroicon-o-user')
                    ->url("/$prefix/users")
                    ->visible(fn (): bool => UserResource::canAccess()),
            ]);
        // ->navigationItems($collections);
    }
}
