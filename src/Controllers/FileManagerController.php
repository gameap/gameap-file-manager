<?php

namespace GameapAddons\FileManager\Controllers;

use GameapAddons\FileManager\Requests\RequestValidator;
use GameapAddons\FileManager\FileManager;
use GameapAddons\FileManager\Services\Zip;
use Illuminate\Routing\Controller;
use Gameap\Models\Server;
use Illuminate\Http\Request;
use Gameap\Repositories\ServerRepository;

class FileManagerController extends Controller
{
    /**
     * @var FileManager
     */
    public $fm;

    /**
     * The ServerRepository instance.
     *
     * @var \Gameap\Repositories\ServerRepository
     */
    protected $repository;

    /**
     * FileManagerController constructor.
     *
     * @param FileManager $fm
     */
    public function __construct(FileManager $fm, ServerRepository $repository)
    {
        $this->fm = $fm;
        $this->repository = $repository;
    }

    /**
     * Initialize file manager
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function initialize()
    {
        return response()->json(
            $this->fm->initialize()
        );
    }

    /**
     * Get files and directories for the selected path and disk
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function content(RequestValidator $request, Server $server)
    {
        return response()->json(
            $this->fm->content(
                $request->input('disk'),
                $request->input('path')
            )
        );
    }

    /**
     * Directory tree
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree(RequestValidator $request, Server $server)
    {
        return response()->json(
            $this->fm->tree(
                $request->input('disk'),
                $request->input('path')
            )
        );
    }

    /**
     * Check the selected disk
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectDisk(RequestValidator $request, Server $server)
    {
        return response()->json([
            'result' => [
                'status'  => 'success',
                'message' => trans('file-manager::response.diskSelected'),
            ],
        ]);
    }

    /**
     * Upload files
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(RequestValidator $request, Server $server)
    {
        return response()->json(
            $this->fm->upload(
                $request->input('disk'),
                $request->input('path'),
                $request->file('files'),
                $request->input('overwrite')
            )
        );
    }

    /**
     * Delete files and folders
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(RequestValidator $request, Server $server)
    {
        return response()->json(
            $this->fm->delete(
                $request->input('disk'),
                $request->input('items')
            )
        );
    }

    /**
     * Copy / Cut files and folders
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function paste(RequestValidator $request, Server $server)
    {
        return response()->json(
            $this->fm->paste(
                $request->input('disk'),
                $request->input('path'),
                $request->input('clipboard')
            )
        );
    }

    /**
     * Rename
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function rename(RequestValidator $request, Server $server)
    {
        return response()->json(
            $this->fm->rename(
                $request->input('disk'),
                $request->input('newName'),
                $request->input('oldName')
            )
        );
    }

    /**
     * Download file
     *
     * @param RequestValidator $request
     *
     * @return mixed
     */
    public function download(RequestValidator $request, Server $server)
    {
        return $this->fm->download(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * Create thumbnails
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\Response|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function thumbnails(RequestValidator $request, Server $server)
    {
        return $this->fm->thumbnails(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * Image preview
     *
     * @param RequestValidator $request
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function preview(RequestValidator $request, Server $server)
    {
        return $this->fm->preview(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * File url
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function url(RequestValidator $request, Server $server)
    {
        return response()->json(
            $this->fm->url(
                $request->input('disk'),
                $request->input('path')
            )
        );
    }

    /**
     * Create new directory
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDirectory(RequestValidator $request, Server $server)
    {
        return response()->json(
            $this->fm->createDirectory(
                $request->input('disk'),
                $request->input('path'),
                $request->input('name')
            )
        );
    }

    /**
     * Create new file
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createFile(RequestValidator $request, Server $server)
    {
        return response()->json(
            $this->fm->createFile(
                $request->input('disk'),
                $request->input('path'),
                $request->input('name')
            )
        );
    }

    /**
     * Update file
     *
     * @param RequestValidator $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateFile(RequestValidator $request, Server $server)
    {
        return response()->json(
            $this->fm->updateFile(
                $request->input('disk'),
                $request->input('path'),
                $request->file('file')
            )
        );
    }

    /**
     * Stream file
     *
     * @param RequestValidator $request
     *
     * @return mixed
     */
    public function streamFile(RequestValidator $request, Server $server)
    {
        return $this->fm->streamFile(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * Create zip archive
     *
     * @param RequestValidator $request
     * @param Zip              $zip
     *
     * @return array
     */
    public function zip(RequestValidator $request, Server $server, Zip $zip)
    {
        return $zip->create();
    }

    /**
     * Extract zip atchive
     *
     * @param RequestValidator $request
     * @param Zip              $zip
     *
     * @return array
     */
    public function unzip(RequestValidator $request, Server $server, Zip $zip)
    {
        return $zip->extract();
    }

    /**
     * Integration with ckeditor 4
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ckeditor(Request $request)
    {
        return view('file-manager::ckeditor');
    }
}
