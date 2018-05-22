<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Database\Query\Builder::lists;
//use App\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Redirect;
use File;
use Session;
use DB;
use Excel;

use App\artical;
use App\ArticalRelation;
define('base_path', 'localhost:8000');


class BlogsController extends Controller
{

    // public function __construct(\Maatwebsite\Excel\Exporter $excel)
    // {
    //     $this->excel = $excel;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $enter = $request->input('enter');
        $blogs = Blog::orderBy('created_at','desc')->search($enter)->paginate(10);
        return view('blog.list',compact('blogs','enter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
       $artname= artical::get();
       //return $artname;
       return view('blog.add',compact('artname'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = Input::get('title');
        $titledes = Input::get('description');
        $titlefile = Input::file('fileUpload');

        $this->validate($request,[
               'title'=>'Required',
               'description'=>'Required',
               'fileUpload'=>'Required|max:10000|mimes:doc,docx,jpeg,jpg,png'
         ]);
           // echo "success validator";

            //checking image validation
                if (Input::file('fileUpload')->isValid()) {

                    //for getting file or image extension
                   // $extension = Input::file('fileUpload')->getClientOriginalExtension();

                    //for getting file original name
                    $originalName=rand(1, 99).'-'.Input::file('fileUpload')->getClientOriginalName();

                    //renaming file extension
                    //$filename =  $originalName.rand(1, 99).'.'.$extension;
                  
                    //upload image 
                    $destinationPath = base_path().'\public\storage\uploads';
                    //echo $destinationPath; die;
                   // print_r(Input::file('fileUpload'));
                   //moving file
                    Input::file('fileUpload')->move($destinationPath,$originalName);
    
                    $blog = new Blog();
                    $blog->title=$request->title;
                    $blog->description=$request->description;
                    $blog->fileUpload=$originalName;
                    $blog->save();
                    $last_blog_id = $blog->id;
                        // $artname= artical::get();
                   // print_r($request->artical) ;die;
                    foreach(Input::get('artical') as $selected_id){  
                           $artical_post = new ArticalRelation();
                           $artical_post->blog_id=$last_blog_id;
                           $artical_post->article_id=$selected_id;
                           $artical_post->save();
                      }
                     //print_r($artical_post);


                    $notification =array(
                            'message' => 'Your file uploaded successfully',
                            'alert_type' =>'success'
                        );

                     return Redirect::to('blog')->with($notification);

                }
                else{

                    $notification =array(
                            'message' => 'Your file is not uploaded',
                            'alert_type' =>'error'
                        );
                     return Redirect::to('blog')->with($notification);

                }   
                    return redirect('blog');

     }
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return $id;
        $blog = Blog::find($id);
        //return $blog;
        return view('blog.edit', compact('blog'));
        //return view('blog.edit', ['blog'=>$blog]);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $id;
        return "hello";

        // $this->validate($request,[
        //     'title'=>'Required',
        //     'description'=>'Required'
        //     ]);
        // $blog = Blog::find($id);
        // $blogUpdate = $request->all();
        // $blog->update($blogUpdate);
        // return redirect('blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //    $blog = Blog::find($id);
    //    $blog->delete();
    //    return redirect('blog');
    // }

    public function destroy($id)
  {   //For Deleting blog
    //echo 'hello';
    // $blog = new Blog;
    // $blog = Blog::find($id);
    // $blog->delete($id);
    // return response()->json([
    //     'success' => 'Blog has been deleted successfully!'
    // ]);

        DB::table("blogs")->delete($id);
        return response()->json(['success'=>"Blog Deleted successfully.", 'tr'=>'tr_'.$id]);
  }

    public function updateData(Request $request, $id)
    {
        return $id;
      
    }


    public function downloadExcel12(Request $request, $type)
    {
        //echo $type;
        //echo '</br>';
        $data = Blog::get()->toArray();
        //print_r($data);
        // return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
        //     $excel->sheet('mySheet', function($sheet) use ($data)
        //     {
        //         $sheet->fromArray($data);
        //     });
        // })->download($type);

       
    }

    public function downloadExcel123(Request $request, $type)
    {
        //echo "string";
    
 
  $data = array(
    array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25),
    array("firstname" => "Amanda", "lastname" => "Miller", "age" => 18),
    array("firstname" => "James", "lastname" => "Brown", "age" => 31),
    array("firstname" => "Patricia", "lastname" => "Williams", "age" => 7),
    array("firstname" => "Michael", "lastname" => "Davis", "age" => 43),
    array("firstname" => "Sarah", "lastname" => "Miller", "age" => 24),
    array("firstname" => "Patrick", "lastname" => "Miller", "age" => 27)
  );
  //print_r($data);

 // // filename for download
  $filename = "website_data_" . date('Ymd') . ".csv";
  //echo $filename;

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: text/csv");

 $out = fopen("php://output", 'w');
  //echo $out;

  $flag = false;
   //echo $flag;
  foreach($data as $row) {
   // echo "enter";
    if(!$flag) {
        //echo 'reached';
      // display field/column names as first row
      fputcsv($out, array_keys($row), ',', '"');
      $flag = true;
    }
    array_walk($row, __NAMESPACE__ . '\cleanData');
    fputcsv($out, array_values($row), ',', '"');
    //echo 'reachedddddd';
  }

  fclose($out);
  exit;
    }

      function cleanData(&$str)
  {
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

   

    public function downloadExcel(Request $request, $type)
    {
           // output headers so that the file is downloaded rather than displayed
    header('Content-type: text/csv');
    header('Content-Disposition: attachment; filename="demo.csv"');
     
    // do not cache the file
    header('Pragma: no-cache');
    header('Expires: 0');
     
    // create a file pointer connected to the output stream
    $file = fopen('php://output', 'w');
   //echo "string";
     
  //   // send the column headers
   fputcsv($file, array('id', 'title', 'fileUpload', 'description', 'created_at','updated_at'));
  //  //echo $set;
 
  //  // Open the connection
     $link = mysqli_connect('localhost', 'root', '', 'test');
  //    //echo $link;
     
  //   // //query the database
     $query = 'SELECT * FROM blogs';
   // echo $query;
     
    if ($rows = mysqli_query($link, $query))
    {
    // loop over the rows, outputting them
    while ($row = mysqli_fetch_assoc($rows))
    {
       // echo "update";
    fputcsv($file, $row);
    //print_r($setdata);
    }
    // free result set
    //mysqli_free_result($result);
    }
  //  close the connection
    mysqli_close($link);
    exit();
    }

   

 
}
