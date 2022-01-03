<?php

namespace App\Constant;

class UploadPathConstant
{
    const UPLOAD_DIR = 'uploads/';

    //Payment-Accounts
    const PAYMENT_ACCOUNT_IMAGE_LOGO = self::UPLOAD_DIR . "payment-accounts/logo/";
    const PAYMENT_ACCOUNT_IMAGE_QR_CODE = self::UPLOAD_DIR . "payment-accounts/qr_code/";

    //Payment
    const PAYMENT_SLIP = self::UPLOAD_DIR . "payment-slip/";

    //Junks
    const JUNK = self::UPLOAD_DIR . "junks/";

    //Buyers
    const KTP = self::UPLOAD_DIR . "kyc/ktp/";
    const SELFIE_KTP = self::UPLOAD_DIR . "kyc/selfie-ktp/";
}
