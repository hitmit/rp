<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Entities\TagModel as Tag;
use App\Entities\PornModel as Porn;
use App\Entities\PornTagModel as PornTag;
use App\Entities\CategoryModel as Category;
use App\Entities\PornThumbModel as PornThumb;
use App\Entities\PornCategoryModel as PornCategory;

class PornImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'porn:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all Porn videos into database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $porn_xml = file_get_contents(public_path('porn/porn.xml'));
        $porn_xml = file_get_contents(public_path('porn/export_160x120_pornrabbit.com.xml'));
        $porn_xml_data = simplexml_load_string($porn_xml);
        foreach ($porn_xml_data->video as $key => $node) {
            $porn = [
                'id' => (string) $node->id,
                'title' => (string) $node->title,
                'date_added' => (string) $node->date_added,
                'url' => (string) $node->url,
                'duration' => (string) $node->duration,
                'username' => (string) $node->username,
                'embed' => (string) $node->embed,
            ];

            Porn::insert($porn);

            if (isset($node->tags->tag) && !empty($node->tags->tag)) {
                foreach ($node->tags->tag as $tag) {
                    $tagInfo = Tag::where('name', strtolower(trim((string)$tag)))->first();
                    if (!$tagInfo) {
                        $tag_id = Tag::insertGetId([
                            'name' => strtolower(trim((string)$tag))
                        ]);
                        PornTag::insert([
                            'porn_id' => $porn['id'],
                            'tag_id' => $tag_id,
                        ]);
                    } else {
                        $pornTagInfo = PornTag::where('porn_id', $porn['id'])->where('tag_id', $tagInfo->id)->first();

                        if (!$pornTagInfo) {
                            PornTag::insert([
                                'porn_id' => $porn['id'],
                                'tag_id' => $tagInfo->id,
                            ]);
                        }
                    }
                }
            }

            if (isset($node->categories->category) && !empty($node->categories->category)) {
                foreach ($node->categories->category as $category) {
                    $categoryInfo = Category::where('name', strtolower(trim((string)$category)))->first();
                    if (!$categoryInfo) {
                        $category_id = Category::insertGetId([
                            'name' => strtolower(trim((string)$category))
                        ]);
                        PornCategory::insert([
                            'porn_id' => $porn['id'],
                            'category_id' => $category_id,
                        ]);
                    } else {
                        $pornCategoryInfo = PornCategory::where('porn_id', $porn['id'])->where('category_id', $categoryInfo->id)->first();
                        if (!$pornCategoryInfo) {
                            PornCategory::insert([
                                'porn_id' => $porn['id'],
                                'category_id' => $categoryInfo->id,
                            ]);
                        }
                    }
                }
            }

            if (isset($node->thumbs->thumb) && !empty($node->thumbs->thumb)) {
                foreach ($node->thumbs->thumb as $thumb) {
                    $porn_thumb = [
                        'porn_id' => $porn['id'],
                        'thumb' => (string) $thumb,
                    ];
                    PornThumb::insert($porn_thumb);
                }
            }
        }
    }
}
