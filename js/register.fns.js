function inlineError()
    {
        var a = document.getElementById('pw').value;
        var b = document.getElementById('cpw').value;

        if(a.localeCompare(b) != 0)
        {
            document.getElementById('errorMessage').innerHTML = "Password not match";
            document.forms["regForm"]["user"].focus();
            document.forms["regForm"]["password"].focus();
            return false;
        }
        else if (document.getElementById('agree').checked == false && document.getElementById('disagree').checked == false)
        {
            document.getElementById('errorMessage').innerHTML = "Checkbox is unchecked";
            document.forms["regForm"]["agreeTerm"].focus();
            document.forms["regForm"]["disagreeTerm"].focus();
            return false;
        }
        else if (document.getElementById('agree').checked == true && document.getElementById('disagree').checked == true)
        {
            document.getElementById('errorMessage').innerHTML = "Only one checkbox can be checked";
            document.forms["regForm"]["agreeTerm"].focus();
            document.forms["regForm"]["disagreeTerm"].focus();
            return false;
        }
        else if(document.getElementById('disagree').checked == true)
        {
            document.getElementById('errorMessage').innerHTML = "You have to agree to the terms";
            document.forms["regForm"]["agreeTerm"].focus();
            document.forms["regForm"]["disagreeTerm"].focus();
            return false;
        }
    }