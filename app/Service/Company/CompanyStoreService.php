<?php

namespace App\Service\Company;

use App\Data\Company\StoreCompanyData;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CompanyStoreService
{
    public function __construct(
        private Hash $hash
    ){}
    
    
    public function handle(StoreCompanyData $companyData): bool
    {
        $company = new Company();
        $company->name = $companyData->name;
        $company->email = $companyData->email;
        $company->logo = $companyData->logo;
        $company->password = $this->hash::make($companyData->password);
        
        try{
            return $company->save();
        }catch(\Exception $e){
            Log::error('CompanyStoreService', [ 'error' => $e->getMessage()]);
            return false;
        }

        
    }

    
}
