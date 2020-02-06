<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PruebasController extends Controller
{
    public function index(){
        
        echo "Pruebas controller";
        
        die();
        
        return null;
    }
    
    public function testOrm(){
        
        $posts = Post::all();
        foreach($posts as $post){
            echo $post->title."<br>";
            echo "<span>{$post->category->name}</span><br>";
            echo "<span>{$post->user->name}</span><br>";
            echo $post->content."<br>";
            echo "***********"."<br>";          
        }
        die();
        return null;
    }
}
