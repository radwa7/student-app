
public static function parse($phone)
    {
        // $mobile = $phone['phone'];
        // $code = '+20';
        // $country = 'Egypt';
        // $full = [
        //     'code'    => $code,
        //     'phone'   => $mobile,
        //     'country' => $country
        // ];
        // return $full;

        $mobile = $phone['phone'];
        $char = ['*', '-', '\\', '\'', '"', '.', '=', '␉', '_', '/', '☆'];
        $number = str_replace($char, "", $mobile);
        $number = trim($number, " ");
        $number = preg_replace('/\s+/', '', $number);

        $persian = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $num = range(0, 9);
        $number = str_replace($persian, $num, $number);
        $number = preg_replace("/[^+0-9]/", "", $number);


        if (!empty($phone['code'])) {
            $key = substr($number, 0, 1);
            $phone['phone'] = $number;
            if ($key != 0) {
                $phone['phone'] = '0' . $number;
            }
            return $phone;
        }

        $key = substr($number, 0, 2);
        if ($key == "00") {
            $number = substr($number, 2);
            $number = "+" . $number;
        }

        try {

            $number = self::checkcounteryNumber($key, $number, $phone['is_primary'] ?? null);

            if (!is_array($number)) {
                $number = PhoneNumber::parse($number);
                $code = (string) $number->getCountryCode();
                $mobileNu = $number->format(PhoneNumberFormat::NATIONAL);
                $mobileNu = str_replace(" ", "", $mobileNu);
                $mobileNu = preg_replace("/[^+0-9]/", "", $mobileNu);
                $fkey = substr($mobileNu, 0, 1);
                if ($fkey != 0) {
                    $mobileNu = (string) '0' . $mobileNu;
                }

                if (!empty($code) && substr($code, 0, 1) != '+') {
                    $code = "+" . $code;
                }
            }

            $phone['phone'] = $mobileNu ?? $number['phone'];
            $phone['code'] = $code ?? $number['code'];
            $phone['country'] =LaravelPhonePhoneNumber::make($phone['phone'], $phone['code'])->getCountry(); ;
            return $phone;
        } catch (PhoneNumberParseException $e) {
            try {

                $number = self::checkcounteryNumber($key, $number, $phone['is_primary'] ?? null);

                if (!is_array($number)) {
                    $number = PhoneNumber::parse("+" . $number);
                    $code = $number->getCountryCode();
                    $mobileNu = $number->format(PhoneNumberFormat::NATIONAL);
                    $mobileNu = str_replace(" ", "", $mobileNu);

                    $mobileNu = preg_replace("/[^+0-9]/", "", $mobileNu);
                    $fkey = substr($mobileNu, 0, 1);
                    if ($fkey != 0) {
                        $mobileNu = '0' . $mobileNu;
                    }

                    if (!empty($code) && substr($code, 0, 1) != '+') {
                        $code = "+" . $code;
                    }
                }

                $phone['phone'] = $mobileNu ?? $number['phone'];
                $phone['code'] = $code ?? $number['code'];

                return $phone;
            } catch (PhoneNumberParseException $e) {

            }
        }

        $phone['code'] = '';
        $phone['phone'] = $number;

        return $phone;
    }

    public static function arabicToEnglish(string $number): string
    {
        $persian = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $num = range(0, 9);
        $number = str_replace($persian, $num, $number);
        $number = preg_replace("/[^+0-9]/", "", $number);

        return $number;
    }

    private static function checkcounteryNumber($key, $phone, $is_primary = null)
    {
        if (in_array($key, [10, 11, 12, 15]) && strlen($phone) == 10) {
            $phone = [
                'code' => '+20',
                'nationalNumber' => $phone,
                'phone' => '0' . $phone,
                'countery_code' => 'EGY',
                'is_primary' => $is_primary
            ];
        }
        //  elseif (in_array($key, [966])) {
        //     $phone = [
        //         'code' => '+966',
        //         'nationalNumber' => $phone,
        //         'phone' => $phone,
        //         'counteryCode' => 'SA',
        //         'is_primary' => $is_primary
        //     ];
        // }
        return $phone;
    }

    public function validateMobile($mobile)
    {
        if (empty($mobile['mobile']["phone"])) {
            throw new HttpResponseException($this->response,'mobile is empty', 422);
        }
        $specialChars = ['*', '-', '\\', '\'', '"', '.', '=', '␉', '_', '/', '☆'];
        $number = str_replace($specialChars, "", $mobile['mobile']["phone"]);
        $number = trim($number, " ");

        $number = $this->formatNumber($number);

        if (empty($number) || !intval($number)) {
            throw new HttpResponseException($this->response,'invalid number', 422);
        }
        return $number;
    }

    protected function formatNumber($number)
    {
        //removespace
        $number = preg_replace('/\s+/', '', $number);

        $persian = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $num = range(0, 9);
        $number = str_replace($persian, $num, $number);

        $number = preg_replace("/[^+0-9]/", "", $number);

        $key = substr($number, 0, 1);
        if ($key == '+') {
            $number = substr($number, 1);
            $number = "00" . $number;
        }

        $number = preg_replace("/[^0-9]/", "", $number);

        $number = ltrim($number, '0');

        $key = substr($number, 0, 1);
        if ($key == 1) {
            $number = "0" . $number;
        } elseif ($key != 2 && strlen($number) > 11) {
            $number = "00" . $number;
        }

        $key = substr($number, 0, 3);
        if ($key == '201' || $key == '200') {
            $number = substr($number, 1);
        }

        $key = substr($number, 0, 1);
        if ($key != 0) {
            $number = '0' . $number;
        }
        return $number;
    }

    public function mergeMobilePhones($leadData)
    {
        $mobile     = $leadData['mobile'];
        $otherPhone = $leadData['other_phone']??[];

        $mobile['is_primary'] = true;
        $phones[] = $mobile;

        foreach ($otherPhone as $phone) {
            if (empty($phone['phone'])) {
                continue;
            }

            $phone['is_primary'] = false;
            $phones[]            = $phone;
        }
        return $phones;
    }

    public function checkNumberValidation($mobile)
    {
        if (!isset($mobile['phone'])) {
            return ['status' => false];
        }

        $CodeAndphone = $mobile['code'] . $mobile['phone'];
        $CodeAndphone = PhoneParser::arabicToEnglish($CodeAndphone);
        $checkPlus    =  substr($CodeAndphone, 0, 1);

        if ($checkPlus != '+' && in_array(substr($CodeAndphone, 0, 2), ['01', 10, 11, 12, 15])) {
            $removeFirst = substr($CodeAndphone, 0,);
            $mobile = [
                'phone' =>  ltrim($removeFirst, "0")
            ];
            $number = PhoneParser::parse($mobile);
            $CodeAndphone = $number['code'] . $mobile['phone'];
        }
        if ($checkPlus != '+' && !empty($CodeAndphone)) {
            $CodeAndphone = '+' . $CodeAndphone;
        }

        $number = PhoneNumber::parse($CodeAndphone);
        if ($number->isValidNumber() == false) {
            return ['status' => false];
        };
        return ['status' => true];
    }

    public function checkNumbersValidation($mobile)
    {
        $CodeAndphone = $mobile['code'] . $mobile['phone'];
        $CodeAndphone = PhoneParser::arabicToEnglish($CodeAndphone);

        $checkPlus =  substr($CodeAndphone, 0, 1);

        if ($checkPlus != '+' && in_array(substr($CodeAndphone, 0, 2), ['01', 10, 11, 12, 15])) {
            $removeFirst = substr($CodeAndphone, 0,);
            $mobile = [
                'phone' =>  ltrim($removeFirst, "0")
            ];
            $number = PhoneParser::parse($mobile);
            $CodeAndphone = $number['code'] . $mobile['phone'];
        }
        if ($checkPlus != '+' && !empty($CodeAndphone)) {
            $CodeAndphone = '+' . $CodeAndphone;
        }

        $number = PhoneNumber::parse($CodeAndphone);
        if ($number->isValidNumber() == false) {
            return ['status' => false];
        };
        return ['status' => true];
    }

    public static function dialMobile($mobile, $code)
    {

        $dial = '';
        $dial_mobile = '';
        $code_status = ['', '002', '20', '+20', null];
        if (!empty($mobile)) {
            if ($mobile[0] == "0") {
                $dial_mobile = substr_replace($mobile, '', 0, 1);
            }
            if (!empty($code)) {
                if ($code[0] == "+") {
                    $code = substr_replace($code, '', 0, 1);
                }
                if (in_array($code, $code_status)) {
                    $dial = $code . $dial_mobile;
                } else {
                    $dial = $code . $dial_mobile;
                }
            } else {
                $number = $mobile;
                $key = substr($number, 0, 2);
                $dial = $number;
                if ($key == '01') {
                    $dial = "2" . $number;
                }
            }
        }
        return $dial;

    }
