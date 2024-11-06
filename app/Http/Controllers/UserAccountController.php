<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use App\Models\FormItem;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Reply;

class UserAccountController extends Controller
{
    //
    public function userAccountFormsIndex()
    {
        $user = User::with('userDetails')->find(Auth::id());

        return view('users_account.users_account', compact('user'));
    }

    public function userRecordForm()
    {
        $forms = Form::with(['user', 'replies','items'])
            ->where('user_id', Auth::id())
            ->get();

        // ส่งข้อมูลไปยัง view
        return view('users_account_record.users_account_record', compact('forms'));
    }

    public function userShowFormEdit($id)
    {
        $form = Form::with('items')->findOrFail($id); // ดึงข้อมูลฟอร์มและรายการของที่ยืม
        return view('users_account_edit_form.users_account_edit_form', compact('form')); // ส่งข้อมูลไปยัง view
    }

    public function updateUserForm(Request $request, $id)
     {
         $request->validate([
             'request_date' => 'required|date',
             'guest_salutation' => 'required|string|max:255',
             'guest_name' => 'required|string|max:255',
             'guest_age' => 'required|integer',
             'guest_occupation' => 'required|string|max:255',
             'guest_phone' => 'required|string|max:255',
             'guest_house_number' => 'required|string|max:255',
             'guest_village' => 'required|string|max:255',
             'guest_subdistrict' => 'required|string|max:255',
             'guest_district' => 'required|string|max:255',
             'guest_province' => 'required|string|max:255',
             'start_date' => 'required|date',
             'end_date' => 'required|date',
             'item_name' => 'required|array',
             'item_name.*' => 'string|max:255',
         ]);

         $form = Form::findOrFail($id);
         $form->update($request->only([
             'request_date',
             'guest_salutation',
             'guest_name',
             'guest_age',
             'guest_occupation',
             'guest_phone',
             'guest_house_number',
             'guest_village',
             'guest_subdistrict',
             'guest_district',
             'guest_province',
             'start_date',
             'end_date',
         ]));

         // ลบรายการของที่ยืมเก่า
         $form->items()->delete();

         // เพิ่มรายการของที่ยืมใหม่
         foreach ($request->item_name as $itemName) {
             FormItem::create([
                 'form_id' => $form->id,
                 'item_name' => $itemName,
             ]);
         }

        //  return redirect()->route('forms.index')->with('success', 'แก้ไขข้อมูลสำเร็จ');
         return redirect()->back()->with('success', 'แก้ไขข้อมูลสำเร็จ!');
     }

     public function exportUserPDF($id)
     {
         $form = Form::with('items')->find($id); // ดึงข้อมูลฟอร์มพร้อมกับรายการที่ยืม

         // สร้าง instance ของ DomPDF ผ่าน facade Pdf
         $pdf = Pdf::loadView('admin_export_pdf.admin_export_pdf', compact('form'))
                 ->setPaper('A4', 'portrait');

         // ส่งไฟล์ PDF ไปยังเบราว์เซอร์
         return $pdf->stream('ใบยืมพัสดุ_ครุภัณฑ์' . $form->id . '.pdf');
     }

     public function userReply(Request $request, $formId)
     {
         $request->validate([
             'message' => 'required|string|max:1000',
         ]);

         // dd($request);
         // dd(auth()->id());

         Reply::create([
             'form_id' => $formId,
             'user_id' => auth()->id(),
             'reply_text' => $request->message,
         ]);

         return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
     }

}
