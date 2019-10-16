<?php 

/**
 * @param $persons
 */
public function personsCsvParentToChild($persons)
{
    $arrayTabGlobal = [];

    $offsets = ["–", " - ", "</br>"];

    foreach ($persons as $key => $person) {
        array_push($arrayTabGlobal, $this->arrayOperator($person['customValues'], $offsets));
    }

    dump($arrayTabGlobal);
}

/**
 * @param $delimiters
 * @param $string
 * @return array
 */
public function multiExplode($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);

    return  $launch;
}

/**
 * @param $customValues
 * @param $offset
 * @return array
 */
public function arrayOperator($customValues, $offset)
{
    $arrSetting = [];

    if(isset($customValues) && !is_null($customValues)) {

        $response = $this->multiexplode($offset, $customValues);

        foreach ($response as $key => $value) {

            if(strstr( $value, ':' ) !== false) {
                $tab = explode(":", $value, -1);
                $start = strpos( $value, ":") + 1;
                $content = substr($value, $start, strlen($value));

                array_push($arrSetting, [
                    'year' => $tab[0],
                    'freshman' => $content
                ]);
            } else {
                $lastValue = count($arrSetting);

                if($lastValue > 0) {
                    $lastValue = $lastValue - 1;
                }

                if(isset($arrSetting[$lastValue])) {
                    $arrSetting[$lastValue]['freshman'] = $arrSetting[$lastValue]['freshman'].' ,'.$value;
                }
            }
        }
    }

    return $arrSetting;
}