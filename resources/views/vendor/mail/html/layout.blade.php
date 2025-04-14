<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Formato.css" media="screen">
<!-- This Page CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.17/summernote-lite.min.css"/>
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>
</head>
<body>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
{{ $header ?? '' }}

<!-- Email Body -->
<tr>
<td class="body" width="100%" cellpadding="0" cellspacing="0">
<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<!-- Body content -->
<tr>
<td class="content-cell">
{{ Illuminate\Mail\Markdown::parse($slot) }}

{{ $subcopy ?? '' }}
</td>
</tr>
</table>
</td>
</tr>

{{ $footer ?? '' }}
</table>
</td>
</tr>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.17/summernote.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.17/summernote-lite.min.js"></script>
<script>
    /************************************/
    //default editor
    /************************************/
    $('.summernote').summernote({
    height: 150,
    airMode: true, // set editor height
    //codemirror: { theme:'spacelab'}, // codemirror options
    //minHeight: null, // set minimum height of editor
    //maxHeight: null, // set maximum height of editor
    //focus: false, // set focus to editable area after initializing summernote
    });
</script>
</body>
</html>
