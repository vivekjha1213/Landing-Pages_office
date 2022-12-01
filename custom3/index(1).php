<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Funzstation</title>  
    
<?php include("../header-js.php");
include '../connect.php';
?>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"></link>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
<!--SCRIPT ADDED BY RAJENDRA-->
<script type="text/javascript">
console.log("start ajax");
$(document).ready(function(){    

    $(".submityes").click(function() {
        $('#newgen').append('<div class="spinner-border"></div>');
		    //var sessionToken=TPay.HeaderEnrichment.sessionToken();
        var msisdn=$('#msisdn').val();
        //var operator=$('#operator').val();
		    var cid=$('#cid').val();
        //console.log(operator);
        console.log(msisdn);
        console.log(cid);
		    //console.log(sessionToken);
		    //return false;

            $.ajax({
                type:"POST",
                url:"pin_request.php",
                data:{msisdn:msisdn,cid:cid},
                success:function(result)
                {
                   $('#newgen').hide();
                    var jsonData = JSON.parse(result);
                    //var jsonData=JSON.stringify(result);
                    //alert(jsonData.status);
                    //return false;
                    if (jsonData.status == "0")
                    {   
                        location.href = 'otp_page.php?msisdn='+msisdn+'&cid='+cid+'';
                        return false;
                    }
                    else if(jsonData.status =="1")
                    {
                        location.href = 'http://Funzstation.com/saudi_arabia/?msisdn='+msisdn+'';
                        return false;
                    }
                    else
                    {
                        alert(jsonData.errorMessage);
                        location.reload();

                    }
        
                }
			});
	});
});
</script>
<!--SCRIPT ENDED BY RAJENDRA-->
<div class="main-con main-box">
   <div class="container">
      <div class="fun-inner">
        <div class="head-box" style="background:black;">
           <img src="images/logo.png" class="img-fluid">
            <div class="upper-list" >
              <!--<select class="lanuage" onchange="javascript:location.href = this.value;">-->
			  <!--<select class="language" onchange="javascript:location.href = this.value;">
                <span class="only-en"><option class="language-option optionEn" href="javascript:void(0); value="en">ENGLISH</option></span>
                <span class="only-ar"><option class="language-option optionAr" href="javascript:void(0); value="ar">ARABIC</option></span>
              </select>-->
			  	<!--<div style="float:right">-->
					<span class="only-ar"><a class="language-option optionEn" href="javascript:void(0);">English</a></span>
					<span class="only-en"><a class="language-option optionAr" href="javascript:void(0);">Arabic</a></span>
				<!--</div>-->
            </div>
        </div>
		<div class="subheading" style="color:#110000">
    </div>
        <div class="main-box main-inner banner-main">
          <div class="fig-box">
            <img class="img-fluid" src="images/Funzstation.jpg">
          </div>
			<!--FOR ENGLISH-->
          <div class="doorgaan">
			<div align="center" >
              <!--<p class="only-en"><label for="operator">Choose Operator</label></p>
			  <p class="only-ar"><label for="operator">اسم المشغل</label></P>
              <select id="operator" name="operator" class="classic" style="width:50%">
				<option class="" value=""></option>
				<option class="only-en" value="60201">Orange</option>
				<option class="only-ar" value="60201">اورنج</option>
				<option class="only-en" value="60202">Vodafone</option>
				<option class="only-ar" value="60202">فودافون </option>
				<option class="only-en" value="60203">Etisalat</option>
				<option class="only-ar" value="60203">اتصالات</option>
				<option class="only-en" value="60204">We</option>
				<option class="only-ar" value="60204">وي</option>
                <option value="WE">WE</option>
                <option value="Etisalat">Etisalat</option>
              </select>-->

              <p class="only-en"><label for="txtcn">Mobile Number</label></P>
			  <p class="only-ar"><label for="txtcn">رقم الهاتف   </label></p>
              <input type="text" id="msisdn" name="txtcn" placeholder="" style="width:100%">
			       <input type="hidden" id="cid" name="cid" value="<?php echo $_GET['cid'];?>">
            
              <button type="submit" value="SUBSCRIBE" class="submityes only-en btn-door" style="width:100%">SUBSCRIBE</button>
			  <button type="submit" value="SUBSCRIBE" class="submityes only-ar btn-door" style="width:100%">اشترك  </button>
			  <br>
			  <div id="newgen"></div>
			  </div>
          </div>
		  <!--FOR ENGLISH CLOSE-->
		  <!--FOR ARABIC-->
		  <!--<div class="doorgaan only-ar">
			 <div align="center" >
              <p><label for="operator">اسم المشغل</label></P>
              <select id="operator" name="operator" class="classic" style="width:50%">
                <option value="60201">اورنج</option>
				<option value="60202">فودافون </option>
                <!--<option value="وي">وي</option>
                <option value="اتصالات">اتصالات</option>-->
              <!--</select>

              <p><label for="txtcn">رقم الهاتف</label></p>
              <input type="text" id="msisdn" name="txtcn" placeholder="+201" style="width:50%">
			  <input type="hidden" id="cid" name="cid" value="<?php //echo $_GET[cid]; ?>">
            <button type="submit" value="SUBSCRIBE" id="submityes" style="width:50%">اشترك</button>
			<br>
			<div id="newgen"></div>
			</div>  
          </div>-->
		  <!--FOR ARABIC CLOSE-->
		  <!--FOR ENGLISH-->
          <div class="condition-box only-en">
             <h4><b>TERMS AND CONDITIONS</b></h4>
             <ul>
            <li><p>By subscribing to the service, you are accepting all Terms and Conditions of the service and authorize to share your mobile number with our partner ArshiyaInfosolutions, who manages this subscription service.</p></li>
              <li><p>Data charges would apply for browsing contents on this portal.</p></li>
              <li><p>The service is supported only for smartphones if your device supports streaming, you can stream unlimited videos while being an active subscriber to the service.</p></li>
              <li><p>To make use of this service, one must be more than 18 years old or have received permission from your parents or person who is authorized to pay your mobile bill.</p></li>
              <li><p>To unsubscribe from the service  Send U70 to 606068.</p></li>
			       <ul>	
          </div>
		  <!--FOR ENGLISH CLOSE-->
		  <!--FOR ARABIC-->
		  <div class="condition-box only-ar">
            <h4><b>الأحكام والشروط   </b></h4>
        <ul>
            <li><p><span dir="rtl">نقطة سعر الخدمة هي 1.15 / يوم شامل ضريبة القيمة المضافة.</span></p></li>
        	<li><p> <span dir="rtl">من خلال الاشتراك في الخدمة ، فإنك تقبل جميع شروط وأحكام الخدمة وتفوض مشاركة رقم هاتفك المحمول مع شريكنا ArshiyaInfosolutions ، الذي يدير خدمة الاشتراك هذه. </span></p></li>
        	<li><p> <span dir="rtl">يتم تطبيق رسوم البيانات على تصفح المحتويات على هذه البوابة. </span></p></li>
        	<li><p><span dir="rtl"> الخدمة مدعومة فقط للهواتف الذكية إذا كان جهازك يدعم البث ، فيمكنك بث مقاطع فيديو غير محدودة أثناء كونك مشتركًا نشطًا في الخدمة. </span></p></li>
        	<li><p><span dir="rtl"> للاستفادة من هذه الخدمة ، يجب أن يكون عمر الشخص أكثر من 18 عامًا أو حصل على إذن من والديك أو الشخص المخول بدفع فاتورة هاتفك المحمول. </span></p></li>
            <li><p><span dir="rtl">لإلغاء الاشتراك في الخدمة أرسل U70 إلى  801471</span></p></li>  
         </ul>
          </div>
		  <!--FOR ARABIC CLOSE-->
          
        </div>
      </div>
   </div>
