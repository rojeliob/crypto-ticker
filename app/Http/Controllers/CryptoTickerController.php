<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class CryptoTickerController extends Controller
{
    public function index()
    {

        try {
            $data = $this->getCryptos();

            if (isset($data['data'])) {
                $cryptos = $data['data'];

                return view('crypto-ticker')->with('cryptos', $cryptos);
            } else {
                return response()->json(['error' => 'No data found']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getCryptos()
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.coincap.io/v2/assets', [
            'query' => [
                'limit' => 10,
                'sort' => 'percentChange24hr',
                'direction' => 'desc',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
