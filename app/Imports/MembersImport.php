<?php

namespace App\Imports;

use App\Member;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MembersImport implements ToCollection {
    /**
     * @param array $rows
     *
     * @return array |null
     */
    public function collection(Collection $rows) {

        foreach ($rows as $row) {
            $member = Member::create([
                'first_name' => $row[0],
                'last_name' => $row[1],
                'middle_name' => $row[3],
                'email' => $row[4],
                'gender' => $row[5],
                'occupation' => $row[6],
                'phone_number' => $row[7],
                'community_id' => $row[8],
            ]);

            $address = Address::create([
                'member_id' => $member['id'],
                'street_address' => $row[9],
                'unit_number' => $row[10],
                'city' => $row[11],
                'country' => $row[12],
                'state' => $row[13],
                'postal_code' => $row[14],
            ]);
        }
    }
}
