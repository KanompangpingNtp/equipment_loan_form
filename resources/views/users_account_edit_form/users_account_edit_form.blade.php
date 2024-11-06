@extends('layout.users_account_layout')
@section('account_layout')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif

<div class="container">
    <a href="{{ route('userRecordForm')}}">กลับหน้าเดิม</a><br><br>
    <h2>แก้ไขข้อมูลการยืมพัสดุ/ครุภัณฑ์</h2><br>

    <form action="{{ route('updateUserForm', $form->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="mb-3 col-md-2">
                <label for="request_date" class="form-label">วันที่กรอกแบบฟอร์ม</label>
                <input type="date" class="form-control" id="request_date" name="request_date" value="{{ $form->request_date }}" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-2">
                <label for="guest_salutation" class="form-label">คำนำหน้า</label>
                <input type="text" class="form-control" id="guest_salutation" name="guest_salutation" value="{{ $form->guest_salutation }}" required>
            </div>

            <div class="mb-3 col-md-4">
                <label for="guest_name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" id="guest_name" name="guest_name" value="{{ $form->guest_name }}" required>
            </div>

            <div class="mb-3 col-md-1">
                <label for="guest_age" class="form-label">อายุ</label>
                <input type="number" class="form-control" id="guest_age" name="guest_age" value="{{ $form->guest_age }}" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_occupation" class="form-label">อาชีพ</label>
                <input type="text" class="form-control" id="guest_occupation" name="guest_occupation" value="{{ $form->guest_occupation }}" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-3">
                <label for="guest_phone" class="form-label">เบอร์ติดต่อ</label>
                <input type="text" class="form-control" id="guest_phone" name="guest_phone" value="{{ $form->guest_phone }}" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_house_number" class="form-label">บ้านเลขที่</label>
                <input type="text" class="form-control" id="guest_house_number" name="guest_house_number" value="{{ $form->guest_house_number }}" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" id="guest_village" name="guest_village" value="{{ $form->guest_village }}" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_subdistrict" class="form-label">ตำบล</label>
                <input type="text" class="form-control" id="guest_subdistrict" name="guest_subdistrict" value="{{ $form->guest_subdistrict }}" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="guest_district" name="guest_district" value="{{ $form->guest_district }}" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="guest_province" name="guest_province" value="{{ $form->guest_province }}" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-7">
                <label for="request_details" class="form-label">รายละเอียดการขอยืม</label>
                <textarea class="form-control" id="request_details" name="request_details" rows="3" required>{{ $form->request_details }}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-2">
                <label for="start_date" class="form-label">วันที่เริ่ม</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $form->start_date }}" required>
            </div>

            <div class="mb-3 col-md-2">
                <label for="end_date" class="form-label">วันที่สิ้นสุด</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $form->end_date }}" required>
            </div>
        </div>

        <style>
            .custom-input-width {
                width: 80%;
                /* กำหนดความกว้างตามที่ต้องการ เช่น 80% */
                max-width: 500px;
                /* กำหนดขนาดสูงสุดเพื่อให้แน่ใจว่า input ไม่ยาวเกินไป */
            }

        </style>

        <div id="item-container">
            <small>กรุณากรอกชื่อรายการของที่ยืม</small>
            <button type="button" class="btn btn-secondary btn-sm mb-2" id="add-item">เพิ่มรายการ</button>
            @foreach ($form->items as $item)
            <input type="text" class="form-control mb-3 custom-input-width" name="item_name[]" value="{{ $item->item_name }}" placeholder="รายการของที่ยืม">
            @endforeach
        </div>

        {{-- <div id="item-container">
            <small>กรุณากรอกชื่อรายการของที่ยืม</small>
            <button type="button" class="btn btn-secondary btn-sm mb-2" id="add-item">เพิ่มรายการ</button>
            @foreach ($form->items as $item)
            <input type="text" class="form-control mb-3 col-md-5" name="item_name[]" value="{{ $item->item_name }}" placeholder="รายการของที่ยืม">
        @endforeach
</div> --}}



<button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
</form>
</div>

<script>
    document.getElementById('add-item').addEventListener('click', function() {
        const itemContainer = document.getElementById('item-container');
        const newItemInput = document.createElement('input');
        newItemInput.type = 'text';
        newItemInput.className = 'form-control mb-3 col-md-5';
        newItemInput.name = 'item_name[]';
        newItemInput.placeholder = 'รายการของที่ยืม';
        itemContainer.appendChild(newItemInput);
    });

</script>


@endsection
