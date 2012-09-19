<script>
var Mako =
{
	toggleDisplay : function(id)
	{
		var element = document.getElementById(id);

		var elements = document.getElementsByClassName('mako-toggle');

		for(var i = 0; i < elements.length; i++)
		{
		    if(element !== elements[i])
		    {
		    	elements[i].style.display = 'none';
		    }
		}

		if(window.getComputedStyle(element).getPropertyValue('display') == 'none')
		{
			element.style.display = 'block';
		}
		else
		{
			element.style.display = 'none';	
		}

		return false;
	}
};
</script>

<style>
#mako-debug
{
	width: 100%;
	position: fixed;
	bottom: 0;
	right:0;
	z-index: 9999;
	color: #fff;
	font-family:"Helvetica Neue",Helvetica,Arial,sans-serif !important;
	font-size: 16px !important;
}
#mako-debug img
{
	vertical-align: middle;
}
#mako-debug a
{
	text-decoration: none;
}
#mako-debug p
{
	margin-top: 1em;
	margin-bottom: 1em;
}
#mako-debug .mako-strong
{
	font-weight: bold;
}
#mako-debug .mako-small
{
	font-size: 0.85em;
}
#mako-debug .mako-time
{
	float: right;
	color: #999;
	padding: 3px;
}
#mako-debug .mako-log
{
	color: #fff;
	text-shadow: 0px 1px 0px #000;
}
#mako-debug .mako-notice
{
	background: #999999;
}
#mako-debug .mako-critical
{
    background: #B94A48;
}
#mako-debug .mako-alert
{
    background: #F89406;
}
#mako-debug .mako-emergency
{
    background: #B94A48;
}
#mako-debug .mako-error
{
    background: #B94A48;
}
#mako-debug .mako-warning
{
    background: #F89406;
}
#mako-debug .mako-info
{
    background: #3A87AD;
}
#mako-debug .mako-debug
{
    background: #468847;
}
#mako-debug .mako-title
{
	color: #aaa;
	font-size: 2.0em;
	text-align: center;
	text-shadow: 0px 2px 0px #fff;
}
#mako-debug .mako-empty
{
	margin: 150px auto;
}
#mako-debug .mako-table
{
	width: 100%;
	border: 1px solid #ccc;
	background: #fff;
}
#mako-debug table td
{
	padding: 4px;
	border-bottom: 1px solid #ccc;
}
#mako-debug table td:first-child
{
	width: 20%;
	vertical-align: top;
}
#mako-debug table td:last-child
{
	width: 80%;
	white-space: pre-wrap;
	word-wrap: break-word;
	word-break: break-all;
}
#mako-debug table tr:last-child td
{
	border: 0px;
}
#mako-debug table tr:nth-child(odd)
{
	background: #efefef;
}
#mako-debug table tr th
{
	text-align: left;
	padding: 4px;
}
#mako-debug .mako-toolbar
{
	padding: 12px;
	background: #111;
	background: -webkit-linear-gradient(bottom, #1c1c1c, #3c3c3c);
	background: -moz-linear-gradient(bottom, #1c1c1c, #3c3c3c);
	background: -ms-linear-gradient(bottom, #1c1c1c, #3c3c3c);
	background: -o-linear-gradient(bottom, #1c1c1c, #3c3c3c);
	border-top: 1px solid #000;
	font-size: 0.8em;
	text-shadow: 0px 1px 0px #000;
}
#mako-debug .mako-content
{
	display: none;
	height: 400px;
	padding: 12px;
	overflow: auto;
	background: #eee;
	background: rgba(250, 250, 250, 0.95);
	border-top: 2px solid #555;
	color: #222;
	font-size: 0.9em;
	text-shadow: 0px 1px 0px #fff;
}
#mako-debug a.mako-button
{
	color: #bbb;
	padding: 5px;
	border-right: 1px solid #222;
	-webkit-box-shadow: 1px 0px 0px #444;
	-moz-box-shadow: 1px 0px 0px #444;
	box-shadow: 1px 0px 0px #444;
}
#mako-debug a.mako-button:hover
{
	color: #eee;
}
#mako-debug a.mako-button:last-child
{
	border-right: none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
</style>

<div id="mako-debug">

<div class="mako-content mako-toggle" id="mako-queries">
<?php if(empty($queries)): ?>
<div class="mako-empty mako-title">No database queries...</div>
<?php else: ?>
<p><span class="mako-title">DATABASE QUERIES</span></p>
<table class="mako-table">
<tr>
<th>Time</th>
<th>Query</th>
</tr>
<?php foreach($queries as $query): ?>
<tr>
<td><?php echo round($query['time'], 5); ?> seconds</td>
<td><?php echo htmlspecialchars(print_r($query['query'], true), ENT_QUOTES, MAKO_CHARSET); ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
</div>

<div class="mako-content mako-toggle" id="mako-log">
<?php if(empty($logs)): ?>
<div class="mako-empty mako-title">No log entries...</div>
<?php else: ?>
<p><span class="mako-title">LOG ENTRIES</span></p>
<table class="mako-table">
<tr>
<th>Type</th>
<th>Message</th>
</tr>
<?php foreach($logs as $log): ?>
<tr>
<td class="mako-log mako-<?php echo $log['type']; ?>"><?php echo $log['type']; ?></td>
<td><?php echo htmlspecialchars(print_r($log['message'], true), ENT_QUOTES, MAKO_CHARSET); ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
</div>

<div class="mako-content mako-toggle" id="mako-variables">

<?php if(!empty($_COOKIE)): ?>
<p><span class="mako-title">COOKIE</span></p>
<table class="mako-table">
<tr>
<th>Key</th>
<th>Value</th>
</tr>
<?php foreach($_COOKIE as $key => $value): ?>
<tr>
<td><?php echo htmlspecialchars($key, ENT_QUOTES, MAKO_CHARSET); ?></td>
<td><?php echo htmlspecialchars(print_r($value, true), ENT_QUOTES, MAKO_CHARSET); ?></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<?php endif; ?>

<?php if(!empty($_ENV)): ?>
<p><span class="mako-title">ENV</span></p>
<table class="mako-table">
<tr>
<th>Key</th>
<th>Value</th>
</tr>
<?php foreach($_ENV as $key => $value): ?>
<tr>
<td><?php echo htmlspecialchars($key, ENT_QUOTES, MAKO_CHARSET); ?></td>
<td><?php echo htmlspecialchars(print_r($value, true), ENT_QUOTES, MAKO_CHARSET); ?></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<?php endif; ?>

<?php if(!empty($_FILES)): ?>
<p><span class="mako-title">FILES</span></p>
<table class="mako-table">
<tr>
<th>Key</th>
<th>Value</th>
</tr>
<?php foreach($_FILES as $key => $value): ?>
<tr>
<td><?php echo htmlspecialchars($key, ENT_QUOTES, MAKO_CHARSET); ?></td>
<td><?php echo htmlspecialchars(print_r($value, true), ENT_QUOTES, MAKO_CHARSET); ?></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<?php endif; ?>

<?php if(!empty($_GET)): ?>
<p><span class="mako-title">GET</span></p>
<table class="mako-table">
<tr>
<th>Key</th>
<th>Value</th>
</tr>
<?php foreach($_GET as $key => $value): ?>
<tr>
<td><?php echo htmlspecialchars($key, ENT_QUOTES, MAKO_CHARSET); ?></td>
<td><?php echo htmlspecialchars(print_r($value, true), ENT_QUOTES, MAKO_CHARSET); ?></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<?php endif; ?>



<?php if(!empty($_POST)): ?>
<p><span class="mako-title">POST</span></p>
<table class="mako-table">
<tr>
<th>Key</th>
<th>Value</th>
</tr>
<?php foreach($_POST as $key => $value): ?>
<tr>
<td><?php echo htmlspecialchars($key, ENT_QUOTES, MAKO_CHARSET); ?></td>
<td><?php echo htmlspecialchars(print_r($value, true), ENT_QUOTES, MAKO_CHARSET); ?></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<?php endif; ?>

<p><span class="mako-title">SERVER</span></p>
<table class="mako-table">
<tr>
<th>Key</th>
<th>Value</th>
</tr>
<?php foreach($_SERVER as $key => $value): ?>
<tr>
<td><?php echo htmlspecialchars($key, ENT_QUOTES, MAKO_CHARSET); ?></td>
<td><?php echo htmlspecialchars(print_r($value, true), ENT_QUOTES, MAKO_CHARSET); ?></td>
</tr>
<?php endforeach; ?>
</table>

<br>

<?php if(!empty($_SESSION)): ?>
<p><span class="mako-title">SESSION</span></p>
<table class="mako-table">
<tr>
<th>Key</th>
<th>Value</th>
</tr>
<?php foreach($_SESSION as $key => $value): ?>
<tr>
<td><?php echo htmlspecialchars($key, ENT_QUOTES, MAKO_CHARSET); ?></td>
<td><?php echo htmlspecialchars(print_r($value, true), ENT_QUOTES, MAKO_CHARSET); ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

</div>

<div class="mako-content mako-toggle" id="mako-files">
<p><span class="mako-title">INCLUDED FILES</span></p>
<table class="mako-table">
<tr>
<th>#</th>
<th>Name</th>
</tr>
<?php foreach($files as $key => $value): ?>
<tr>
<td><?php echo $key + 1; ?></td>
<td><?php echo htmlspecialchars($value, ENT_QUOTES, MAKO_CHARSET); ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>

<div class="mako-toolbar">
<div class="mako-time">rendered in <?php echo $time; ?> seconds</div>
<img src="data:image/png;base64,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" alt="" title="Mako <?php echo MAKO_VERSION; ?>" />
<a class="mako-button" href="#" onclick="Mako.toggleDisplay('mako-queries')"><span class="mako-strong"><?php echo count($queries); ?></span> database queries<?php if(count($queries) != 0): ?> <span class="mako-small">( <?php echo $db_time; ?> seconds )</span><?php endif; ?></a>
<a class="mako-button" href="#" onclick="Mako.toggleDisplay('mako-log')"><span class="mako-strong"><?php echo count($logs); ?></span> log entries</a>
<a class="mako-button" href="#" onclick="Mako.toggleDisplay('mako-files')"><span class="mako-strong"><?php echo count($files); ?></span> included files</a>
<a class="mako-button" href="#" onclick="Mako.toggleDisplay('mako-variables')">superglobals</a>
</div>

</div>