<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Set;
use DB;

class FileUploadController extends Controller
{
    public function showUploadForm() 
    {
        return view('upload-data-form');
    }

    public function receiveData(Request $request) 
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

                // Adding a new row to the csvData two-dimensional array
                $csvData[] = $data;

                Log::info('CSV Row:', ['number' => $setNumber, 'name' => $setName, 'theme' => $theme, 'subtheme' => $subtheme, 
                'releaseDate' => $releaseDate, 'retiredDate' => $retiredDate, 'availability' => $availability, 'pieceCount' => $pieceCount,
                'minifigures' => $minifigures, 'retailPrice' => $retailPrice]);
            }

            fclose($handle);
        }
        
        return view('upload-data-form', ['csvData' => $csvData]);
    }

    public function uploadData(Request $request) 
    {
        Log::info($request->input('data'));
        $data = json_decode($request->input('data'), true);

        if(is_array($data)) 
        {
            foreach($data as $row) 
            {
                $existsCheck = DB::table('sets')
                    ->select('set_number')
                    ->where('set_number', '=', $row[0])
                    ->get();
                
                // If there are no records in the database with that set number
                if(empty($existsCheck)) 
                {
                    $set = new Set;

                    $set->set_number = $row[0];
                    $set->set_name = $row[1];
                    $set->theme_id = DB::select('id')->distinct()->where('theme', '=', $row[2])->get()[0];
                    $set->subtheme_id = DB::select('id')->distinct()->where('subtheme', '=', $row[3])->get()[0];
                    $set->release_date = $row[4];
                    $set->retired_date = $row[5];
                    $set->availability_id = DB::select('id')->distinct()->where('availability', '=', $row[6])->get()[0];
                    $set->piece_count = $row[7];
                    $set->minifigures = $row[8];
                    $set->retail_price = $row[9];

                    Log::info("supposedly added somewhere the set below");
                    Log::info($set);
                    $set->save();
                }
                else 
                {
                    Log::info('Set number was not added ' . $row[0]);
                }
            } 
        }
        else 
        {
            return "<p>Something went wrong during file upload. The data received was not an array!<p> <a href='/home'>Return to home page</a>"; 
        }
        
        return "<p>Data successfully uploaded<p> <a href='/home'>Return to home page</a>";
    }
}
