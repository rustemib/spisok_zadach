<!DOCTYPE html>
<html>
<head>
    <title>Error</title>

</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Oops! Something went wrong.</div>
        @if(!empty($message))
            <p>{{ $message }}</p>
        @endif
    </div>
</div>
</body>
</html>
