<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Funzstation</title>  
    
    <?php include("header-js.php")?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="http://mobilecafe4u.mobi/uae/css/custom.css"></link>

  </head>

<body>

<div class="main-con main-box">
   <div class="container">
      <div class="fun-inner">
        <div class="head-box" style="background:black;">
           <img src="images/logo.png" class="img-fluid">
		   <div class="upper-list">
                <div style="float:right">
					<span class="only-ar"><a class="language-option optionEn" href="javascript:void(0);">English</a></span>
					<span class="only-en"><a class="language-option optionAr" href="javascript:void(0);">Arabic</a></span>
				</div>
            </div>
        </div>

        <div class="main-box main-inner thnk banner-main">
          <div class="fig-box">
            <img class="img-fluid" src="images/banner1.gif">
          </div>
		<!--FOR ENGLISH-->
          <div class="doorgaan only-en">
             <h6>Congratulations, you've subscribed successfully</h6>
             <h5>Videos and Games online by Funzstation</h5>
			 <!--<h5 style="color:green">Check Message for portal URL and your ID.</h5>-->
			 <div align="center">
             <a class="btn btn-door" href="http://funzstation.com/saudi_arabia?msisdn=<?php echo $msisdn;?>">Home</a>
			 </div>
          </div>
		  <!--FOR ENGLISH CLOSE-->
		  <!--FOR ARABIC-->
		  <div class="doorgaan only-ar">
             <h6>مبروك, لقد تم الاشتراك بنجاح في الخدمه</h6>
             <h5>مقاطع فيديو وألعاب عبر الإنترنت بواسطة Funzstation</h5>
			 <!--<h5 style="color:green">تحقق من الرسالة الخاصة بعنوان URL للبوابة والمعرف الخاص بك  </h5>-->
			<div align="center">
             <a class="btn btn-door"  href="http://funzstation.com/saudi_arabia?msisdn=<?php echo $msisdn;?>">الصفحة الرئيسية</a>
			</div>
		  </div>
		  <!--FOR ARABIC CLOSE-->
          <!--FOR ENGLISH-->
          <div class="condition-box only-en">
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
          <ul>
            <li><p><span dir="rtl">نقطة سعر الخدمة هي  1.15 / يوم شامل ضريبة القيمة المضافة.</span></p></li>
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
<script>
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

<?php include("footer-js.php")?>

</body>
</html>

