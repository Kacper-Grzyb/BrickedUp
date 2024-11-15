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
        if(!isset($file)) return view("upload-data-form");
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
                // Try to get a record with the provided set number from the database
                $existsCheck = DB::table('sets')
                    ->select('set_number')
                    ->where('set_number', '=', $row[0])
                    ->get();
                
                // If there are no records in the database with that set number, add the set
                if(count($existsCheck) == 0) 
                {
                    DB::table('sets')->insert([
                        'set_number' => $row[0],
                        'set_name' => $row[1],
                        'theme_id' => DB::table('themes')->select('id')->where('theme', '=', $row[2])->get()[0]->id,
                        'subtheme_id' => DB::table('subthemes')->select('id')->where('subtheme', '=', $row[3])->get()[0]->id,
                        'release_date' => $row[4],
                        'retired_date' => $row[5],
                        'availability_id' => DB::table('availability')->select('id')->where('availability', '=', $row[6])->get()[0]->id,
                        'piece_count' => $row[7],
                        'minifigures' => $row[8],
                        'retail_price' => str_replace(',', '.', $row[9])
                    ]);

                    // This can also be achieved with the approach below:
                    // $set = new Set;
                    // $set->set_number = $row[0];
                    // $set->set_name = $row[1];
                    // $set->theme_id = DB::table('themes')->select('id')->where('theme', '=', $row[2])->get()[0]->id;
                    // $set->subtheme_id = DB::table('subthemes')->select('id')->where('subtheme', '=', $row[3])->get()[0]->id;
                    // $set->release_date = $row[4];
                    // $set->retired_date = $row[5];
                    // $set->availability_id = DB::table('availability')->select('id')->where('availability', '=', $row[6])->get()[0]->id;
                    // $set->piece_count = $row[7];
                    // $set->minifigures = $row[8];
                    // $set->retail_price = str_replace(',', '.', $row[9])
                    // $set->save(); // Adds the record to the database
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

    public function downloadCsvTemplate() 
    {
        return response()->download('upload-template.csv');
    }
}
