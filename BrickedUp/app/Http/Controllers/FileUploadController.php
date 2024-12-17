<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Set;
use App\Models\SetPrice;
use DB;

class FileUploadController extends Controller
{
    public function showUploadForm() 
    {
        return view('upload-data-form');
    }

    // Receives the set data from a form request and passes it into the page for inspection
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

    // Processes request data and uploads the sets into the database
    public function uploadData(Request $request) 
    {
        // just in case 
        ini_set('max_execution_time', 600);

        Log::info($request->input('data'));
        $data = json_decode($request->input('data'), true);

        // Set up the check tables so that the program does not query the database multiple times for each record
        $availResp = DB::table('availability')->get();
        $availabilityMap = [];
        foreach($availResp as $resp) 
        {
            $availabilityMap[] = [
                'id' => $resp->id,
                'availability' => $resp->availability
            ];
        }

        $themeResp = DB::table('themes')->get();
        $themeMap = [];
        foreach($themeResp as $resp) 
        {
            $themeMap[] = [
                'id' => $resp->id,
                'theme' => $resp->theme
            ];
        }

        $subthemeResp = DB::table('subthemes')->get();
        $subthemeMap = [];
        foreach($subthemeResp as $resp) 
        {
            $subthemeMap[] = [
                'id' => $resp->id,
                'subtheme' => $resp->subtheme
            ];
        }
        

        if(is_array($data)) 
        {
            $bulkData = [];

            foreach($data as $row) 
            {
                $bulkDataRow = $this->prepareSetForInsert($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $themeMap, $subthemeMap, $availabilityMap);
                if($bulkDataRow['set_number'] !== -1) 
                {
                    $bulkData[] = $bulkDataRow;
                    //DB::table('sets')->insert($bulkDataRow);
                }

                // if($this->insertSetRecord($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9])) 
                // {
                //     Log::info('Set record ' . $row[0] . ' added successfully');
                // }
                // else 
                // {
                //     Log::info('There was an issue with adding set record ' . $row[0]);
                // }
            } 

            $chunks = array_chunk($bulkData, 1000);
            foreach($chunks as $chunk) 
            {
                DB::table('sets')->insert($chunk);
            }
        }
        else 
        {
            return '<p>Something went wrong during file upload. The data received was not an array.<p> <a href="/home">Return to home page</a>'; 
        }
        
        return '<p>Data successfully uploaded<p> <a href="/dashboard">Return to home page</a>';
    }

    public function generateSetPriceDummyData(Request $request)
    {
        $sets = Set::get();
        for ($i = 0; $i < 50; $i++) {
            $randomIndex = rand(0, count($sets) - 1); // Fix random index calculation
            
            DB::table('set_prices')->insert([
                'set_number' => $sets[$randomIndex]->set_number,
                'record_date' => date(
                    'Y-m-d',
                    rand(mktime(0, 0, 0, 12, 1, 2024), mktime(0, 0, 0, 12, 17, 2024))
                ),
                'price' => ($sets[$randomIndex]->retail_price ?? 0) + rand(-100, 100)
            ]);

        }

        return '<p>Data generated successfully<p> <a href="/dashboard">Return to home page</a>';
    }

    public function calculatePriceChanges(Request $request) 
    {
        $sets = Set::get();
        foreach($sets as $set) {
            $setPrices = SetPrice::where('set_number', $set->set_number)->orderBy('record_date', 'desc')->get();
            if(count($setPrices) >= 2) {
                $set->price_change = round(($setPrices[0]->price - $setPrices[1]->price) / $setPrices[1]->price, 2) * 100;
                $set->save();
            }
        }

        return back();
    }

    private function randomDate($start_timestamp, $end_timestamp)
    {
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);
    
        // Generate random number using above bounds
        $val = rand($min, $max);
    
