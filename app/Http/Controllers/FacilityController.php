<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\HealthFacilityLevels;


class FacilityController extends Controller
{
    public function index()
    {
        $facility = Facility::where('archived', 'No')->get();
        $facility_type = HealthFacilityLevels::where('archived', 'No')->get();
        $facility_details=Facility::where('archived', 'No')->first();

        return view('facility.index', compact('facility', 'facility_type', 'facility_details'));
    }
    public function create()
    {

    }
    
    public function store()
    {

    }

    public function edit()
    {


    }

    public function update()
    {

    }

    public function destroy()
    {
        
    }

    public function sms_api()
    {
        if($sms_api_type=='mnotify')
            {
                // mnotify sms access point
                $endPoint = 'https://api.mnotify.com/api/sms/quick';
                $apiKey = 'YOUR_API_KEY';
                $url = $endPoint . '?key=' . $apiKey;

                $data = [
                'recipient' => ['0241234567', '0201234567'],
                'sender' => 'mNotify',
                'message' => 'API messaging is fun!',
                'is_schedule' => false,
                'schedule_date' => '', // YYYY-MM-DD hh:mm
                // uncomment the below line to send OTP sms
                // When sms_type: "otp" is included in your payload, a charge of 0.035 per campaign will be deducted from your main wallet.
                // 'sms_type': 'otp' please do not include in payload when the purpose of the blast is not for otp
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                $result = curl_exec($ch);
                $result = json_decode($result, TRUE);
                curl_close($ch);
            }

            if($sms_api_type=='nalo')
            {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://sms.nalosolutions.com/smsbackend/clientapi/Resl_Nalo/send-message/?username=johndoe&password=some_password&type=0&destination=233XXXXXXXXX&dlr=1&source=NALO&message=This+is+a+test+from+Mars',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;

            }
        }
}
