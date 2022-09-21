<script type="text/javascript">

	// Set a Cookie
	function setCookie(cName, cValue, expDays = 7) {
		console.log("Setting "+ cName + "("+cValue+")");
		let date = new Date();
		date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
		const expires = "expires=" + date.toUTCString();
		document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
	}

	// Get a cookie
	function getCookie(cName) {
		const name = cName + "=";
		const cDecoded = decodeURIComponent(document.cookie); //to be careful
		const cArr = cDecoded .split('; ');
		let res;
		cArr.forEach(val => {
		  if (val.indexOf(name) === 0) res = val.substring(name.length);
		})
		return res;
	}

	jQuery(document).ready(function() {
		jQuery.ajax({
		    type: 'POST',
		    url: '<?php echo admin_url('admin-ajax.php');?>',
		    dataType: "html",  
		    data: { 
		        action : 'austeve_get_cart_count', 
		        security: '<?php echo wp_create_nonce( "get-cart-count" ); ?>'
		    },
		    error: function (xhr, status, error) {
		        console.log("Error: " + error);
		        
		    },
		    success: function( response ) {
		        if (response) {
		            jQuery('header .fa-shopping-cart').after("<span class='header-cart-count'>"+response+"</span>");
		        }
		        else {
		            console.log("No response!");
		        }
		    }
		});

		/* Show 'Buy for class' buttons if wishlist_id cookie is present */
		if (getCookie('wishlist_id')) {
			jQuery('.hide-for-no-wishlist-cookie').removeClass('hide-for-no-wishlist-cookie');
		}
	});

</script>

