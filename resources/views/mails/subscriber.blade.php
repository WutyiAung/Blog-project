<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <h1>hi {{$subscriber->name}}</h1>
  <p>the blog you have subscribed has update</p>
  <p>the comment message is <b>{{ $comment->body }}</b></p>
</body>
</html>