        // Convert back to desired date format
        return date('Y-m-d H:i:s', $val);
    }
    
    // If the set cannot be added to the database, $set_number will be set to -1
    public function prepareSetForInsert($set_number, $set_name, $theme, $subtheme, $release_date, $retired_date, $availability, $piece_count, $minifigures, $retail_price, $themeMap, $subthemeMap, $availabilityMap) 
    {
        // define the return variable
        $result = [
            'set_number' => null,
            'set_name' => null,
            'theme_id' => null,
            'subtheme_id' => null,
            'release_date' => null,
            'retired_date' => null,
            'availability_id' => null,
            'piece_count' => null,
            'minifigures' => null,
            'retail_price' => null
        ];

        // Check if the database already has a set with the same set number 
        $existsCheck = DB::table('sets')
        ->select('set_number')
        ->where('set_number', '=', $set_number)
        ->get();
            
        // If there are no records in the database with that set number, add the set
        if(count($existsCheck) === 0) 
        {
            $themeId = $this->getThemeId($theme, $themeMap);
            if($themeId === -1) 
            {
                Log::info('Set number not added:' . $set_number . '\nReason: Set theme does not exist in the database');
                $result['set_number'] = -1;
                return $result;
            }

            $subthemeId = $this->getSubthemeId($subtheme, $subthemeMap);
            if($subthemeId === -1) 
            {
                Log::info('Set number not added:' . $set_number . '\nReason: Set subtheme does not exist in the database');
                $result['set_number'] = -1;
                return $result;
            }

            $availabilityId = $this->getAvailabilityId($availability, $availabilityMap);
            if($availabilityId === -1) 
            {
                Log::info('Set number not added:' . $set_number . '\nReason: Set availability does not exist in the database');
                $result['set_number'] = -1;
                return $result;
            }

            if($release_date === '' || $release_date === null) 
            {
                Log::info('Set number not added:' . $set_number . '\nReason: Set release date was not provided');
                $result['set_number'] = -1;
                return $result;
            }
            else // change the date to correct format
            {
                $release_date = \DateTime::createFromFormat('d/m/Y', $release_date)->format('Y-m-d');
            }

            // set retired date to null if it was not provided
            if($retired_date === '') 
            {
                $retired_date = null;
            }
            else // else set the date to the correct format
            {
                $retired_date = \DateTime::createFromFormat('d/m/Y', $retired_date)->format('Y-m-d');
            }

            if($retail_price === '') 
            {
                $retail_price = null;
            }
            else 
            {
                $retail_price = str_replace(',', '.', $retail_price);
            }

            if($piece_count === '') 
            {
                Log::info('Set number not added:' . $set_number . '\nReason: No piece count provided');
                $result['set_number'] = -1;
                return $result;
            }

            $result['set_number'] = $set_number;
            $result['set_name'] = $set_name;
            $result['theme_id'] = $themeId;
            $result['subtheme_id'] = $subthemeId;
            $result['release_date'] = $release_date;
            $result['retired_date'] = $retired_date;
            $result['availability_id'] = $availabilityId;
            $result['piece_count'] = $piece_count;
            $result['minifigures'] = $minifigures;
            $result['retail_price'] = $retail_price;

            return $result;
        }
        else 
        {
            Log::info('Set number not added:' . $set_number . '\nReason: Set already exists in the database');
            $result['set_number'] = -1;
            return $result;
        }
    }

    // Returns a boolean value indicating whether the operation was successful or not
    public function insertSetRecord($set_number, $set_name, $theme, $subtheme, $release_date, $retired_date, $availability, $piece_count, $minifigures, $retail_price): bool
    {
        // Set up the check tables so that the program does not query the database multiple times for each record
        $availResp = DB::table('availability')->get();
        $availabilityCheck = [];
        foreach($availResp as $resp) 
        {
            $availabilityCheck[] = [
                'id' => $resp->id,
                'availability' => $resp->availability
            ];
        }

        $themeResp = DB::table('themes')->get();
        $themeCheck = [];
        foreach($themeResp as $resp) 
        {
            $themeCheck[] = [
                'id' => $resp->id,
                'theme' => $resp->theme
            ];
        }

        $subthemeResp = DB::table('subthemes')->get();
        $subthemeCheck = [];
        foreach($subthemeResp as $resp) 
        {
            $subthemeCheck[] = [
                'id' => $resp->id,
                'subtheme' => $resp->subtheme
            ];
        }

        // Check if the database already has a set with the same set number 
        $existsCheck = DB::table('sets')
                    ->select('set_number')
                    ->where('set_number', '=', $set_number)
                    ->get();
                
        // If there are no records in the database with that set number, add the set
        if(count($existsCheck) === 0) 
        {
            $themeId = $this->getThemeIdDb($theme);
            if($themeId === -1) 
            {
                Log::info('Set number not added:' . $set_number . '\nReason: Set theme does not exist in the database');
                return false;
            }

            $subthemeId = $this->getSubthemeIdDb($subtheme);
            if($subthemeId === -1) 
            {
                Log::info('Set number not added:' . $set_number . '\nReason: Set subtheme does not exist in the database');
                return false;
            }

            $availabilityId = $this->getAvailabilityIdDb($availability);
            if($availabilityId === -1) 
            {
                Log::info('Set number not added:' . $set_number . '\nReason: Set availability does not exist in the database');
                return false;
            }

            if($release_date === '' || $release_date === null) 
            {
                Log::info('Set number not added:' . $set_number . '\nReason: Set release date was not provided');
                return false;
            }
            else // change the date to correct format
            {
                $release_date = \DateTime::createFromFormat('d/m/Y', $release_date)->format('Y-m-d');
            }

            // set retired date to null if it was not provided
            if($retired_date === '') 
            {
                $retired_date = null;
            }
            else // else set the date to the correct format
            {
                $retired_date = \DateTime::createFromFormat('d/m/Y', $retired_date)->format('Y-m-d');
            }

            if($retail_price === '') 
            {
                $retail_price = null;
            }
            else 
            {
                $retail_price = str_replace(',', '.', $retail_price);
            }

            $insertStatus = DB::table('sets')->insert([
                'set_number' => $set_number,
                'set_name' => $set_name,
                'theme_id' => $themeId,
                'subtheme_id' => $subthemeId,
                'release_date' => $release_date,
                'retired_date' => $retired_date,
                'availability_id' => $availabilityId,
                'piece_count' => $piece_count,
                'minifigures' => $minifigures,
                'retail_price' => $retail_price
            ]);

            return $insertStatus;

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
            Log::info('Set number not added:' . $set_number . '\nReason: Set already exists in the database');
            return false;
        }
    }

    public function getThemeId($themeName, $themeMap) 
    {
        foreach($themeMap as $pair) 
        {
            if($pair['theme'] === $themeName) 
            {
                return $pair['id'];
            }
        }
        return -1;
    }

    // Returns -1 if given theme does not exist
    public function getThemeIdDb($themeName) 
    {
        $row = DB::table('themes')->select('id')->where('theme', '=', $themeName)->get()->first();
        if($row === null) 
        {
            return -1;
        }
        else 
        {
            return $row->id;
        }
    }

    public function getSubthemeId($subthemeName, $subthemeMap) 
    {
        if($subthemeName === '' || $subthemeName === ' ' || $subthemeName === '-' || $subthemeName === null) 
        {
            $row = DB::table('subthemes')->select('id')->whereNull('subtheme')->get()->first();
            if($row === null) 
            {
                return -1;
            }
            else  
            {
                return $row->id;
            }
        }

        foreach($subthemeMap as $pair) 
        {
            if($pair['subtheme'] === $subthemeName) 
            {
                return $pair['id'];
            }
        }
        return -1;
    }

    // Returns -1 if given subtheme does not exist or assigns the null subtheme id if the provided subtheme was empty
    public function getSubthemeIdDb($subthemeName) 
    {
        if($subthemeName === '' || $subthemeName === ' ' || $subthemeName === '-' || $subthemeName === null) 
        {
            $row = DB::table('subthemes')->select('id')->whereNull('subtheme')->get()->first();
            if($row === null) 
            {
                return -1;
            }
            else  
            {
                return $row->id;
            }
        }

        $row = DB::table('subthemes')->select('id')->where('subtheme', '=', $subthemeName)->get()->first();
        if($row === null) 
        {
            return -1;
        }
        else 
        {
            return $row->id;
        }
    }

    public function getAvailabilityId($availabilityName, $availabilityMap) 
    {
        foreach($availabilityMap as $pair) 
        {
            if($pair['availability'] === $availabilityName) 
            {
                return $pair['id'];
            }
        }
        return -1;
    }

    // Returns -1 if given availability name does not exist
    public function getAvailabilityIdDb($availabilityName) 
    {
        $row = DB::table('availability')->select('id')->where('availability', '=', $availabilityName)->get()->first();
        if($row === null) 
        {
            return -1;
        }
        else 
        {
            return $row->id;
        }
    }

    public function downloadCsvTemplate() 
    {
        return response()->download('upload-template.csv');
    }

}
