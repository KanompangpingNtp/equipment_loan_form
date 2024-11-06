<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormItem;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminFormController extends Controller
{
    //
    public function adminshowform()
    {
        // ใช้ eager loading เพื่อโหลด attachments, user และ replies
        $forms = Form::with(['user', 'replies', 'items'])->get();

        // ส่งข้อมูลไปยัง view
        return view('admin_show_form.admin_show_form', compact('forms'));
    }

    public function adminshowformedit($id)
    {
        $form = Form::with('items')->findOrFail($id); // ดึงข้อมูลฟอร์มและรายการของที่ยืม
        return view('admin_edit_form.admin_edit_form', compact('form')); // ส่งข้อมูลไปยัง view
    }

     // ฟังก์ชันสำหรับบันทึกการแก้ไข
     public function adminformupdate(Request $request, $id)
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

    // public function exportPDF($id)
    // {
    //     $form = Form::with('items')->find($id); // ดึงข้อมูลฟอร์มพร้อมกับรายการที่ยืม
    //     if (!$form) {
    //         return redirect()->back()->with('error', 'ไม่พบข้อมูลฟอร์ม');
    //     }

    //     // กำหนด Options สำหรับ Dompdf
    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isRemoteEnabled', true);

    //     // สร้าง instance ของ Dompdf
    //     $dompdf = new Dompdf($options);

    //     // โหลด view ที่ต้องการสร้าง PDF
    //     $html = view('admin_export_pdf.admin_export_pdf', compact('form'))->render();

    //     // โหลด HTML ลงใน Dompdf
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     // ส่งไฟล์ PDF ไปยังเบราว์เซอร์
    //     return $dompdf->stream('แบบคำขอร้องทั่วไป' . $form->id . '.pdf', ['Attachment' => false]);
    // }
    public function exportPDF($id)
    {
        $form = Form::with('items')->find($id); // ดึงข้อมูลฟอร์มพร้อมกับรายการที่ยืม

        // สร้าง instance ของ DomPDF ผ่าน facade Pdf
        $pdf = Pdf::loadView('admin_export_pdf.admin_export_pdf', compact('form'))
                ->setPaper('A4', 'portrait');

        // ส่งไฟล์ PDF ไปยังเบราว์เซอร์
        return $pdf->stream('ใบยืมพัสดุ_ครุภัณฑ์' . $form->id . '.pdf');
    }

    public function adminReply(Request $request, $formId)
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

    public function updateStatus($id)
    {
        $form = Form::findOrFail($id);

        // อัปเดตสถานะ
        $form->status = 2; // หรือค่าที่คุณต้องการ
        $form->admin_name_verifier = Auth::user()->name; // เก็บ fullname ของผู้ล็อกอิน
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}
