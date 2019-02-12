<?php

namespace App\Http\Controllers;

use App\Image;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $type)
    {
        $imageCount = Image::where(['type' => $type])->count();

        if ($imageCount === 0) {
            throw new NotFoundHttpException();
        }

        return view('images', [
            'type' => $type,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }
}
