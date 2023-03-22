<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\CautionWeapon;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cautionWeapon = CautionWeapon::where('caution_id', 59)
            ->where('weapon_description', 'PISTOLA TAURUS PT 640')
            ->where('weapon_number', 'SDY03145')
            ->first();
        $cautionWeapon->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $cautionWeapon = new CautionWeapon();
        $cautionWeapon->caution_id = 59;
        $cautionWeapon->entranced_at = '2023-02-14 11:45:00';
        $cautionWeapon->exited_at = '2023-02-14 17:19:00';
        $cautionWeapon->register_number = '';
        $cautionWeapon->weapon_type_id = 1;
        $cautionWeapon->weapon_description = 'PISTOLA TAURUS PT 640';
        $cautionWeapon->weapon_number = 'SDY03145';
        $cautionWeapon->cabinet_id = 1;
        $cautionWeapon->shelf_id = 1;
        $cautionWeapon->save();
    }
};
