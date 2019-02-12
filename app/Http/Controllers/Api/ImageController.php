<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, string $type)
    {
        $images = Image::type($type);

        if ($request->has('all')) {
            return ImageResource::collection($images->get());
        }

        return ImageResource::collection($images->paginate((int) $request->per_page ?? 50));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $linksSubmitted = explode("\n", $request->input('links'));

        if (count($linksSubmitted) === 0) {
            return [
                'error' => 'You must submit at least one link.',
            ];
        }

        $linkResponses = [];

        foreach ($linksSubmitted as $link) {
            $linkResponses[$link] = $this->processLink($link);
        }

        return [
            'data' => $linkResponses,
        ];
    }

    protected function processLink(string $link): string
    {
        if (! filter_var($link, FILTER_VALIDATE_URL)) {
            return 'Not a link';
        }

        $hostName = parse_url($link, PHP_URL_HOST);

        if (! in_array($hostName, ['transformice.com', 'images.atelier801.com'])) {
            return 'Only links from transformice.com and images.atelier801.com are supported';
        }

        $path = ltrim(parse_url($link, PHP_URL_PATH), '/');

        if (Image::where(['path' => $path])->exists()) {
            return 'Image already exists';
        }

        try {
            $imageSize = getimagesize($link);
        } catch (\Exception $e) {
            return 'Link is not a valid image';
        }

        if (! is_array($imageSize)) {
            return 'Link is not a valid image';
        }

        Image::create([
            'type' => $hostName,
            'path' => $path,
            'width' => $imageSize[0],
            'height' => $imageSize[1],
        ]);

        return 'Image added successfully';
    }
}
