<?php

namespace app\helper;

class Param
{
    public static function hiddenField($rs, $fields)
    {
        $rs2 = $rs2 ?? [];
        foreach ($rs as $key => $value) {
            if (is_array($value)) {
                $rs2[$key] = self::hiddenField($value, $fields);
            } else {
                if (in_array($key, $fields)) {
                    continue;
                }

                $rs2[$key] = $value;
            }
        }

        return $rs2;
    }

    public static function revertJson($rs, $fields)
    {
        $rs2 = $rs2 ?? [];
        foreach ($rs as $key => $value) {
            if (is_array($value)) {
                $rs2[$key] = self::revertJson($value, $fields);
            } else {
                if (in_array($key, $fields)) {
                    $value = json_decode($value, true);
                }

                $rs2[$key] = $value;
            }
        }

        return $rs2;
    }
}
