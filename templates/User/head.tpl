<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="smronju">
<meta name="robots" content="noindex">
<title>{$title}</title>

{if !empty($css)}
	{foreach from=$css key=$k item=$v}
<link href="{_BASE_URL_}/css/User/{$v}.css?{time()}" rel="stylesheet">
	{/foreach}
{/if}

<link href="//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/basic.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.css" rel="stylesheet">
<link href="//cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" rel="stylesheet">

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<base href="{_BASE_URL_}" target="_self">

{if !empty($js)}
	{foreach from=$js key=$k item=$v}
<script src="{_BASE_URL_}/js/{$v}.js?{time()}" type="text/javascript"></script>
	{/foreach}
{/if}

</head>

<body>
