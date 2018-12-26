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

        foreach ($server->file_manager_disks as $diskName => $diskConfig) {
            config(["filesystems.disks.{$diskName}" => $diskConfig]);
        }

        app()->instance(Server::class, $server);

        return $next($request);
    }
}