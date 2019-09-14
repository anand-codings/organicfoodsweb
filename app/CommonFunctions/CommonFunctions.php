<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Hashids\Hashids;
use Intervention\Image\Facades\Image;
use Laravel\Cashier;
use App\JobSpeciality;
use App\Notification;

function sendSuccess($message, $data = '') {
    return Response::json(array('status' => 200, 'successMessage' => $message, 'successData' => $data), 200, []);
}

function sendError($error_message, $code = '') {
    return Response::json(array('status' => 400, 'errorMessage' => $error_message), 400);
}

function addFile($file, $path) {

    if ($file) {
               
        if ($file->getClientOriginalExtension() != 'exe') {
            $type = $file->getClientMimeType();
            if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/bmp') {
//                dd($type);
                $destination_path = $path;

                $extension = $file->getClientOriginalExtension();
                $fileName = 'image_' . Str::random(15) . '.' . $extension;
                $img = Image::make($file);


                $file->move($destination_path, $fileName);
                $file_path = $destination_path . $fileName;


                return $file_path;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function timeago($ptime) {
    $difference = time() - strtotime($ptime);
    if ($difference) {
        $periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
        for ($j = 0; $difference >= $lengths[$j]; $j++)
            $difference /= $lengths[$j];

        $difference = round($difference);
        if ($difference != 1)
            $periods[$j] .= "s";

        $text = "$difference $periods[$j] ago";


        return $text;
    } else {
        return 'Just Now';
    }
}

function addProposalFile($file, $path) {




    if ($file) {
        if ($file->getClientOriginalExtension() != 'exe') {
            $type = $file->getClientMimeType();


            if ($type == 'image/jpeg' || $type == 'image/png') {
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName = 'image_' . Str::random(15) . '.' . $extension;
                $img = Image::make($file);
            } elseif ($type == 'application/pdf') {
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName = 'pdf_' . Str::random(15) . '.' . $extension;
            } else if ($type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $type=='application/octet-stream' ) {
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName = 'doc_' . Str::random(15) . '.' . $extension;
            } else if ($type == 'application/x-zip-compressed') {
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName = 'zip_' . Str::random(15) . '.' . $extension;
            } else {
                return FALSE;
            }


            $file->move($destination_path, $fileName);
            $file_path = $destination_path . $fileName;

            return $file_path;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function addProposalFileType($file, $path) {




    if ($file) {
        if ($file->getClientOriginalExtension() != 'exe') {
            $type = $file->getClientMimeType();


            if ($type == 'image/jpeg' || $type == 'image/png') {
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName = 'image_' . Str::random(15) . '.' . $extension;
                $img = Image::make($file);
            } elseif ($type == 'application/pdf') {
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName = 'pdf_' . Str::random(15) . '.' . $extension;
            } else if ($type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName = 'doc_' . Str::random(15) . '.' . $extension;
            } else {
                return FALSE;
            }


            $file->move($destination_path, $fileName);
            $file_path = $destination_path . $fileName;
            $data['path'] = $file_path;
            $data['type'] = $type;
            return $data;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function claimedContentsCount() {
    $total_find = '';
    if (Auth::check()) {
        $total_find = Label::where('user_id', Auth::id())->sum('quantity');
    }
    return $total_find;
}

function claimednotLabeled() {
    $total_find = '';
    if (Auth::check()) {
        $total_find = Photo::where('is_labeled', 0)->where('user_id', Auth::id())->count();
    }
    return $total_find;
}

function encodeId($id) {
    $hashids = new Hashids();
    return $hashids->encode($id);
}

function decodeId($id) {
    $hashids = new Hashids();
    return $hashids->decode($id);
}

function image_fix_orientation($filename) {
    $exif = @exif_read_data($filename);
    if (!empty($exif['Orientation'])) {
        $image = imagecreatefromjpeg($filename);

        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;
            case 6:
                $image = imagerotate($image, -90, 0);
                break;
            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }
        imagejpeg($image, $filename, 90);
    }
    return $filename;
}

function integerToRoman($integer) {
    // Convert the integer into an integer (just to make sure)
    $integer = intval($integer);
    $result = '';

    // Create a lookup array that contains all of the Roman numerals.
    $lookup = array('M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1);

    foreach ($lookup as $roman => $value) {
        // Determine the number of matches
        $matches = intval($integer / $value);

        // Add the same number of characters to the string
        $result .= str_repeat($roman, $matches);

        // Set the integer to be the remainder of the integer and the value
        $integer = $integer % $value;
    }

    // The Roman numeral should be built, return it
    return $result;
}

function subscribed_user($stripe_id) {
    $user = \App\Subscription::where('stripe_id', $stripe_id)->get();
    if ($user) {
        return $user[0]->getUserName->first_name;
    } else {
        return false;
    }
}

function get_subscription($stripe_id) {
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET', 'sk_test_skfGwxD3Nuja2dzEmTwAvZ8n00dWE4oQcB'));

    $subscriptions = \Stripe\Subscription::retrieve($stripe_id);

    return $subscriptions;
}

function getUserImage($image) {
    if ($image) {
        return asset($image);
    } else {
        return asset('userassets/images/left_img1.png');
    }

   

  

}
function getCategories(){
       
        $categries = JobSpeciality::all();
        
        return $categries;
    }
function getNotificationCount($id)
{
//    dd($id);
    $notification=Notification::where('to_user',$id)->where('is_read',1)->count();
//    echo '<pre>';
//    print_r($notification);
//    
//    exit;
    return $notification;
}