function validateForm() {
  const name = document.getElementById("fullname").value.trim();
  const email = document.getElementById("email").value.trim();
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirmpassword").value;
  const phone = document.getElementById("phone").value.trim();

  const nameRegex = /^[a-zA-Z\s]+$/;
  const usernameRegex = /^[a-zA-Z0-9]{5,15}$/;
  const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  const phoneRegex = /^[0-9]{10}$/;
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  let isValid = true;

  // Name
  if (!nameRegex.test(name)) {
    document.getElementById("name-error").textContent = "Enter a valid name";
    document.getElementById("fullname").style.border = "2px solid red";
    isValid = false;
  } else {
    document.getElementById("name-error").textContent = "";
    document.getElementById("fullname").style.border = "";
  }

  // Email
  if (!emailPattern.test(email)) {
    document.getElementById("email-error").textContent = "Enter valid email";
    document.getElementById("email").style.border = "2px solid red";
    isValid = false;
  } else {
    document.getElementById("email-error").textContent = "";
    document.getElementById("email").style.border = "";
  }

  // Username
  if (!usernameRegex.test(username)) {
    document.getElementById("username-error").textContent = "Username must be 5-15 alphanumeric characters";
    document.getElementById("username").parentElement.style.border = "2px solid red";
    isValid = false;
  } else {
    document.getElementById("username-error").textContent = "";
    document.getElementById("username").parentElement.style.border = "";
  }

  // Password
  if (!passwordRegex.test(password)) {
    document.getElementById("password-error").textContent =
      "Password must be 8+ characters with letter, number, and symbol";
    document.getElementById("password").parentElement.style.border = "2px solid red";
    isValid = false;
  } else {
    document.getElementById("password-error").textContent = "";
    document.getElementById("password").parentElement.style.border = "";
  }

  // Confirm Password
  if (password !== confirmPassword) {
    document.getElementById("confirmpassword-error").textContent = "Passwords do not match";
    document.getElementById("confirmpassword").parentElement.style.border = "2px solid red";
    isValid = false;
  } else {
    document.getElementById("confirmpassword-error").textContent = "";
    document.getElementById("confirmpassword").parentElement.style.border = "";
  }

  // Phone
  if (!phoneRegex.test(phone)) {
    document.getElementById("phone-error").textContent = "Enter a valid 10-digit phone number";
    document.getElementById("phone").parentElement.style.border = "2px solid red";
    isValid = false;
  } else {
    document.getElementById("phone-error").textContent = "";
    document.getElementById("phone").parentElement.style.border = "";
  }

  if (isValid) {
    displayDetails(name, email, username, phone);
    document.getElementById("registration-form").reset();
  }

  return false; //  form submission ne bachavse
}

function displayDetails(name, email, username, phone) {
  const detailsDiv = document.getElementById("details");
  detailsDiv.innerHTML = `
    <h3>Submitted Details</h3>
    <p><strong>Name:</strong> ${name}</p>
    <p><strong>Email:</strong> ${email}</p>
    <p><strong>Username:</strong> ${username}</p>
    <p><strong>Phone:</strong> ${phone}</p>
  `;
  // detailsDiv.style.display = "block";
}
