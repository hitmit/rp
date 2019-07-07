<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\CategoryModel as Category;
use App\Entities\TagModel as Tag;

class PornListsGenratorController extends Controller
{

	/**
	 * 
	 */
    public function pornHome()
    {
    	return view('random.home');
    }

    /**
	 * 
	 */
    public function pornCategories()
    {
        $categories = Category::all()->toArray();
        $categories = json_encode($categories);
        // dd($categories);
        return view('random.categories', compact("categories"));
    }

    /**
     * 
     */
    public function pornCategory($category_id)
    {
        $categories = Category::all()->toArray();
        $categories = json_encode($categories);
        return view('random.category', compact("categories", "category_id"));
    }

    /**
	 * 
	 */
    public function pornTags()
    {
    	$tags = Tag::OrderBy('name', 'Asc')->get()->toArray();
        return view('random.tags', compact('tags'));
    }

    /**
     * 
     */
    public function pornTag($tag_id)
    {
        return view('random.tag', compact('tag_id'));
    }

    /**
     * 
     */
    public function pornVideo($video_id)
    {
        return view('random.video', compact('video_id'));
    }

	/**
	 * 
	 */
    public function pornList()
    {
    	return view('random.porn');
    }

    public function pornSearch(Request $request)
    {
        $searchInput = $request->get('search');
        $porns = [];
        if ($searchInput) {
            $porns = Porn::join('porn_tags', 'post_tags.pron_id','=','porn.id')
             ->join('tags','tags.id','=','porn_tags.tag_id')
             ->where('porn.title', 'LIKE', '%' . $searchInput . '%')
             ->orWhereIn('tag.title', preg_split('/\s+/', trim($searchInput))) //The fix
             ->groupBy('post.id')
             ->with('tags')
             ->paginate(8);
        }

        return view('random.porn.search', $porns);
    }
}
