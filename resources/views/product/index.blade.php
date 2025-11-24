<h2>Sản Phẩm</h2>
<table border="1" cellspacing="0" cellpadding="8" style="width:100%; margin-bottom:30px;">
    <thead>
        <tr>
            <th>Mã SP</th>
            <th>Tên SP</th>
            <th>Mô Tả</th>
            <th>Giá Bán</th>
            <th>Hình Ảnh</th>
            <th>Mã Kho</th>
            <th>Lỗi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sanphams as $sp)
            @php
                $errors = [];
                if($sp->MaSP <= 0) $errors[] = "Mã sản phẩm không hợp lệ";
                if(trim($sp->TenSP) === '') $errors[] = "Tên sản phẩm không được để trống";
                if($sp->GiaBan <= 0) $errors[] = "Giá bán phải > 0";
                if($sp->MaKho <= 0) $errors[] = "Mã kho không hợp lệ";
            @endphp
            <tr style="{{ count($errors) > 0 ? 'background:#ffcccc;font-weight:bold;' : '' }}">
                <td>{{ $sp->MaSP }}</td>
                <td>{{ $sp->TenSP }}</td>
                <td>{{ $sp->MoTa }}</td>
                <td>{{ $sp->GiaBan }}</td>
                <td>
                    @if($sp->HinhAnh)
                        <img src="{{ $sp->HinhAnh }}" width="120">
                    @endif
                </td>
                <td>{{ $sp->MaKho }}</td>
                <td style="color:red;">{{ implode(', ', $errors) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Khách Hàng</h2>
<table border="1" cellspacing="0" cellpadding="8" style="width:100%; margin-bottom:30px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên KH</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Lỗi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($khachhangs as $kh)
        @php
            $errors = [];
            if($kh->id <= 0) $errors[] = "ID khách hàng không hợp lệ";
            if(trim($kh->tenkh) === '') $errors[] = "Tên khách hàng không được để trống";
            if(trim($kh->email) === '') $errors[] = "Email không hợp lệ";
            if(trim($kh->sdt) === '') $errors[] = "Số điện thoại không hợp lệ";
        @endphp
        <tr style="{{ count($errors) > 0 ? 'background:#ffcccc;font-weight:bold;' : '' }}">
            <td>{{ $kh->id }}</td>
            <td>{{ $kh->tenkh }}</td>
            <td>{{ $kh->email }}</td>
            <td>{{ $kh->sdt }}</td>
            <td style="color:red;">{{ implode(', ', $errors) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h2>Hóa Đơn</h2>
<table border="1" cellspacing="0" cellpadding="8" style="width:100%; margin-bottom:30px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Mã KH</th>
            <th>Ngày Lập</th>
            <th>Tổng Tiền</th>
            <th>Lỗi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($hoadons as $hd)
        @php
            $errors = [];
            if($hd->id <= 0) $errors[] = "ID hóa đơn không hợp lệ";
            if($hd->makh <= 0) $errors[] = "Mã khách hàng không hợp lệ";
            if(trim($hd->ngaylap) === '') $errors[] = "Ngày lập không hợp lệ";
            if($hd->tongtien <= 0) $errors[] = "Tổng tiền phải > 0";
        @endphp
        <tr style="{{ count($errors) > 0 ? 'background:#ffcccc;font-weight:bold;' : '' }}">
            <td>{{ $hd->id }}</td>
            <td>{{ $hd->makh }}</td>
            <td>{{ $hd->ngaylap }}</td>
            <td>{{ $hd->tongtien }}</td>
            <td style="color:red;">{{ implode(', ', $errors) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h2>Kho Hàng</h2>
<table border="1" cellspacing="0" cellpadding="8" style="width:100%; margin-bottom:30px;">
    <thead>
        <tr>
            <th>Mã Kho</th>
            <th>Tên Sản Phẩm</th>
            <th>Mã SP</th>
            <th>Số Lượng</th>
            <th>Lỗi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($khohangs as $kho)
        @php
            $errors = [];
            if($kho->MaKho <= 0) $errors[] = "Mã kho không hợp lệ";
            if(trim($kho->TenSanPham) === '') $errors[] = "Tên sản phẩm không hợp lệ";
            if($kho->MaSanPham <= 0) $errors[] = "Mã sản phẩm không hợp lệ";
            if($kho->SoLuong <= 0) $errors[] = "Số lượng phải > 0";
        @endphp
        <tr style="{{ count($errors) > 0 ? 'background:#ffcccc;font-weight:bold;' : '' }}">
            <td>{{ $kho->MaKho }}</td>
            <td>{{ $kho->TenSanPham }}</td>
            <td>{{ $kho->MaSanPham }}</td>
            <td>{{ $kho->SoLuong }}</td>
            <td style="color:red;">{{ implode(', ', $errors) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h2>Chi Tiết Hóa Đơn</h2>
<table border="1" cellspacing="0" cellpadding="8" style="width:100%; margin-bottom:30px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Mã HĐ</th>
            <th>Tên SP</th>
            <th>Số Lượng</th>
            <th>Đơn Giá</th>
            <th>Lỗi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($chitiethoadons as $cthd)
        @php
            $errors = [];
            if($cthd->id <= 0) $errors[] = "ID chi tiết không hợp lệ";
            if($cthd->mahd <= 0) $errors[] = "Mã hóa đơn không hợp lệ";
            if(trim($cthd->tensp) === '') $errors[] = "Tên sản phẩm không hợp lệ";
            if($cthd->soluong <= 0) $errors[] = "Số lượng phải > 0";
            if($cthd->dongia <= 0) $errors[] = "Đơn giá phải > 0";
        @endphp
        <tr style="{{ count($errors) > 0 ? 'background:#ffcccc;font-weight:bold;' : '' }}">
            <td>{{ $cthd->id }}</td>
            <td>{{ $cthd->mahd }}</td>
            <td>{{ $cthd->tensp }}</td>
            <td>{{ $cthd->soluong }}</td>
            <td>{{ $cthd->dongia }}</td>
            <td style="color:red;">{{ implode(', ', $errors) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h2>Kho Tổng (CSV)</h2>
<table border="1" cellspacing="0" cellpadding="8" style="width:100%;">
    <thead>
        <tr>
            <th>Mã HH</th>
            <th>Tên HH</th>
            <th>Đơn Vị Tính</th>
            <th>Giá Gốc</th>
            <th>Số Lượng Tồn</th>
            <th>Lỗi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
        @php
            $errors = [];
            if(trim($stock['MaHH'] ?? '') === '') $errors[] = "Mã hàng không hợp lệ";
            if(trim($stock['TenHH'] ?? '') === '') $errors[] = "Tên hàng không được để trống";
            if(trim($stock['DonViTinh'] ?? '') === '') $errors[] = "Đơn vị tính không hợp lệ";
            if(floatval($stock['GiaGoc'] ?? 0) <= 0) $errors[] = "Giá gốc phải > 0";
            if(intval($stock['SoLuongTon'] ?? 0) <= 0) $errors[] = "Số lượng tồn phải > 0";
        @endphp
        <tr style="{{ count($errors) > 0 ? 'background:#ffcccc;font-weight:bold;' : '' }}">
            <td>{{ $stock['MaHH'] }}</td>
            <td>{{ $stock['TenHH'] }}</td>
            <td>{{ $stock['DonViTinh'] }}</td>
            <td>{{ $stock['GiaGoc'] }}</td>
            <td>{{ $stock['SoLuongTon'] }}</td>
            <td style="color:red;">{{ implode(', ', $errors) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
