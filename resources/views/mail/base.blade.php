<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject }}</title>
</head>
<body>

@php
   $publiser_name = 'xuongquatanginlogo';
@endphp



<div style="background-color:#ffffff;color:#000000">
    <div style="margin:0px auto;width:600px">
        <div style="padding:30px 20px">
            <table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0"
                   style="margin:0;padding:0;background-color:#ffffff;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px"
                   width="100%">
                <tbody>
                <td>
                    <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#273859">
                        @if($marketing) XIN CHÀO QUÝ KHÁCH HÀNG @else CHI TIẾT KHÁCH HÀNG ĐĂNG KÝ @endif</h2>

                    <table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
                        <thead>
                        <tr>
                            <th align="left" bgcolor="#273859"
                                style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                @if($marketing) Nhà cung cấp @else Khách hàng @endif
                            </th>
                            <th align="left" bgcolor="#273859"
                                style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"></th>
                            <th align="left" bgcolor="#273859"
                                style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"></th>
                            <th align="left" bgcolor="#273859"
                                style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"></th>
                            <th align="right" bgcolor="#273859"
                                style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                Số điện thoại
                            </th>
                        </tr>
                        </thead>
                        <tbody bgcolor="#eee"
                               style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                        <tr>
                            <td align="left" style="padding:3px 9px" valign="top"><span>{{ $name }}</span><br>
                            </td>
                            <td align="left" style="padding:3px 9px" valign="top"><span></span></td>
                            <td align="left" style="padding:3px 9px" valign="top"></td>
                            <td align="left" style="padding:3px 9px" valign="top"><span></span></td>
                            <td align="right" style="padding:3px 9px" valign="top"><span></span>{{ $phone }}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <tr>
                    <td>
                        <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#273859">
                            Nội dung</h2>
                        <p style="margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">{!! $content !!}</p>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;
                        <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#273859">
                            Hỗ trợ</h2>
                        <p style="margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                            Mọi thắc mắc và góp ý, quý khách vui lòng liên hệ với @if($marketing) {{$name}} @else {{ $publiser_name }} @endif qua hotline:
                            <a href="tel:0347233768" target="_blank">0347233768</a>. Đội ngũ @if($marketing) {{$name}} @else {{ $publiser_name }} @endif
                            luôn sẵn sàng hỗ trợ bạn.</p>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;
                        <p>Một lần nữa @if($marketing) {{$name}} @else {{ $publiser_name }} @endif  cảm ơn quý khách.</p>

                        <p><strong><a href="" style="color:#00a3dd;text-decoration:none;font-size:14px"
                                      target="_blank">@if($marketing) {{$name}} @else {{ $publiser_name }} @endif </a> </strong></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
