<?php

class TempEau
{
    public function getCodeStation(): array
    {
        $curl = curl_init('https://hubeau.eaufrance.fr/api/v1/temperature/station?code_departement=33&pretty');


        curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $data_stations = curl_exec($curl);

        if ($data_stations === false) {

            var_dump(curl_error($curl));
        }
        $results = [];
        $data_stations = json_decode($data_stations, true);
        foreach ($data_stations['data'] as $code_station) {
            $results[] = ['code_station' => $code_station['code_station']];
        }
        return $results;
    }

    public function getMultipleTemp($data_station, $nbr): array
    {
        $curl = curl_init("https://hubeau.eaufrance.fr/api/v1/temperature/chronique?code_station={$data_station}&size={$nbr}&sort=desc&pretty");
        curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data_temp =
            curl_exec($curl);
        if ($data_temp === false) {

            var_dump(curl_error($curl));
        }

        $data_temp = json_decode($data_temp, true);
        $result = [];
        foreach ($data_temp['data'] as $temp) {
            $result[] = [
                'date_mesure_temp' => $temp['date_mesure_temp'],
                'libelle_station' => $temp['libelle_station'],
                'resultat' => $temp['resultat'],
                "heure_mesure_temp" => $temp['heure_mesure_temp']

            ];
        }
        return $result;
    }

    public function getOneTemp($data_station): array
    {
        $curl = curl_init("https://hubeau.eaufrance.fr/api/v1/temperature/chronique?code_station={$data_station}&size=1&sort=desc&pretty");
        curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data_temp =
            curl_exec($curl);
        if ($data_temp === false) {

            var_dump(curl_error($curl));
        }

        $data_temp = json_decode($data_temp, true);
        $result = [];
        foreach ($data_temp['data'] as $temp) {
            $result[] = [
                'date_mesure_temp' => $temp['date_mesure_temp'],
                'libelle_station' => $temp['libelle_station'],
                'resultat' => $temp['resultat'],
                "heure_mesure_temp" => $temp['heure_mesure_temp']

            ];
        }
        return $result;
    }
}
