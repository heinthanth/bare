<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oops! <?php echo e($code ?? ''); ?></title>
    <style> html, body { font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji; height: 100%; min-width: 300px; margin: 0; padding: 0; } body { display: flex; align-items: center; justify-content: center } .code { margin: 0; font-size: 50px; padding: 0px 10px; } @media (max-width: 768px) { .code { font-size: 30px; } } @media (max-width: 576px) { .code { font-size: 24px; } }</style>
</head>
<body>
    <h1 class="code">Oops! <?php echo e($code ?? "Something went wrong!"); ?></h1>
</body>
</html><?php /**PATH /Users/heinthanth/Documents/projects/bare/src/Builtins/views/ErrorPages/template.blade.php ENDPATH**/ ?>