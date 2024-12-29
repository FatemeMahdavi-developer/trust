<?php

use App\Models\permissions;
use Illuminate\Support\Facades\DB;

if (!function_exists('sluggableCustomSlugMethod')) {

    function sluggableCustomSlugMethod($string, $separator = '-')
    {
        $_transliteration = array(
            '/ä|æ|ǽ/' => 'ae',
            '/ö|œ/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/À|Á|Â|Ã|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
            '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
            '/ç|ć|ĉ|ċ|č/' => 'c',
            '/Ð|Ď|Đ/' => 'D',
            '/ð|ď|đ/' => 'd',
            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
            '/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
            '/Ĝ|Ğ|Ġ|Ģ/' => 'G',
            '/ĝ|ğ|ġ|ģ/' => 'g',
            '/Ĥ|Ħ/' => 'H',
            '/ĥ|ħ/' => 'h',
            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',
            '/Ĵ/' => 'J',
            '/ĵ/' => 'j',
            '/Ķ/' => 'K',
            '/ķ/' => 'k',
            '/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
            '/ĺ|ļ|ľ|ŀ|ł/' => 'l',
            '/Ñ|Ń|Ņ|Ň/' => 'N',
            '/ñ|ń|ņ|ň|ŉ/' => 'n',
            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
            '/Ŕ|Ŗ|Ř/' => 'R',
            '/ŕ|ŗ|ř/' => 'r',
            '/Ś|Ŝ|Ş|Ș|Š/' => 'S',
            '/ś|ŝ|ş|ș|š|ſ/' => 's',
            '/Ţ|Ț|Ť|Ŧ/' => 'T',
            '/ţ|ț|ť|ŧ/' => 't',
            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
            '/Ý|Ÿ|Ŷ/' => 'Y',
            '/ý|ÿ|ŷ/' => 'y',
            '/Ŵ/' => 'W',
            '/ŵ/' => 'w',
            '/Ź|Ż|Ž/' => 'Z',
            '/ź|ż|ž/' => 'z',
            '/Æ|Ǽ/' => 'AE',
            '/ß/' => 'ss',
            '/Ĳ/' => 'IJ',
            '/ĳ/' => 'ij',
            '/Œ/' => 'OE',
            '/ƒ/' => 'f'
        );
        $quotedReplacement = preg_quote($separator, '/');
        $merge = array(
            '/[^\s\p{Zs}\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
            '/[\s\p{Zs}]+/mu' => $separator,
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        );
        $map = $_transliteration + $merge;
        unset($_transliteration);
        return preg_replace(array_keys($map), array_values($map), $string);
    }
}


if (!function_exists('formatSizeUnits')) {

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1024) {
            $kilobytes = $bytes / 1024;
            return number_format($kilobytes, 2) . ' KB';
        }
        return $bytes . ' bytes';
    }
}


if (!function_exists('getMaxSize')) {
    function getMaxSize($module, $filed_name)
    {
        $sizes = resize_image()[$module][$filed_name];
        $minimums_size = '[]';
        $width_max = 0;
        if (!empty($sizes)) {
            foreach ($sizes as $size) {
                if (!empty($size)) {
                    foreach ($size as $width => $height) {
                        if ($width > $width_max) {
                            $width_max = $width;
                            $minimums_size = sprintf("(%sx%s)", $width, $height);
                        }
                    }
                }
            }
        }
        return (($minimums_size == "[]") ? "" : $minimums_size);
    }
}
if (!function_exists('to_english_numbers')) {
    function to_english_numbers(string $string): string
    {
        $persinaDigits1 = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $persinaDigits2 = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $allPersianDigits = array_merge($persinaDigits1, $persinaDigits2);
        $replaces = [...range(0, 9), ...range(0, 9)];
        $integer = str_replace($allPersianDigits, $replaces, $string);

        return (int)$integer;
    }
}



//public function check_mobile($attribute, $value, $parameters)
//{
//    $paramsPatternMap = [
//        'zero_code'    => '/^(00989){1}[0-9]{9}+$/',
//        'plus'         => '/^(\+989){1}[0-9]{9}+$/',
//        'code'         => '/^(989){1}[0-9]{9}+$/',
//        'zero'         => '/^(09){1}[0-9]{9}+$/',
//        'without_zero' => '/^(9){1}[0-9]{9}+$/',
//    ];
//
//    if (isset($parameters[0]) && in_array($parameters[0], array_keys($paramsPatternMap))) {
//        return preg_match($paramsPatternMap[$parameters[0]], $value);
//    }
//
//    return (preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $value) || preg_match('/^(9){1}[0-9]{9}+$/', $value))? true : false;
//}

//
//
if (!function_exists('check_mobile')) {
    function check_mobile($mobile)
    {
        $paramsPatternMap = [
            'zero_code' => '/^(00989){1}[0-9]{9}+$/',
            'plus' => '/^(\+989){1}[0-9]{9}+$/',
            'code' => '/^(989){1}[0-9]{9}+$/',
            'zero' => '/^(09){1}[0-9]{9}+$/',
            'without_zero' => '/^(9){1}[0-9]{9}+$/',
        ];
        foreach ($paramsPatternMap as $pattern) {
            if (preg_match($pattern, $mobile)) {
                return $pattern;
            }
        }
        return false;
    }

}

if (!function_exists('code_string')) {
    function code_string($value)
    {
        return base64_encode(base64_encode($value));
    }
}


if (!function_exists('decode_string')) {
    function decode_string($value)
    {
        return base64_decode(base64_decode($value));
    }
}

if (!function_exists('convert_to_timestamp')) {
    function convert_to_timestamp($date_persian, $separator="-")
    {
        $test = explode($separator, $date_persian);
        return (new \Morilog\Jalali\Jalalian(... $test))->getTimestamp();
    }
}

if(!function_exists('show_price')){
    function show_price($price){
        return number_format($price);
    }
}

if (!function_exists('permission_access')) {
    function permission_access($module){
        return permissions::where("module",$module)->get(["title","module"])->pluck("permission_kind")->toArray();
    }
}

if (!function_exists('OpenNeweTab')) {
    function OpenNeweTab($url='',$open_type=1){
        if(preg_match('/^(http|https)/',$url)){
            $open_type=2;
        }elseif($url="javascript:void(0)"){
            $open_type=1;
        }
        if($open_type == 2){
            return "target=_blank";
        }
    }
}

// if (!function_exists('ismobeile')) {
//     function ismobeile($url='',$open_type=1){
//         if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'mobile'))) {
//         }
//     }
// }
