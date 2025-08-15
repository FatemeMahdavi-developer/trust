<?php

namespace App\Helpers\admin;

use App\Base\Entities\Enums\UrlEnum;

if(!function_exists('makeDefaultColumns')) {
    function makeDefaultColumns(\Illuminate\Database\Schema\Blueprint $table): void
    {
        $table->string("lang",5)->default("fa");
        $table->foreignId('admin_id')->constrained()->nullable()->onUpdate('cascade');
        $table->string('status',30)->nullable();
        $table->integer("order")->default("0");
    }
}

if(!function_exists('enumAsOptions')) {
    /**
     * Enum transformer to array for use in select options in front
     * @param array $cases
     * @param array $languages
     * @param bool $asString
     * @return array
     */
    function enumAsOptions(array $cases, array $languages, bool $asString = false): array
    {
        $options = [];
        foreach ($cases as $case)
        {
            $options[] = [
                'label' => enumTranslator($asString ? $case->value : $case, $languages),
                'value' => $case->value,
            ];
        }
        return $options;
    }
}

if(!function_exists('enumTranslator')) {
    /**
     * Translate each enum case
     * @param $enumCase
     * @param array $languages
     * @param string|int|null $defaultValue
     * @param array $replace
     * @return string|int|null
     */
    function enumTranslator($enumCase, array $languages, null|string|int $defaultValue = null, array $replace = []): null|string|int
    {
        if (empty($enumCase)) {
            return null;
        }
        if (!empty($replace)) {
            $replace[':'] = '';
        }
        if (is_string($enumCase) || is_integer($enumCase)) {
            return stringReplacer(
                $languages[$enumCase] ?? $defaultValue ?? $enumCase,
                $replace,
            );
        }

        $source = $languages[get_class($enumCase)] ?? [];
        return stringReplacer($source[$enumCase->name] ?? $defaultValue, $replace);
    }
}

if (!function_exists('stringReplacer')) {
    /**
     * @param string|null $subject
     * @param array $replace
     * @return string|int|null
     */
    function stringReplacer(null|string $subject, array $replace = []): null|string|int
    {
        if (is_null($subject)) {
            return null;
        }
        if (empty($replace)) {
            return $subject;
        }
        return str_replace(
            array_keys($replace),
            array_values($replace),
            $subject,
        );
    }
}



if (!function_exists('sms')) {
    /**
     * @param string|null $subject
     * @param array $replace
     * @return string|int|null
     */
    function sms(string $mobile, string $text ='')
    {
        $url = UrlEnum::MELI_PAYAMAK.'/'.UrlEnum::MELI_PAYAMAK_KEY();

        $data = array('from' =>UrlEnum::MELI_PAYAMAk_PHONE_NUMBER(), 'to' =>$mobile, 'text' =>$text);

        $data_string = json_encode($data);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
          array('Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
          );

        $result = curl_exec($ch);

        curl_close($ch);
        
        return '';
    }
}


?>
