<?php
namespace Apsg\MF\Responses\Models;

use Apsg\MF\Responses\Response;
use Carbon\Carbon;

/**
 * @property-read array          authorizedClerks
 * @property-read string|null    regon
 * @property-read Carbon|null    restorationDate "2019-02-21"
 * @property-read string         workingAddress "ul/ Prosta 49 00-838 Warszawa"
 * @property-read bool           hasVirtualAccounts true
 * @property-read string         statusVat "Zwolniony"
 * @property-read string|null    krs "0000636771"
 * @property-read string|null    restorationBasis "Ustawa o podatku od towarów i usług art. 96"
 * @property-read array|string[] accountNumbers "90249000050247256316596736", "90249000050247256316596736" ]
 * @property-read string|null    registrationDenialBasis "Ustawa o podatku od towarów i usług art. 96"
 * @property-read string         nip "1111111111"
 * @property-read string|null    removalDate "2019-02-21"
 * @property-read array          partners" : [ ]
 * @property-read string|null    name "ABC Jan Nowak"
 * @property-read Carbon|null    registrationLegalDate "2018-02-21"
 * @property-read string|null    removalBasis" : "Ustawa o podatku od towarów i usług Art. 97"
 * @property-read string|null    pesel "22222222222"
 * @property-read array          representatives
 * @property-read string|null    companyName "Nazwa firmy"
 * @property-read string|null    residenceAddress "ul/ Chmielna 85/87 00-805 Warszawa"
 * @property-read Carbon|null    registrationDenialDate 2019-02-21
 */
class Subject extends Response
{
    protected array $dates = [
        'restorationDate',
        'removalDate',
        'registrationLegalDate',
        'registrationDenialDate',
    ];

    public function isValid() : bool
    {
        return true;
    }
}
