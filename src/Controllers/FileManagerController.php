<?php

namespace GameapAddons\FileManager\Controllers;

use GameapAddons\FileManager\Services\FileManagerService;
use Gameap\Http\Controllers\Controller;
use Gameap\Models\Server;
use Illuminate\Http\Request;
use Gameap\Repositories\ServerRepository;

class FileManagerController extends Controller
{
    /**
     * @var FileManagerService
     */
    public $service;

    /**
     * The ServerRepository instance.
     *
     * @var \Gameap\Repositories\ServerRepository
     */
    protected $repository;

    /**
     * FileManagerController constructor.
     * @param FileManagerService $service
     */
    public function __construct(FileManagerService $service, ServerRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Initialize file manager settings
     * @param  \Gameap\Models\Server  $server
     * @return \Illuminate\Http\JsonResponse
     */
    public function initialize(Server $server)
    {
        $this->service->setServer($server);

        return response()->json(
            $this->service->initialize()
        );
    }

    /**
     * Get files and directories for the selected path and disk
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function content(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return response()->json(
            $this->service->content(
                $request->input('disk'),
                $request->input('path')
            )
        );
    }

    /**
     * Directory tree
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return response()->json(
            $this->service->tree(
                $request->input('disk'),
                $request->input('path')
            )
        );
    }

    /**
     * Check the selected disk
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectDisk(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return response()->json(
            $this->service->selectDisk(
                $request->input('disk')
            )
        );
    }

    /**
     * Create new directory
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDirectory(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return response()->json(
            $this->service->createDirectory(
                $request->input('disk'),
                $request->input('path'),
                $request->input('name')
            )
        );
    }

    /**
     * Upload files
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return response()->json(
            $this->service->upload(
                $request->input('disk'),
                $request->input('path'),
                $request->file('files'),
                $request->input('overwrite')
            )
        );
    }

    /**
     * Delete files and folders
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return response()->json(
            $this->service->delete(
                $request->input('disk'),
                $request->input('items')
            )
        );
    }

    /**
     * Copy / Cut files and folders
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paste(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return response()->json(
            $this->service->paste(
                $request->input('disk'),
                $request->input('path'),
                $request->input('clipboard')
            )
        );

    }

    /**
     * Rename item
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rename(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return response()->json(
            $this->service->rename(
                $request->input('disk'),
                $request->input('newName'),
                $request->input('oldName')
            )
        );
    }

    /**
     * Download file
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return $this->service->download(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * Create thumbnails
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function thumbnails(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return $this->service->thumbnails(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * Image preview
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return $this->service->preview(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * File url
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function url(Request $request, Server $server)
    {
        $this->service->setServer($server);

        return response()->json(
            $this->service->url(
                $request->input('disk'),
                $request->input('path')
            )
        );
    }

    /**
     * Integration with ckeditor 4
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ckeditor(Request $request)
    {
        return view('file-manager::ckeditor');
    }
}