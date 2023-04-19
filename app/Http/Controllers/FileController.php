<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\File;
class FileController extends Controller
{

    public function upload(Request $request)
    {
        // Get the file from the request
        $file = $request->file('file');
    
        // Validate the file
        $validator = Validator::make(['file' => $file], [
            'file' => 'required|mimes:pdf,doc,docx,png,jpg|max:2048'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }


            
    
        // Save the file

        $filename = time() . '_' . $file->getClientOriginalName();
       

            $data         = $request->all();

            $data['file'] = $filename;

            $insert       = File::create($data);

            if(!$insert){

                return response()->json(['error' => 'Invalid request.']);

            }

        $file->move(public_path('uploads'), $filename);
    
        // Return a response
        return response()->json(['filename' => $filename], 200);
    }
    

}
