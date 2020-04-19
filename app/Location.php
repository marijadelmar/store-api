<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [ 'address', 'address number', 'entry'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getCompany()
    {
        return $this->company()->get();
    }

    public function setCompany(Company $company)
    {
        $this->company()->associate($company);
    }

    public function getAddress() : string
    {
        return $this->getAttribute('address');
    }

    public function setAddress(string $address)
    {
        $this->setAttribute('address',$address);
    }

    public function getAddressNumber() : string
    {
        return $this->getAttribute('address number');
    }

    public function setAddressNumber(string $addressNumber)
    {
        $this->setAttribute('address number',$addressNumber);
    }

    public function getEntry() : string
    {
        return $this->getAttribute('entry');
    }

    public function setEntry(string $entry)
    {
        $this->setAttribute('entry', $entry);
    }







}
