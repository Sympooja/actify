<?php

namespace Theme\Controllers;

use Themosis\Route\BaseController;
use Themosis\Facades\View;
use WP_Query;

class PageController extends BaseController
{
    public $page;

    public function __construct()
    {
        // We can't inject the global post into the constructor,
        // see https://github.com/themosis/framework/issues/445
        global $post;

        $this->page = (!is_home()) ? $post : get_page(get_option('page_for_posts'));

        if ($this->page) {
            $acf = get_fields($this->page);
            $this->page->acf = $acf;
        }

        //Share some stuff globally across the views
        View::share([
            'page' => $this->page,
            'acf' => $acf ?? [],
            'options' => get_fields('option'),
            'isDev' => strpos($_SERVER['SERVER_NAME'], 'localhost') !== false
        ]);
    }

    public function home()
    {
        return view('pages.home', [
            'pageName' => 'home',
        ]);
    }

    public function legal()
    {
        return view('pages.legal', [
            'pageName' => 'legal'
        ]);
    }

    public function post()
    {
        return view('pages.post', [
            'pageName' => 'post'
        ]);
    }

    public function format()
    {
        $fields = get_field('global_options', 'options');
        $page_template_id = $fields['formats_page_template'];
        $raw_content = get_field('flexible_content', $page_template_id);

        $replacements = [
            'format_name' => get_the_title(),
            'format_file_type' => get_field('file_types'),
            'format_versions' => get_field('version')
        ];

        array_walk_recursive($raw_content, function (&$val, $i) use ($replacements) {
            foreach ($replacements as $key => $value) {
                $val = str_replace('[' . $key . ']', $value, $val);
            }
        });

        return view('pages.format', [
            'pageName' => 'format',
            'content' => $raw_content
        ]);
    }

    public function default()
    {
        return view('pages.default', [
            'pageName' => 'default'
        ]);
    }

    public function thankyou()
    {
        return view('pages.thankyou', [
            'pageName' => 'thankyou'
        ]);
    }

    public function homepageTest()
    {
        return view('pages.homepage-test', [
            'pageName' => 'homepage-test'
        ]); 
    }
    
     public function homepage5c()
    {
        return view('pages.homepage-5c', [
            'pageName' => 'homepage-5c'
        ]);
    }

    public function blogArticle()
    {
        return view('pages.blog-article', [
            'pageName' => 'blog-article'
        ]);
    }

    public function blog()
    {
        return view('pages.blog', [
            'pageName' => 'blog'
        ]);
    }

    public function resources()
    {
        return view('pages.resources', [
            'pageName' => 'resources'
        ]);
    }

  public function pricing()
    {
        return view('pages.pricing', [
            'pageName' => 'pricing'
        ]);
    }

    public function search()
    {
        return view('pages.search', [
            'pageName' => 'search'
        ]);
    }

    public function category()
    {
        return view('pages.category', [
            'pageName' => 'category'
        ]);
    }

    public function demo()
    {
        return view('pages.demo', [
            'pageName' => 'demo'
        ]);
    }

    public function careers()
    {
        return view('pages.careers', [
            'pageName' => 'careers'
        ]);
    }


    public function fourOhFour()
    {
        return view('pages.404', [
            'pageName' => '404'
        ]);
    }

    /**
     * Wrapper function for get_posts() return value to add associated ACF fields
     */
    public static function get($args = [])
    {
        return collect(get_posts($args))->each(function ($p) {
            $p->acf = get_fields($p);
        })->toArray();
    }
}