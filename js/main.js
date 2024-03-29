
// password

const passwordField = document.querySelector('input.password');
const toggleBtn = document.querySelector('form i');

toggleBtn.onclick = () => {
   if(passwordField.type == "password") {
    passwordField.type = "text";
   } else {
    passwordField.type = "password";
   }
}