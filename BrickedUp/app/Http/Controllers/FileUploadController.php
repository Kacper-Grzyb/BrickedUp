<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileUploadController extends Controller
{
    public function showUploadForm() 
    {
        return view('upload-data-form');
    }

    public function upload(Request $request) 
    {
        $file = $request->file('datafile');
        Log::debug($file->getMimeType());

        $request->validate([
            'datafile' => 'required|file|mimetypes:text/plain,text/csv,application/csv,application/excel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048',
        ]);

        $csvData = [];

        // Parse the CSV file
        if(($handle = fopen($file, 'r')) !== false) {
            
            // Skip the header row
            $header = fgetcsv($handle, 1000, ';');

            while(($data = fgetcsv($handle, 1000, ';')) !== false) {
                $setNumber = $data[0];
                $setName = $data[1];
                $theme = $data[2];
                $subtheme = $data[3];
                $releaseDate = $data[4];
                $retiredDate = $data[5];
                $availability = $data[6];
                $pieceCount = $data[7];
                $minifigures = $data[8];
                $retailPrice = $data[9];

                Log::info('CSV Row:', ['number' => $setNumber, 'name' => $setName, 'theme' => $theme, 'subtheme' => $subtheme, 
                'releaseDate' => $releaseDate, 'retiredDate' => $retiredDate, 'availability' => $availability, 'pieceCount' => $pieceCount,
                'minifigures' => $minifigures, 'retailPrice' => $retailPrice]);
            }

            fclose($handle);
        }
        
        return view('upload-data-form');

        //$path = $file->store('storage', 'public');


        // Add the shit to the database here

        //return show($request->file('file')->getClientOriginalName());
    }
}
