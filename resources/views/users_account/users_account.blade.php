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
    <h3 class="text-center">กรอกรายละเอียดการยืม</h3> <br>
    <form action="{{ route('FormCreate') }}" method="POST">
        @csrf
        <div class="mb-3 col-md-2">
            <label for="request_date" class="form-label">วันที่กรอกแบบฟอร์ม</label>
            <input type="date" class="form-control" id="request_date" name="request_date" required>
        </div>

        <div class="row">

            <div class="mb-3 col-md-2">
                <label for="guest_salutation" class="form-label">คำนำหน้า</label>
                <select class="form-select" id="guest_salutation" name="guest_salutation" required>
                    <option value="" disabled {{ $user->userDetails->salutation ? '' : 'selected' }}>เลือกคำนำหน้า</option>
                    <option value="นาย" {{ $user->userDetails->salutation == 'นาย' ? 'selected' : '' }}>นาย</option>
                    <option value="นาง" {{ $user->userDetails->salutation == 'นาง' ? 'selected' : '' }}>นาง</option>
                    <option value="นางสาว" {{ $user->userDetails->salutation == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                </select>
            </div>

            <div class="mb-3 col-md-4">
                <label for="guest_name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" id="guest_name" name="guest_name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3 col-md-1">
                <label for="guest_age" class="form-label">อายุ</label>
                <input type="number" class="form-control" id="guest_age" name="guest_age" value="{{ $user->userDetails->age }}" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_occupation" class="form-label">อาชีพ</label>
                <input type="text" class="form-control" id="guest_occupation" name="guest_occupation" value="{{ $user->userDetails->occupation }}">
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-3">
                <label for="guest_house_number" class="form-label">บ้านเลขที่</label>
                <input type="text" class="form-control" id="guest_house_number" name="guest_house_number" value="{{ $user->userDetails->house_number }}">
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" id="guest_village" name="guest_village" value="{{ $user->userDetails->village }}">
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_subdistrict" class="form-label">ตำบล</label>
                <input type="text" class="form-control" id="guest_subdistrict" name="guest_subdistrict" value="{{ $user->userDetails->subdistrict }}">
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="guest_district" name="guest_district" value="{{ $user->userDetails->district }}">
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="guest_province" name="guest_province" value="{{ $user->userDetails->province }}">
            </div>

            <div class="mb-3 col-md-3">
                <label for="guest_phone" class="form-label">เบอร์มือถือ</label>
                <input type="text" class="form-control" id="guest_phone" name="guest_phone" value="{{ $user->userDetails->phone }}" required>
            </div>
        </div>

        <div class="mb-3 col-md-7">
            <label for="request_details" class="form-label">รายละเอียดการขอยืม</label>
            <textarea class="form-control" id="request_details" name="request_details" rows="3" required></textarea>
        </div>

        <div class="row">
            <div class="mb-3 col-md-2">
                <label for="start_date" class="form-label">วันที่เริ่ม</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <div class="mb-3 col-md-2">
                <label for="end_date" class="form-label">วันที่สิ้นสุด</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
        </div>

        <div class="mb-3 col-md-5">
            <label for="item_name" class="form-label">รายการของที่ยืม</label>
            <div id="item-container">
                <!-- ฟิลด์ input ที่เพิ่มขึ้นแบบไดนามิกจะถูกแทรกที่นี่ -->
            </div>
            <small>กรุณากรอกชื่อรายการของที่ยืม</small>
            <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-item">เพิ่มรายการ</button>
        </div>

        <div id="item-container" class="col-md-5"></div>

        <button type="submit" class="btn btn-primary">ส่งคำขอยืม</button>
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
