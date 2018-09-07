<head>
<script>
var count=1;
		function startt()
			{
		//for (i=1;i<=2;i++)
			//alert('excelgen.php?count='+i)
			window.location.href='excelgen.php?count='+count;
			count+=1;
			if (count<2) setTimeout("startt()",2000);
			}
</script>
</head>


<body style="background-color: #445672;">

<button type= 'button' id='bu' onclick="startt()">Start Generation</button>

</body>