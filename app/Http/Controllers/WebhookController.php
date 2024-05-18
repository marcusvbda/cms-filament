<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function webhook($slug, Request $request)
    {
        $collection = Collection::where('webhook', $slug)->firstOrFail();

        $data = [];
        foreach ($collection->columns as $column) {
            $key = data_get($column, 'key');
            $data[$key] = "via webook";
        }

        $collection->rows()->create(["data" => $data, "source" => "webhook"]);

        $admin = User::where('name', 'admin')->first();
        if ($admin) {
            $admin->notify(
                Notification::make()
                    ->title(ucfirst(__('new entry to collection') . ' : ' . $collection->name))
                    ->toDatabase()
            );
        }
        return response()->json(['message' => 'ok']);
    }
}
