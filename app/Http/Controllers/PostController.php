<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //post home page

    public function home(){
        // $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        $posts = Post::when(request('searchKey'),function($query){
            $key = request('searchKey');
            $query->where('title','like','%'.$key.'%')
                ->where('description','like','%'.$key.'%');
        })->orderBy('created_at', 'desc')->paginate(4);
        return view('create',compact('posts'));
    }

    //create post 
    public function create(Request $request){

        $this->postValidationCheck($request);
        $data = $this->getPostData($request);   

        if($request->hasFile('postImage')){
            $fileName = uniqid() . "_waiphyoaung_" . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        
        Post::create($data);

        return back()->with(['insertSuccess'=>'Post Created Successfully!!']);
    }

    //delete post
    public function deletePost($id){
        //first way delete
        // Post::where('id',$id)->delete();

        //second way delete
        Post::find($id)->delete();
        return back();
    }

    //update Post Page
    public function updatePage($id){
    //    $post= Post::where('id',$id)->get()->toArray();
       $post= Post::where('id',$id)->first()->toArray();
        return view('update',compact('post'));
    }

    //edit post page
    public function editPage($id){
        $post= Post::where('id',$id)->first()->toArray();
        return view('edit',compact('post'));
    }

    // post update
    public function update(Request $request){
        $this->postValidationCheck($request);
        $updateData = $this->getPostData($request);
        $id = $request->postId;

        if($request->hasFile('postImage')){

            $oldImageName = Post::select('image')->where('id',$request->postId)->first()->toArray();
            $oldImageName = $oldImageName['image'];

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid() . "_waiphyoaung_" . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $updateData['image'] = $fileName;
        }


        Post::where('id',$id)->update($updateData);
        return redirect()->route('post#home')->with(['updateSuccess'=>'Post Updated Successfully!!']);
    }

    private function getPostData($request){
        $response = [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'price' => $request->postFee,
            'address' => $request->postAddress,
            'rating' => $request->postRating,
        ];
        return $response;
    }

    //post validation check
    private function postValidationCheck($request){
        $validated = $request->validate([
            'postTitle' => 'required|unique:posts,title,'.$request->postId,
            'postDescription' => 'required',
            'postFee' => 'required',
            'postAddress' => 'required',
            'postRating' => 'required',
            'postImage' => 'mimes:jpg,jpeg,png',
        ],[
            'postTitle.required' => 'You must fill in this title field',
            'postTitle.unique' => 'Duplicate Post Title',
            'postDescription.required' => 'You must fill in this description field',
            'postFee.required' => 'You must fill in this price field',
            'postAddress.required' => 'You must fill in this address field',
            'postRating.required' => 'You must fill in this rating field',
        ]);
    }
}
