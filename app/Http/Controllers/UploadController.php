<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\UploadImage;
use Response;
use File;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function Upload(Request $request){
        $image  = $request->file('Image');
        $data = fopen ($image, 'rb');
        $size=filesize ($image);
        $filename= date('YmdHi').$image->getClientOriginalName();
        // dd($filename);
            $data= new UploadImage();
            $location = 'image';
            $image-> move($location, $filename);
            $data['filename'] = $filename;
            if($data->save()){
                return response()->json(["status"=>'success',"message"=>"successfully uploaded"]);
            }
            return response()->json(["status"=>'error',"message"=>"successfully uploaded"]);
    }

    public function getUploadImage(Request $request){
       $image =  UploadImage::all();
       if($image){
        return response()->json(["status"=>'success',"message"=>"Uploaded image list","datas"=>$image]);
       }
       return response()->json(["status"=>'error',"message"=>"successfully uploaded","datas"=>[]]);
    }
    
    public function downloadFile(Request $request,$id)
    {
        $uploadimage = UploadImage::find($id);
        $filename = $uploadimage->filename;
        $filepath = public_path('image/'.$filename.'');
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if($ext == 'png' || 'PNG'){
        $headers = array(
            'Content-Type:image/png',
            );
        }

        else if($ext == 'jpg' || 'jpeg' || 'JPEG' || 'JPG'){
        $headers = array(
            'Content-Type:image/jpeg',
            );
        }

        else if($ext == 'gif' || 'GIF'){
        $headers = array(
            'Content-Type:image/gif',
            );
        }
        else if($ext == 'pdf'){
            $headers = array(
                'Content-Type:application/pdf',
                );
            }
          
        $newfilename = 'download1'.$ext;
        return response()->download($filepath,$newfilename,$headers);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
