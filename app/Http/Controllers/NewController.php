<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


class NewController extends Controller
{
    public function blog(Request $rq){
        $search = $rq->get('search');
        if ($search != '') {
            $array_blogs = News::orderBy("id", "desc")->where("title", "like", "%$search%")->paginate(10);
            return view('admin.blog', [
                'array_blogs' => $array_blogs
            ]);
        } else {
            $array_blogs = News::orderBy("id", "desc")->paginate(10);
            return view('admin.blog', [
                'array_blogs' => $array_blogs
            ]);
        }
    }

    public function blog_upload(Request $rq)
    {
        $fileExtension = $rq->file('thumbnail')->getClientOriginalExtension();
        $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
        $uploadPath = public_path('/image/blog');
        $rq->file('thumbnail')->move($uploadPath, $fileName);
        $data = $rq->all();
        $data['thumbnail'] = $fileName;
        $data['created_at'] = Carbon::now()->format('Y-m-d');
        $data['updated_at'] = Carbon::now()->format('Y-m-d');
        News::create($data);
        return redirect()->route('admin.blog')->with('msg', 'Upload new data successfully!!!');
    }
    public function blog_update(Request $request, $id, News $news)
    {
        $data = $news::find($id);
        $existPath = public_path("/image/blog/{$data->thumbnail}");
        $fileName = $data->thumbnail;
        if ($request->file('thumbnail') != null) {
            File::delete($existPath);
            $fileExtension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
            $uploadPath = public_path('/image/blog');
            $request->file('thumbnail')->move($uploadPath, $fileName);
        }
        $data->title = $request->title;
        $data->content = $request->content;
        $data['thumbnail'] = $fileName;
        $data['updated_at'] = Carbon::now()->format('Y-m-d');
        $data->save();
        return redirect()->back()->with('msg', "Update at blog $id success!!!");
    }
    public function delete_blog($id)
    {
        $data = News::find($id);
        $uploadPath = public_path("/image/blog/{$data->thumbnail}");
        File::delete($uploadPath);
        $data->delete();
        return redirect()->back()->with('msg', "Blog $id has deleted successfully !!!");
    }
    public function image_blog_upload(Request $request){
        $uploadPath = 'storage/blog';
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = ($fileName) . '_' . time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $extension;
            $request->file('upload')->move(public_path($uploadPath), $fileName);
            $url = asset($uploadPath . '/' . $fileName);
         }
        return response()->json([
            'url' => $url
        ]);
    }

    public function blogs_page (Request $request){
        $data = News::orderBy("id","desc")->paginate(12);
        return view("blogs",[
            'data' => $data
        ]);
    }
    public function view_one_blog (Request $request,$title){
        $single = News::where("title",$title)->get();
        $data = News::where("title",'!=',$title)->orderBy("id","desc")->limit(4)->get();
        return view("singleBlog",[
            'data' => $data,
            'single'=>$single
        ]);
    }
}
