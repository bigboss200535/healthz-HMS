<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Facility;

class ExternalCallController extends Controller
{
    /**
     * Check claims code by making an API request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

     public function request_ccc(Request $request)
    {
        // API URL and authentication details
        $apiUrl = Http::get("https://elig.nhia.gov.gh:5000/api/hmis/genCCC");
        $apiKey = //"hp6658"; // API Key
        $secret = //"ncgxs3"; // Secret
        // Get the CardType and CardNo from the request (assuming form data is posted)
        $cardType = $request->input('cardType');
        $cardNo = $request->input('cardNo');
        // Prepare the form data
        $formData = [
            'CardType' => $cardType,
            'CardNo' => $cardNo
        ];
        // Send the POST request to the API
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-nhia-apikey' => $apiKey,  // API key header
                'x-nhia-apisecret' => $secret, // Secret key header
                'Authorization' => 'Basic ' . base64_encode("$apiKey:$secret") // Optional, if required
            ])->post($apiUrl, $formData);

            // Check if the response is JSON or plain text
            if ($response->header('Content-Type') === 'application/json') 
            {
                $result = $response->json(); // Parse as JSON
            } else 
            {
                $result = $response->body(); // Otherwise get plain text response
            }

            // Return the result to the frontend or view
            return response()->json([
                'success' => true,
                'result' => $result
            ]);

        } catch (\Exception $e) {
            // Handle errors and return the error message
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    
    public function claims_check_code(Request $request)
    {
        // Fetch facility data from the database
        $facility = Facility::where('archived', 'No')
            ->where('status', 'Active')
            ->select('ccc_type', 'nhia_url', 'nhia_key', 'nhia_secret')
            ->first();

        // Early return if no valid facility data is found
        if (!$facility) {
            return $this->errorResponse('No active facility data found.', 404);
        }

        // Validate the incoming request data
        $validated = $request->validate([
            'card_type' => 'required|string',
            'member_no' => 'required|string',
        ]);

        // Construct the full API URL
        $apiUrl = 'https://elig.nhia.gov.gh:5000//api/hmis/genCC';

        // Check if the API is reachable before proceeding
        if (!$this->isApiReachable($apiUrl)) {
            return $this->errorResponse('The API URL is not reachable. Please check the URL or the server.', 503);
        }

        // Prepare form data for the POST request
        $formData = [
            'CardType' => $validated['card_type'],
            'CardNo'   => $validated['member_no'],
        ];

        // Process the API call based on the CCC type
        if ($facility->ccc_type === 'Automatic') {
            return $this->sendApiRequest($apiUrl, $formData, $facility);
        } elseif ($facility->ccc_type === 'Manual') {
            // Handle manual CCC type logic here if needed
            return $this->errorResponse('Manual CCC type is not yet implemented.', 501);
        }

        return $this->errorResponse('Invalid CCC type configuration.', 400);
    }

    /**
     * Check if the API URL is reachable.
     *
     * @param string $url
     * @return bool
     */
    private function isApiReachable(string $url): bool
    {
        try {
            $response = Http::timeout(10)->get($url);
            return $response->successful();
        } catch (\Exception $e) {
            Log::error('API Reachability Check Failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send an API request with the provided data.
     *
     * @param string $url
     * @param array $formData
     * @param object $facility
     * @return \Illuminate\Http\JsonResponse
     */
    private function sendApiRequest(string $url, array $formData, $facility)
    {
        try {
            $response = Http::withHeaders([
                'Content-Type'     => 'application/json',
                'x-nhia-apikey'    => $facility->nhia_key,
                'x-nhia-apisecret' => $facility->nhia_secret,
                'Authorization'    => 'Basic ' . base64_encode("{$facility->nhia_key}:{$facility->nhia_secret}"),
            ])->post($url, $formData);

            // Handle response based on content type
            if ($response->successful()) {
                $contentType = $response->header('Content-Type');
                if (str_contains($contentType, 'application/json')) {
                    return response()->json([
                        'success' => true,
                        'result'  => $response->json(),
                    ]);
                } else {
                    return $this->errorResponse('Unexpected content type returned by the API.', 500);
                }
            }

            return $this->errorResponse('API returned an error: ' . $response->status(), $response->status());
        } catch (\Exception $e) {
            Log::error('API Request Failed: ' . $e->getMessage());
            return $this->errorResponse('Error during API call: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Return a standardized error response.
     *
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    private function errorResponse(string $message, int $status = 500)
    {
        return response()->json([
            'success' => false,
            'error'   => $message,
        ], $status);
    }
}