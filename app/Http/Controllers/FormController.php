<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use App\Models\FormItem;

class FormController extends Controller
{
    //
    public function FormIndex()
    {
        return view('users_form.users_form'); // เปลี่ยนเป็นชื่อไฟล์ Blade ที่คุณสร้าง
    }

    public function FormCreate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'request_date' => 'required|date',
            'request_details' => 'required|string',
            'guest_name' => 'required|string',
            'guest_age' => 'required|integer',
            'guest_phone' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'item_name' => 'required|array', // เพิ่มการตรวจสอบสำหรับ item_name
            'item_name.*' => 'required|string', // ตรวจสอบว่าแต่ละรายการมีค่า
        ]);

        // Create a new form record
        $form = Form::create([
            'user_id' => Auth::id(), // บันทึก ID ของผู้ใช้ที่ลงชื่อเข้าใช้
            'request_date' => $request->request_date,
            'request_details' => $request->request_details,
            'status' => 1, // หรือค่าเริ่มต้นอื่นๆ ตามที่คุณต้องการ
            'guest_salutation' => $request->guest_salutation,
            'guest_name' => $request->guest_name,
            'guest_age' => $request->guest_age,
            'guest_occupation' => $request->guest_occupation,
            'guest_phone' => $request->guest_phone,
            'guest_house_number' => $request->guest_house_number,
            'guest_village' => $request->guest_village,
            'guest_subdistrict' => $request->guest_subdistrict,
            'guest_district' => $request->guest_district,
            'guest_province' => $request->guest_province,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Loop through item names and save them
        foreach ($request->item_name as $itemName) {
            FormItem::create([
                'form_id' => $form->id,
                'item_name' => $itemName,
            ]);
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว!');
    }
}
