<?php
return [
    'qrcode'=>[
        'url'=>env('QRCODE_URL','https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=%s/locker/')
    ]
];
