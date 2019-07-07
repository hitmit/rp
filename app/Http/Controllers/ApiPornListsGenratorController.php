<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\PornModel as Porn;
use App\Entities\CategoryModel as Category;
use App\Entities\TagModel as Tag;

class ApiPornListsGenratorController extends Controller
{

    public function apiPornHome()
    {
        $porns = Porn::inRandomOrder()->paginate(12);
        return response()->json($porns); 
    }

    public function apiPornCategory($category_id)
    {
        $porns = Category::find($category_id)->porns()->paginate(12);
        return response()->json($porns); 
    }

    public function apiPornTag($tag_id)
    {
        $porns = Tag::find($tag_id)->porns()->paginate(12);
        return response()->json($porns); 
    }

    public function apiPornVideo($video_id)
    {
        $porn = Porn::find($video_id);
        return response()->json([
            'error' => false,
            'status' => 200,
            'data' => [
                'porn' => $porn,
            ]
        ], 200); 
    }

	public function apiPornList()
	{
        $porn = Porn::inRandomOrder()->skip(0)->take(1)->get()->toArray();
        return response()->json([
            'error' => false,
            'status' => 200,
            'data' => [
                'porn' => $porn
            ]
        ], 200);
	}
}
