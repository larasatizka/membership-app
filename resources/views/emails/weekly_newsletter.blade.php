<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Newsletter Mingguan</title>
</head>
<body>
    <h2>Hai {{ $user->name }},</h2>
    <p>Berikut adalah artikel terbaru untukmu hari ini:</p>

    <ul>
        @foreach ($articles as $article)
            <li>
                <strong>{{ $article->title }}</strong><br>
                <small>{{ \Illuminate\Support\Str::limit($article->content, 100) }}</small>
            </li>
        @endforeach
    </ul>

    <p>Terima kasih telah mengikuti newsletter kami!</p>
</body>
</html>