</div>

<?php include("../footer-js.php")?>

</body>
<script type="text/javascript">
	language();
	function language() {
		var userLang = navigator.language || navigator.userLanguage;
		$('.only-en').hide();
		$('.only-ar').hide();

		var x = document.cookie;
		if (x == null) {
			$('.only-en').show();
			$('#english').hide();
		}
		if (x.search("en") != -1 || x == "" || x == '') {
			document.getElementsByTagName("html")[0].dir = "ltr";
			document.getElementsByTagName("html")[0].lang = "en";

			document.cookie = "lang=en";
			$('.only-en').show();
			$('#english').hide();
		}
		else {
			document.cookie = "lang=ar";
			$('.only-ar').show();
			$('#arabic').hide();
		}
		if (x.search("ar") != -1) {
			document.getElementsByTagName("html")[0].dir = "rtl";
			document.getElementsByTagName("html")[0].lang = "ar";

			$('.only-ar').show();
			$('#arabic').hide();
		}

		$('.optionEn').addClass('current');
		$('.optionAr').click(function () {
			document.getElementsByTagName("html")[0].dir = "rtl";
			document.getElementsByTagName("html")[0].lang = "ar";
			$('#container').css({ 'text-align': 'right' });
			$(this).addClass('current');
			$('.only-en').hide();
			$('#arabbic').hide();
			$('#english').show();
			$('.optionEn').removeClass('current');
			$('.only-ar').show();
			$('#english').show();
			$('#arabic').hide();
			document.cookie = "lang=ar";
			var x = document.cookie;
		});
		$('.optionEn').click(function () {
			document.getElementsByTagName("html")[0].dir = "ltr";
			document.getElementsByTagName("html")[0].lang = "en";
			$('#container').css({ 'text-align': 'left' });
			$(this).addClass('current');
			$('.only-ar').hide();
			$('#arabic').show();
			$('#english').hide();
			$('.optionAr').removeClass('current');
			$('.only-en ').show();
			$('#english').hide();
			$('#arabic').show();
			document.cookie = "lang=en";
			var x = document.cookie;
		});
		if (userLang == 'ar' && $('.optionEn').hasClass("current")) {
			$('.optionAr').click();
		}
	}
</script>
</html>

