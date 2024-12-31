<?php

namespace App\Traits;

trait ResetsFields
{
    public function resetInputFields()
    {
        $this->userId = $this->name = $this->email = $this->password = $this->phone = $this->gender = null;
        $this->age = $this->blood_group = $this->designation = $this->qualification = null;
        $this->salary_type = $this->salary = $this->opening_balance = null;
        $this->address = $this->ending_date = $this->description = null;
        $this->photo = $this->id_card = $this->resume = null;
        $this->status = true;
        $this->branch_id = $this->role_id = null;
    }
}
