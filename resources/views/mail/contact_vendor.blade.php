<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? 'Presto.it'}}</title>
</head>

<body>
    <div>
        <h1>l'utente {{$user->name}} ti ha scritto:</h1>

        <p>
            {{$emailSents[0]->body}}
        </p>

        <h3>Rispondi a {{$user->name}} la sua email è {{$user->email}}</h3>

    </div>
</body>

</html>