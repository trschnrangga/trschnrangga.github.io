
    document.querySelector('.submitbtn button').addEventListener('click', function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phoneNum = document.getElementById('phonenum').value.trim();
        const gender = document.querySelector('select').value;
        const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

        if (name === "") {
            alert("Name cannot be empty");
            return;
        }
        if (!email.match(emailPattern)) {
            alert("Please enter a valid email address");
            return;
        }
        if (phoneNum.length < 9) {
            alert("Phone number must be at least 9 digits");
            return;
        }
        if (gender === "unselected") {
            alert("Please select your gender");
            return;
        }

        alert("Form submitted successfully!");
        
        document.querySelector('form').submit();

        document.getElementById('name').value = "";
        document.getElementById('email').value = "";
        document.getElementById('phonenum').value = "";
        document.querySelector('select').value = "unselected";
    });