<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Resources\Blog\PostsResource\Widgets\QtyPosts;
use App\Filament\Admin\Resources\Cms\PagesResource\Widgets\QtyPages;
use App\Http\Middleware\AddFilamentMenuItemsAdmin;
use App\Models\Parameter;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
// use Filament\Widgets;
// use Filament\Widgets\StatsOverviewWidget;
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

        $menuType = $tableParamsExists ? @Parameter::find('menu_type')?->value : "topbar";

        return $panel
            ->id('admin')
            ->default()
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
                QtyPages::make(),
                QtyPosts::make(),
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
                AddFilamentMenuItemsAdmin::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
