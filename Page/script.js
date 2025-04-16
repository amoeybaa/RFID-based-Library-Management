function confirmLogout() {

    const confirmation = confirm("Are you sure you want to logout?");

    if (confirmation) {
        window.location.href = "homepage.html";
    }
    else
        return false;
}

function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var usernamePattern = /^\d{6}$/;                        		// 6-digit number
    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/; 		// At least 8 characters with one lowercase and one uppercase letter

    if (!usernamePattern.test(username)) {
        alert("Username should be a 6-digit number.");
        return false;                  					// Prevent form submission
    }

    if (!passwordPattern.test(password)) {
        alert("Password should be at least 8 characters long with one lowercase and one uppercase letter.");
        return false;                   				// Prevent form submission
    }		

    return true;
}

function validateAdminForm() {
    var password = document.getElementById("password").value;
    
    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/; 		// At least 8 characters with one lowercase and one uppercase letter
    
    if (!passwordPattern.test(password)) {
        alert("Password should be at least 8 characters long with one lowercase and one uppercase letter.");
        return false;                   				// Prevent form submission
    }
    
    return true;
}

function resetpwd()
{
	var pas1 = document.getElementById("password").value;
	var pas2 = document.getElementById("npass").value;
	if(pas1 != pas2)
	{
		window.alert("New paswords do not match!");
		return false;						// Prevent form submission
	}
	var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;		// At least 8 characters with one lowercase and one uppercase letter
	if (!passwordPattern.test(pas1))
	{
        window.alert("Password should be at least 8 characters long with one lowercase and one uppercase letter.");
        return false;                  					 // Prevent form submission
    	}
	return true;
}

function goBack()
{
	window.history.back();
}

function gotoBook()
{
	window.location.href = "/Project/Page/admin/update_book.php";	
}

function validate_add()
{
	var isbn = document.getElementById("isbn").value;
	var year = document.getElementById("year").value;
	var cur_year = new Date().getFullYear();
	
	if(isbn.length != 13)
	{
		window.alert("ISBN should be 13 digit long!");
		return false;
	}
	
	if(year > cur_year)
	{
		window.alert("Publishing year cannot be greater than "+cur_year);
		return false;
	}
	return true;
}
	
