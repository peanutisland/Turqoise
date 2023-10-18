
  function showLoginPopup() {
    document.getElementById("login-popup").style.display = "block";
  }

  function hideLoginPopup() {
    document.getElementById("login-popup").style.display = "none";
  }

  function showRegistrationPopup() {
    document.getElementById("register-popup").style.display = "block";
  }

  function hideRegistrationPopup() {
    document.getElementById("register-popup").style.display = "none";
  }

  function hideLoginShowRegistration() {
    hideLoginPopup();
    showRegistrationPopup();
  }