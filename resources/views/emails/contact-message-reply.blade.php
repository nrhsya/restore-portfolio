<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <title>{{ $replySubject }}</title>
    </head>

    <body>

        <p>Hi {{ $contactMessage->name }},</p>

        <div>
            {!! $replyMessage !!}
        </div>

        <p>
            Regards,<br>
            Nur Hasya
        </p>

    </body>
</html>
