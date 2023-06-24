<?php

if (!function_exists('base64Upload')) {
    function base64Upload($img, $path = "", $disk = "public")
    {
        list($type, $file_data) = explode(';', $img);
        list(, $file_data) = explode(',', $file_data);

        $file_name = "{$path}" . uniqid("", true) . ".png";
        \Illuminate\Support\Facades\Storage::disk($disk)->put($file_name, base64_decode($file_data), 'public');
        return $file_name;
    }
}


if (!function_exists('uploadAnyFile')) {
    function uploadAnyFile($file, $path = "", $disk = "public")
    {
        $file_content = $file->getContent();
        $file_name = "{$path}" . uniqid("", true) . "." . $file->getClientOriginalExtension();
        \Illuminate\Support\Facades\Storage::disk($disk)->put($file_name, $file_content, 'public');
        return $file_name;
    }
}

if (!function_exists('uploadAnyFileWithName')) {
    function uploadAnyFileWithName($file, $path = "", $disk = "public")
    {
        $file_content = $file->getContent();
        $file_name = "{$path}" . $file->getClientOriginalName();
        \Illuminate\Support\Facades\Storage::disk($disk)->put($file_name, $file_content, 'public');
        return $file_name;
    }
}


if (!function_exists('money')) {
    function money($amount)
    {
        return number_format($amount, 2);
    }
}


if (!function_exists('mask_account_number')) {
    function mask_account_number($number)
    {
        $mask_number =  str_repeat("x", strlen($number) - 4) . substr($number, -4);

        return $mask_number;
    }
}

if (!function_exists('assignLetterToNumber')) {
    function assignLetterToNumber($number)
    {
        if (!is_int($number) || $number < 1) {
            return null;
        }

        if ($number > 26) {
            $firstLetterIndex = intval(($number - 1) / 26);
            $asciiValueOfFirstLetter = ord('A') + $firstLetterIndex - 1;
            $firstLetter = chr($asciiValueOfFirstLetter);
            $secondLetterIndex = ($number - 1) % 26 + 1;
            $asciiValueOfSecondLetter = ord('A') + $secondLetterIndex - 1;
            $secondLetter = chr($asciiValueOfSecondLetter);
            return $firstLetter . $secondLetter;
        }

        $asciiValueOfLetter = ord('A') + $number - 1;
        $letter = chr($asciiValueOfLetter);
        return $letter;
    }
}
