<?php

namespace App\Helpers\admin;


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


?>
