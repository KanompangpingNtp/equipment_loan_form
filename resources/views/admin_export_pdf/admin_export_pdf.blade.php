<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PDF</title>
    <style>
        @font-face {
            font-family: 'sarabun';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'sarabun';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'sarabun';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'sarabun';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        /* body {
            font-family: 'sarabun', sans-serif;
            font-size: 15px;
        } */
        body {
            font-family: 'sarabun', sans-serif;
            font-size: 18px;
            margin-left: 40px;
            margin-right: 40px;
            line-height: 8px;
        }

        h3 {
            text-align: center;
            margin-top: 20;
        }

        .right {
            text-align: right;
        }

        .underline {
            text-decoration: underline;
            display: inline-block;
            width: auto;
        }

        .content-section {
            margin-bottom: 20px;
        }

        .content-section p {
            line-height: 2;
            margin: 0;
        }

        .signature-section {
            margin-top: 30px;
        }

        .signature-line {
            display: inline-block;
            width: 300px;
            border-bottom: 1px solid #000;
            margin-top: 20px;
        }

        .note {
            margin-top: 50px;
        }

        .note p {
            margin: 5px 0;
        }

        .officer-note {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .officer-note-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 12px;
        }

        .dotted-line {
            border-bottom: 1px dotted #000;
            width: 100%;
            height: 20px;
            margin-bottom: 5px;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
        }

        .column {
            width: 48%;
        }

        .column p {
            margin: 10px 0;
        }

        span.fullname {
            border-bottom: 1px dashed;
            padding-left: 20px;
            padding-right: 100px;
            color: blue;
        }

        span.fullname_2 {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }

        span.age {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }

        span.occupation {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 100px;
            color: blue;
        }

        span.house_no {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 20px;
            color: blue;
        }

        span.village_no {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 20px;
            color: blue;
        }

        span.alley {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 40px;
            color: blue;
        }

        span.road {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }

        span.sub_district {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }

        span.district {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }

        span.province {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }

        span.phone {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }

        span.submission {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 100px;
            color: blue;
            overflow-wrap: break-word;
        }

        span.document_count {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }

        span.location {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 20px;
            color: blue;
        }

        span.day {
            border-bottom: 1px dashed;
            padding-left: 5px;
            padding-right: 5px;
            color: blue;
        }

        span.month {
            border-bottom: 1px dashed;
            padding-left: 5px;
            padding-right: 5px;
            color: blue;
        }

        span.year {
            border-bottom: 1px dashed;
            padding-left: 5px;
            padding-right: 5px;
            color: blue;
        }

        span.submission_name {
            border-bottom: 1px dashed;
            padding-left: 5px;
            padding-right: 5px;
            color: blue;
        }

        span.item {
            border-bottom: 1px dashed;
            padding-left: 20px;
            padding-right: 50px;
            color: blue;
        }

    </style>
</head>
<body>

    @php
    use Carbon\Carbon;

    $thaiMonths = [
    'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
    'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
    ];
    $date = Carbon::parse($form->created_at);
    $day = $date->format('d');
    $month = $thaiMonths[$date->month - 1];
    $year = $date->year + 543; // เพิ่ม 543 เพื่อให้เป็นปี พ.ศ.
    @endphp

    @php
    // แปลง start_date เป็นวัน เดือน ปี ภาษาไทย
    $startDate = Carbon::parse($form->start_date);
    $startDay = $startDate->format('d');
    $startMonth = $thaiMonths[$startDate->month - 1];
    $startYear = $startDate->year + 543;
    @endphp

    @php

    // แปลง end_date เป็นวัน เดือน ปี ภาษาไทย
    $endDate = Carbon::parse($form->end_date);
    $endDay = $endDate->format('d');
    $endMonth = $thaiMonths[$endDate->month - 1];
    $endYear = $endDate->year + 543;
    @endphp


    <div class="container">
        <h3>ใบยืมพัสดุ/ครุภัณฑ์ </h3>

        <p class="right">เขียนที่ องค์การบริหารส่วนตำบลทับพริก</p>
        <p class="right">วันที่<span class="day">{{ $day }}</span>เดือน<span class="month">{{ $month }}</span>พ.ศ.<span class="year"> {{ $year }}</span></p>

        <p style="margin-left: 55px;">ข้าพเจ้า <span class="fullname">{{ $form->guest_salutation }}{{ $form->guest_name }}</span> อายุ <span class="age">{{ $form->guest_age }}</span>ปี อาชีพ<span class="occupation">{{ $form->guest_occupation }}</span> </p>
        <p>อยู่บ้านเลขที่<span class="house_no">{{ $form->guest_house_number}}</span> หมู่ที่<span class="village_no">{{ $form->guest_village }}</span>ตำบล<span class="sub_district">{{ $form->guest_subdistrict }}</span>อำเภอ<span class="district">{{ $form->guest_district }}</span>จังหวัด<span class="province">{{ $form->guest_province }}</span></p>

        <p>หมายเลขโทรศัพท์ที่สามารถติดต่อได้สะดวก (ที่ทำงาน/มือถือ)<span class="phone">{{ $form->guest_phone }}</span></p>
        <p>มีความประสงค์จะขอยืมพัสดุ/ครุภัณฑ์ขององค์การบริหารส่วนตำบลทับพริก เพื่อ <span class="submission">{{ $form->request_details }}</span></p>
        {{-- <p>ในระหว่างวันที่ {{ $startMonth }} {{ $startYear }} ถึงวันที่{{ $endDay }} {{ $endMonth }} {{ $endYear }} รายการดังนี้ </p> --}}
        <p>ในระหว่างวันที่ <span class="day">{{ $startDay }}</span>เดือน<span class="month">{{ $startMonth }}</span>พ.ศ.<span class="year">{{ $startYear }}</span>ถึงวันที่<span class="day">{{ $endDay  }}</span>เดือน<span class="month">{{ $endMonth }}</span>พ.ศ.<span class="year">{{ $endYear  }}</span>รายการดังนี้</p>

        @foreach ($form->items as $item)
        <p style="margin-left: 80px;">{{ $loop->iteration }}. <span class="item"> {{ $item->item_name }} </span></p>
        @endforeach

        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <!-- คอลัมน์ซ้าย -->
                <td style="width: 50%; vertical-align: top;">
                    <p>เรียน นายก</p>
                    <p>-เห็นควรพิจารณาอนุมัติให้ยืมพัสดุ/ครุภัณฑ์</p>
                    <p style="margin-left: 56px;">ตามรายการดังกล่าวข้างต้นนั้น</p>
                    <p>ลงชื่อ...............................................................เจ้าหน้าที่พัสดุ</p>
                    <p style="margin-left: 45px;">(....................................................)</p>
                    <br>
                    <p>(ลงชื่อ) ..........................................ปลัดอบต.</p>
                    <p style="margin-left: 45px;">(นางภัทรวดี ธนะโรจชูเดช) </p>
                    <p style="margin-left: 20px;">ปลัดองค์การบริหารส่วนตำบลทับพริก</p>
                </td>

                <!-- คอลัมน์ขวา -->
                <td style="width: 50%; vertical-align: top; text-align: center;">
                    <p>ลงชื่อ <span class="fullname_2">{{ $form->guest_name }}</span>ผู้ยืม</p>
                    <p>( <span class="fullname_2">{{ $form->guest_salutation }}{{ $form->guest_name }}</span> )</p>
                    <br>
                    <p>จ.อ. .........................................หัวหน้าเจ้าหน้าที่พัสด</p>
                    <p> (ธเนษฐ ธนะโรจนชูเดช) </p>
                    <p>นักจัดการงานทั่วไปชำนาญการ รักษาราชการแทน </p>
                    <p> ผู้อำนวยการกองคลัง </p>
                    <br>
                    <p> (ลงชื่อ) .........................................นายก </p>
                    <p> (นางรัตนากร พุฒเส็ง) </p>
                    <p>นายกองค์การบริหารส่วนตำบลทับพริก </p>
                </td>
            </tr>
        </table>

        <br>
        <div style="margin-left: 50px">
            <p style="margin-left: 55px;">ตามรายการที่ยืมนี้ ข้าพเจ้าจะดูแลรักษาอย่างดี หากชำรุดเสียหาย ทำให้พัสดุ/ครุภัณฑ์ ดังกล่าวอยู่ </p>
            <p>สภาพที่ยืมไปหรือพัสดุ/ครุภัณฑ์ ดังกล่าวสูญหายไป ข้าพเจ้าขอรับผิดชอบโดยไม่มีเงื่อนไขใดๆ ทั้งสิ้น ทั้งนี้</p>
            <p>เมื่อได้ส่งของคืนเมื่อวันที่ .............. เดือน ................... พ.ศ ................</p>
        </div>

        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <!-- คอลัมน์ซ้าย -->
                <td style="width: 50%; vertical-align: top;">
                </td>

                <!-- คอลัมน์ขวา -->
                <td style="width: 50%; vertical-align: top; text-align: center;">
                    <p>(ลงชื่อ) ............................ ผู้ส่งของคืน </p>
                    <p>(.........................................)</p>
                    <p>(ลงชื่อ) ............................ ผู้รับของคืน (จนท.อบต.) </p>
                    <p>(.........................................)</p>
                </td>
            </tr>
        </table>





    </div>
</body>
</html>
