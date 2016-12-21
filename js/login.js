function myOnSubmit(aForm) {
    //Getting the two input objects
    var inputPassword = aForm['pass'];

    //Hashing the values before submitting
    inputPassword.value = sha512(inputPassword.value);
	
    //Submitting
    return true;
}