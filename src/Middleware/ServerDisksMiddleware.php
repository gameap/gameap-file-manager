<?php

namespace GameapAddons\FileManager\Middleware;

use Closure;
use Gameap\Models\Server;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServerDisksMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $serverId = $request->segment(2);

        if (!$serverId) {
            throw new HttpResponseException(response()->json([
                'errors'  => [],
                'message' => 'Empty serverId',
            ], 422));
        }

        $server = Server::findOrFail($serverId);

        $setting = $server->settings()->where('name', 'file-manager')->first();
        $disks = json_decode($setting->value, true);

        foreach ($disks as $diskName => $diskConfig) {
            config(["filesystems.disks.{$diskName}" => $diskConfig]);
        }

        app()->instance(Server::class, $server);

        return $next($request);
    }
}