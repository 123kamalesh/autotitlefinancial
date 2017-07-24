(function($){
    $.validator.addMethod(
        "phoneUS",
        function(phone_number,element){
            phone_number = phone_number.replace(/\s+/g,"");
            
            //return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})[- ]?[2-9]\d{2}-?\d{4}$/);
            return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(\([2-9]\d{2}\)|[2-9]\d{2})[- ]?[2-9]\d{2}-?\d{4}$/);
        },
        "Please enter a valid phone number"
    );
    
    $.validator.addMethod(
        "employerPhoneUS",
        function(phone_number,element){
            var other_phone = $("[name=primary_phone]").val().replace(/\D+/g,"");
            phone_number = phone_number.replace(/\s+/g,"");
            
            return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(\([2-9]\d{2}\)|[2-9]\d{2})[- ]?[2-9]\d{2}-?\d{4}$/) && (other_phone != phone_number.replace(/\D+/g,""));
        },
        "Please enter a valid phone number"
    );
	
	$.validator.addMethod(
		"routingNum", 
		function (value, element) {
      	// algorithm taken from: http://www.brainjar.com/js/validation/

    	var t = value;
		n = 0;
		for (i = 0; i < t.length; i += 3) {
			n += parseInt(t.charAt(i), 10) * 3
			  + parseInt(t.charAt(i + 1), 10) * 7
			  + parseInt(t.charAt(i + 2), 10);
		}
	
		// If the resulting sum is an even multiple of ten (but not zero),
		// the aba routing number is good.
	
		if (n != 0 && n % 10 == 0)
			return true;
		else
			return (this.optional(element) || false);
		}, 
		"Please enter a valid routing number."
	);
    
    $.validator.addMethod(
        "nameUS",
        function(name,element){
            name = name.replace(/(^\s+|\s+$)/g,"");
            
            return this.optional(element) || name.length && !name.match(/(^|[^a-z])[bcdfghjklmnpqrstvwxz]{3,}([^a-z]|$)/ig);
        },
        "Please enter a valid name"
    );
    
    $.validator.addMethod(
        "cityUS",
        function(city,element){
            city = city.replace(/(^\s+|\s+$)/g,"");
            
            return this.optional(element) || city.length && !city.match(/[^a-z ]/ig);
        },
        "Please enter a valid city name"
    );
    
    $.validator.addMethod(
        "montlyIncome",
        function(income,element){
            income = income.replace(/(^\s+|\s+$)/g,"");
            
            if (this.optional(element)) {
                return true;
            }
            
            if (income.match(/\D/)) {
                return false;
            }
            
            income = parseInt(income);
            
            return income > 100;
        },
        "Monthly Income must be higher than $100 and less then $9999"
    );
    
    $.validator.addMethod(
        "driverUS",
        function(license,element){
            var formats = {
                "AL": /^(\d{1,7})$/ig,
                "AK": /^(\d{1,7})$/ig,
                "AZ": /^([a-z]{1}\d{1,8}|[a-z]{2}\d{2,5}|\d{9})$/ig,
                "AR": /^(\d{4,9})$/ig,
                "CA": /^([a-z]{1}\d{7})$/ig,
                "CO": /^(\d{9}|[a-z]{1}\d{3,6}|[a-z]{2}\d{2,5})$/ig,
                "CT": /^(\d{9})$/ig,
                "DE": /^(\d{1,7})$/ig,
                "DC": /^(\d{7}|\d{9})$/ig,
                "FL": /^([a-z]{1}\d{12})$/ig,
                "GA": /^(\d{7,9})$/ig,
                "HI": /^([a-z]{1}\d{8}|\d{9})$/ig,
                "ID": /^([a-z]{2}\d{6}[a-z]{1}|\d{9})$/ig,
                "IL": /^([a-z]{1}\d{11}|[a-z]{1}\d{12})$/ig,
                "IN": /^([a-z]{1}\d{9}|\d{9}|\d{10})$/ig,
                "IA": /^(\d{9}|\d{3}[a-z]{2}\d{4})$/ig,
                "KS": /^([a-z]{1}\d{1}[a-z]{1}\d{1}[a-z]{1}|[a-z]{1}\d{8}|\d{9})$/ig,
                "KY": /^([a-z]{1}\d{8}|[a-z]{1}\d{9}|\d{9})$/ig,
                "LA": /^(\d{1,9})$/ig,
                "ME": /^(\d{7}|\d{7}[a-z]{1}|\d{8})$/ig,
                "MD": /^([a-z]{1}\d{12})$/ig,
                "MA": /^([a-z]{1}\d{8}|\d{9})$/ig,
                "MI": /^([a-z]{1}\d{10}|[a-z]{1}\d{12})$/ig,
                "MN": /^([a-z]{1}\d{12})$/ig,
                "MS": /^(\d{9})$/ig,
                "MO": /^([a-z]{1}\d{5,9}|[a-z]{1}\d{6}R|\d{8}[a-z]{2}|\d{9}[a-z]{1}|\d{9})$/ig,
                "MT": /^([a-z]{1}\d{8}|\d{13}|\d{9}|\d{14})$/ig,
                "NE": /^(\d{1,7})$/ig,
                "NV": /^(\d{9}|\d{10}|\d{12}|X\d{8})$/ig,
                "NH": /^(\d{2}[a-z]{3}\d{5})$/ig,
                "NJ": /^([a-z]{1}\d{14})$/ig,
                "NM": /^(\d{8}|\d{9})$/ig,
                "NY": /^([a-z]{1}\d{7}|[a-z]{1}\d{18}|\d{8}|\d{9}|\d{16}|[a-z]{8})$/ig,
                "NC": /^(\d{1,12})$/ig,
                "ND": /^([a-z]{3}\d{6}|\d{9})$/ig,
                "OH": /^([a-z]{1}\d{4,8}|[a-z]{2}\d{3,7}|\d{8})$/ig,
                "OK": /^([a-z]{1}\d{9}|\d{9})$/ig,
                "OR": /^(\d{1,9})$/ig,
                "PA": /^(\d{8})$/ig,
                "RI": /^(\d{7}|[a-z]{1}\d{6})$/ig,
                "SC": /^(\d{5,11})$/ig,
                "SD": /^(\d{6,10}|\d{12})$/ig,
                "TN": /^(\d{7,9})$/ig,
                "TX": /^(\d{7,8})$/ig,
                "UT": /^(\d{4,10})$/ig,
                "VT": /^(\d{8}|\d{7}A)$/ig,
                "VA": /^([a-z]{1}\d{9}|[a-z]{1}\d{10}|[a-z]{1}\d{11}|\d{9})$/ig,
                "WA": /^([a-z]{1}[a-z\d*]{11})$/ig, // 12 chars total
                "WV": /^(\d{7}|[a-z]{1,2}\d{5,6})$/ig,
                "WI": /^([a-z]{1}\d{13})$/ig,
                "WY": /^(\d{9,10})$/ig
            },
            state = $('[name=id_state]').val(),
            errors = {};
            
            license = license.replace(/(^\s+|\s+$)/g,"");
            
            if (this.optional(element) || license.length && !formats.hasOwnProperty(state)) {
                return true;
            }
            
            return formats[state].test(license);
        },
        "Please specify a valid license number for the selected state, no dashes"
    );
    
    $(document).ready(function(){
        var tid = tid || "";
		
		  $('input#email').blur(function(){
			$(this).mailcheck({
			  suggested: function(element, suggestion) {
				$('#mailcheck').replaceWith('');
				$("#email_suggestion").append("<label id='mailcheck' class='error'>Did you mean " + suggestion.full + "? </label>");
			  },
			  empty: function(element) {
				$('#mailcheck').replaceWith('');
			  }
			});
		  });
        
        $("#front-page").validate({
            onkeyup:false,
            rules:{
                first_name:{
                    required:true,
                    nameUS:true
                },
                last_name:{
                    required:true,
                    nameUS:true
                },
                zipcode:{
                    required:true,
                    number:true,
                    minlength:5,
                    maxlength:5
                },
                email:{
                    required:true,
                    email:true
                },
				primary_phone:{
                    required:true,
                    phoneUS:true
                },
            },
            messages:{
                zipcode:"Zip code must have 5 digits",
				first_name:"Please enter your first name",
				last_name:"Please enter your last name",
				primary_phone:"Please enter a valid phone number"
            },
            submitHandler:function(form){
				 var xi = _gaq.push(['_trackEvent', 'Steps', 'Completed', 'ShortForm']);
                form.submit();
            }
        });
        
        $("#CashDataForm").validate({
            onkeyup:false,
            rules:{
                first_name:{
                    required:true,
                    nameUS:true
                },
                last_name:{
                    required:true,
                    nameUS:true
                },
				employer:{
                    required:true,
                    nameUS:true
                },
                city:{
                    required:true,
                    cityUS:true
                },
                zipcode:{
                    required:true,
                    number:true,
                    minlength:5,
                    maxlength:5
                },
                email:{
                    required:true,
                    email:true
                },
                primary_phone:{
                    required:true,
                    phoneUS:true
                },
                social_security:{
                    required:true,
                    digits:true,
                    minlength:9,
                    maxlength:9
                },
                drivers_lic:{
                    required:true,
                    driverUS:true
                },
                monthly_income:{
                    required:true,
                    min:100,
                    max:9999
                },
				mileage:{
                    required:true,
                    min:1,
                    max:9999999
                },
                aba_routing_number:{
                    required:true,
                    digits:true,
                    minlength:9,
                    maxlength:9,
					routingNum:true
                }
            },
            messages:{
				first_name:"Please enter a valid first name",
				last_name:"Please enter a valid last name",
				employer:"Please enter the name of your employer",
                city:"Please specify a valid city name",
                zipcode:"Zip code must have 5 digits",
				drivers_lic: "Please enter your drivers license or state issued id number",
                social_security:"Please enter 9 digits, no dashes",
                monthly_income:"<b>Monthly</b> Income must be between $100 &amp; $9999",
				mileage:"Please enter vehicle mileage",
                primary_phone:"Please enter a valid phone number",
				aba_routing_number:"Please enter a valid routing number.",
            },
            submitHandler:function(form){
                $(form).submit();
            }
        });
        
        
        $('#pay_date_one').bind('change',function(){
           var $this = $(this),
           value = $this.val(),
           last = $this.data('last'),
           next = $('#pay_date_two');
           
           if (!value.match(/\d+\/\d+\/\d+/)) {
              return;
           }
           
           if (value == last) {
              return
           }
           
           $this.data('last',last);
           
           $.ajax({
              url:'/js/date.php',
              data:{date:value},
              type:'post',
              success:function(html){
                 next.html(html).removeAttr('disabled');
              },
              error:function(){
                 next.removeAttr('disabled');
              }
           });
           
           next.attr('disabled','disabled');
        });
        
        $("select")
         .each(function() {
            var $this = $(this),
            width = $this.outerWidth();
            
            if (width) {
               $this.data("origWidth",width);
               $this.data("autoWidth",$this.css("width","auto").outerWidth());
               $this.css("width",width);
            }
         })
         .mouseenter(function(){
            var $this = $(this),
            width = $this.data("origWidth"),
            auto = $this.data("autoWidth");
            
            if (!width) {
               width = $this.outerWidth();
               $this.data("origWidth",width);
               $this.data("autoWidth",$this.css("width","auto").outerWidth());
               $this.css("width",width);
            }
            
            if (auto > width) {
               $this.css("width","auto");
            }
         })
         .bind("mouseleave change", function(){
            var $this = $(this),
            width = $this.data("origWidth");
            
            if (width) {
               $this.css("width",width);
            }
         });
         
         $('#form_submit').click(function(data){
            if (!$("#interscreen").length) {
                $("#interscreen").append('<!-- Offer Goal Conversion: first page submit --><!-- // End Offer Goal Conversion -->');
            }

            if ($("#CashDataForm").validate().form()) {
              // var path = '/cashformajax.php',
			   var path = $('#option_path').val(),
               cache = '',
                interval = 0, // setInterval ID
                calls = 0, // Die after X minutes, or Y function calls
                seconds = 10, // Call retry
                limit = 10*60, // Max seconds to wait
                error = function(){
                    $('#interscreen').slideUp('fast');
                    $('#thankyou').html('<h2>Opps.. something went wrong</h2><p>Unfortunately we were unable to process your request, we will require you to try to submit your information again.</p><p>We apology for the inconvenience.</p>').slideDown('fast');
                    
                    // Notify we failed to receive this information
                    $.ajax({
                         type:'POST',
                         url:path,
                         data:{call_fail:"call failed"}
                     });
                    
                    setTimeout(function(){
                      //  $('#CashDataForm').find('input, select, textarea').removeAttr('disabled');
//                        $('.right-container').show('fast');
                        $('#formdiv').show('fast');
//                        $('#3steps').show('fast');
                    },5000);
                },
                timeout = function(){
                    calls++;
                    
                    if (calls*seconds > limit) {
                        error();
                        clearInterval(interval);
                        
                        return false;
                    }
                    
                    if (cache) {
                        $('#interscreen').slideUp('fast');
                        $('#thankyou').html(cache).slideDown('fast');
                        clearInterval(interval);
                        
                        return true;
                    }
                    
                    return false;
                };
                
                
                $('#formdiv').slideUp('fast');
                
//                $('#thankyou').html('').hide('fast');
                
                $('#interscreen').slideDown('fast');
				$('#innr-arrow').hide();
			//	var xi = _gaq.push(['_trackEvent', 'Steps', 'Completed', 'LongForm']);
                
                $.ajax({
                    type:'POST',
                    url:path,
                    timeout:limit*1000,
                    data:$('#CashDataForm').serialize(),
                    success:function(response){
                        cache = response;
                    },
                    error:error
                });
                
                $('#CashDataForm').find('input, select, textarea').attr('disabled','disabled');
                interval = setInterval(timeout,seconds*1000);
            }
        });
    });
   
}(jQuery));
