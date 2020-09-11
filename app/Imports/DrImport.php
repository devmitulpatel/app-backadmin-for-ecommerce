<?php

namespace App\Imports;

use App\Dr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class DrImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $outData=[];
    public function collection(Collection $collection)
    {
        // TODO: Implement collection() method.
            $this->outData=$collection->toArray();
            return $collection->toArray();
    }

    public function __construct(&$vData){
        $this->outData=&$vData;
    }


}
