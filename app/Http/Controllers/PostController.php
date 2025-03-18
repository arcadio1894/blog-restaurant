<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostDescription;
use App\Models\PostImage;
use App\Models\PostTag;
use App\Models\PostTitle;
use App\Models\PostVideo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $registros = Post::all();

        $arrayYears = $registros->pluck('date_posted')->map(function ($date) {
            return Carbon::parse($date)->format('Y');
        })->unique()->toArray();

        $arrayYears = array_values($arrayYears);

        $users = User::all();

        $categories = Category::all();

        return view('post.index', compact('arrayYears','users','categories'));

    }

    public function getDataPosts(Request $request, $pageNumber = 1)
    {
        $perPage = 10;
        $year = $request->input('year');
        $title = $request->input('title');
        $user = $request->input('user');
        $category = $request->input('category');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        if ( $startDate == "" || $endDate == "" )
        {
            $query = Post::with('category', 'user')
                ->orderBy('created_at', 'DESC');
        } else {
            $fechaInicio = Carbon::createFromFormat('d/m/Y', $startDate);
            $fechaFinal = Carbon::createFromFormat('d/m/Y', $endDate);

            $query = Post::with('category', 'user')
                ->whereDate('date_posted', '>=', $fechaInicio)
                ->whereDate('date_posted', '<=', $fechaFinal)
                ->orderBy('created_at', 'DESC');
        }

        // Aplicar filtros si se proporcionan
        if ($year != "") {
            $query->whereYear('date_posted', $year);

        }

        if ( $title != "" ) {
            $query->where('title', 'LIKE', '%'.$title.'%');
        }

        if ($user != "") {
            $query->where('user_id', $user);

        }

        if ($category != "") {
            $query->where('category_id', $category);

        }

        $totalFilteredRecords = $query->count();
        $totalPages = ceil($totalFilteredRecords / $perPage);

        $startRecord = ($pageNumber - 1) * $perPage + 1;
        $endRecord = min($totalFilteredRecords, $pageNumber * $perPage);

        $posts = $query->skip(($pageNumber - 1) * $perPage)
            ->take($perPage)
            ->get();

        $arrayPosts = [];

        foreach ( $posts as $post )
        {
            array_push($arrayPosts, [
                "id" => $post->id,
                "date_posted" => ($post->date_posted != null) ? $post->date_posted->format('d/m/Y') : "",
                "title" => $post->title,
                "idea" => $post->idea,
                "user" => ($post->user_id != null) ? $post->user->name : "",
                "category" => ($post->category_id != null) ? $post->category->description : "",
                "slug" => $post->slug
            ]);
        }

        $pagination = [
            'currentPage' => (int)$pageNumber,
            'totalPages' => (int)$totalPages,
            'startRecord' => $startRecord,
            'endRecord' => $endRecord,
            'totalRecords' => $totalFilteredRecords,
            'totalFilteredRecords' => $totalFilteredRecords
        ];

        return ['data' => $arrayPosts, 'pagination' => $pagination];
    }

    public function getDataWelcomePosts($pageNumber = 1)
    {
        $perPage = 5;

        $query = Post::with('category', 'user')
            ->orderBy('created_at', 'DESC');

        $totalFilteredRecords = $query->count();
        $totalPages = ceil($totalFilteredRecords / $perPage);

        $startRecord = ($pageNumber - 1) * $perPage + 1;
        $endRecord = min($totalFilteredRecords, $pageNumber * $perPage);

        $posts = $query->skip(($pageNumber - 1) * $perPage)
            ->take($perPage)
            ->get();

        $arrayPosts = [];

        foreach ( $posts as $post )
        {
            $fecha = Carbon::parse($post->date_posted)->translatedFormat('j \\d\\e F \\d\\e Y \\a \\l\\a\\s g:i A');

            $posted = 'Publicado por <a href="#!" >'.$post->user->name.'</a> el '.$fecha;

            array_push($arrayPosts, [
                "id" => $post->id,
                "url" => route('post.show', ['slug' => $post->slug]),
                "title" => $post->title,
                "subtitle" => $post->idea,
                "posted" => $posted
            ]);
        }

        $pagination = [
            'currentPage' => (int)$pageNumber,
            'totalPages' => (int)$totalPages,
            'startRecord' => $startRecord,
            'endRecord' => $endRecord,
            'totalRecords' => $totalFilteredRecords,
            'totalFilteredRecords' => $totalFilteredRecords
        ];

        return ['data' => $arrayPosts, 'pagination' => $pagination];
    }

    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        //dd($request);
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            // Obtener los datos generales
            $category_id = $request->input('category_id');
            $title = $request->input('title');
            $idea = $request->input('idea');

            // Decodificar los datos JSON
            $tags = json_decode($request->input('tags'), true);
            $sections = json_decode($request->input('sections'), true);

            // Guardar los datos en la base de datos (esto es solo un ejemplo, ajusta según tu estructura)
            $post = new Post();
            $post->title = $title;
            $post->idea = $idea;
            $post->user_id = Auth::id();
            $post->date_posted = Carbon::now('America/Lima');
            $post->category_id = $category_id;
            $post->save();

            // Tratamiento de la imagen
            if (!$request->file('banner')) {
                $post->image = 'no_image.jpg';
                $post->save();
            } else {
                $path = public_path().'/images/posts/';
                $extension = $request->file('banner')->getClientOriginalExtension();
                $filename = $post->id . '.' . $extension;
                $request->file('banner')->move($path, $filename);
                $post->image = $filename;
                $post->save();
            }

            foreach ($tags as $tag) {
                $postTag = new PostTag();
                $postTag->post_id = $post->id;
                $postTag->tag = $tag;
                $postTag->save();
            }

            // Guardar sections (ajusta según tu estructura)
            foreach ($sections as $key => $section) {
                if ( $section['type'] == 'description' ) {
                    $postDescription = new PostDescription();
                    $postDescription->post_id = $post->id;
                    $postDescription->description = $section['text_description'];
                    $postDescription->order = $key+1;
                    $postDescription->save();

                } elseif ( $section['type'] == 'subtitle' ) {
                    $postTitle = new PostTitle();
                    $postTitle->post_id = $post->id;
                    $postTitle->title = $section['text_subtitle'];
                    $postTitle->order = $key+1;
                    $postTitle->save();

                } elseif ( $section['type'] == 'image' ) {
                    $postImage = new PostImage();
                    $postImage->post_id = $post->id;
                    $postImage->description = $section['comment_image'];
                    $postImage->order = $key + 1;

                    $imageFieldName = $section['image_name'];

                    if ($request->hasFile($imageFieldName)) {
                        $file = $request->file($imageFieldName);
                        $path = public_path('/images/postImages/');
                        $extension = $file->getClientOriginalExtension();
                        $filename = $post->id . '_' . $key . '.' . $extension; // Asegúrate de tener nombres únicos
                        $file->move($path, $filename);
                        $postImage->name = $filename;
                    } else {
                        $postImage->name = 'no_image.jpg';
                    }

                    $postImage->save();

                } elseif ( $section['type'] == 'video' ) {
                    $postImage = new PostVideo();
                    $postImage->post_id = $post->id;
                    $postImage->url = $section['url_video'];
                    $postImage->description = $section['comment_video'];
                    $postImage->order = $key + 1;

                    $postImage->save();

                }
            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }
        return response()->json(['message' => 'Publicación guardada con éxito.'], 200);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with([
            'user',
            'category',
            'descriptions',
            'titles',
            'images',
            'tags'])->firstOrFail();

        $descriptions = $post->descriptions;
        $titles = $post->titles;
        $images = $post->images;
        $videos = $post->videos;
        $tags = $post->tags;

        $arraySections = [];

        foreach ( $descriptions as $description )
        {
            array_push($arraySections, [
                "type" => 'description',
                "text_description" => $description->description,
                "order" => $description->order
            ]);
        }

        foreach ( $titles as $title )
        {
            array_push($arraySections, [
                "type" => 'title',
                "title" => $title->title,
                "order" => $title->order
            ]);
        }

        foreach ( $images as $image )
        {
            array_push($arraySections, [
                "type" => 'image',
                "description" => $image->description,
                "name" => $image->name,
                "order" => $image->order
            ]);
        }

        foreach ( $videos as $video )
        {
            array_push($arraySections, [
                "type" => 'video',
                "url" => $video->url,
                "description" => $video->description,
                "order" => $video->order
            ]);
        }

        usort($arraySections, function ($a, $b) {
            if ($a['order'] < $b['order']) {
                return -1;
            } elseif ($a['order'] > $b['order']) {
                return 1;
            } else {
                return 0;
            }
        });

        //dump($arraySections);

        return view('post.show', compact('post', 'arraySections', 'tags'));
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy($post_id)
    {
        DB::beginTransaction();
        try {

            $post = Post::find($post_id);

            foreach ( $post->descriptions as $description )
            {
                $description->delete();
            }

            foreach ( $post->titles as $title )
            {
                $title->delete();
            }

            foreach ( $post->images as $image )
            {
                $name = $image->name;
                $image_path = public_path().'/images/postImages/'.$name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $image->delete();
            }

            foreach ( $post->videos as $video )
            {
                $video->delete();
            }

            foreach ( $post->tags as $tag )
            {
                $tag->delete();
            }

            $image_path = public_path().'/images/posts/'.$post->image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $post->delete();

            DB::commit();
        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }
        return response()->json(['message' => 'Publicación eliminada con éxito'], 200);
    }
}
